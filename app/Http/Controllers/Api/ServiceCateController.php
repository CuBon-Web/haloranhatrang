<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\ServiceCate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class ServiceCateController extends Controller
{
    public function add(Request $request, ServiceCate $category)
    {
        $data = $category->saveCate($request);
        return response()->json([
    		'message' => 'Save Success',
    		'data'=> $data
    	],200);
    }
    public function list(Request $request)
    {
        $keyword = $request->keyword;
        $query = ServiceCate::query();
        if ($keyword != "") {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        }

        if (Schema::hasColumn('service_category', 'sort')) {
            $query->orderBy('sort', 'ASC')->orderBy('id', 'DESC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        if($keyword == ""){
            $data = $query->get();
        }else{
            $data = $query->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function edit($id)
    {
        $data = ServiceCate::where(['id'=>$id])->first();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function delete( $id)
    {
        $query = ServiceCate::find($id);
        $file= str_replace('http://localhost:8080','',$query->avatar);
        $filename = public_path().$file;
        if(file_exists( public_path().$file ) ){
            \File::delete($filename);
        }
        $query->delete();
        return response()->json(['message'=>'Delete Success']);
    }

    public function sort(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!is_array($ids) || empty($ids)) {
            return response()->json([
                'message' => 'Danh sách sắp xếp không hợp lệ',
            ], 422);
        }
        if (!Schema::hasColumn('service_category', 'sort')) {
            return response()->json([
                'message' => 'Thiếu cột sort, vui lòng chạy migrate.',
            ], 422);
        }

        DB::transaction(function () use ($ids) {
            foreach (array_values($ids) as $index => $id) {
                ServiceCate::where('id', (int) $id)->update(['sort' => $index + 1]);
            }
        });

        return response()->json([
            'message' => 'Cập nhật thứ tự thành công',
        ]);
    }
}
