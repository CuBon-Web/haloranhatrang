<?php

namespace App\Http\Controllers;

use App\models\blog\Blog;
use App\models\PageContent;
use App\models\Project;
use App\models\ReviewCus;

class HomeController extends Controller
{
    public function home()
    {
        $data['hotnews'] = Blog::where([
            ['status', '=', 1],
        ])->orderBy('id', 'DESC')->limit(3)->get(['id', 'title', 'slug', 'created_at', 'image', 'description']);

        $data['gioithieu'] = PageContent::where('slug', 'gioi-thieu')
            ->where('language', 'vi')
            ->first(['id', 'title', 'description', 'image']);

        $data['ReviewCus'] = ReviewCus::where(['status' => 1])->get();
        $data['duan'] = Project::where('status', 1)->orderBy('id', 'DESC')->get();

        return view('home', $data);
    }
}
