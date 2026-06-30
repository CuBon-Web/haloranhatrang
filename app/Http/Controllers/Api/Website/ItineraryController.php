<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use App\models\website\Itinerary;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function list(Request $request)
    {
        $query = Itinerary::orderBy('sort')->orderBy('id');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $data = $query->get();

        return response()->json(['data' => $data, 'message' => 'success'], 200);
    }

    public function create(Request $request)
    {
        $days = $request->days ?? [];
        if (!is_array($days)) {
            $days = json_decode($days, true) ?: [];
        }

        $payload = [
            'name'              => $request->name ?? '',
            'slug'              => to_slug($request->name ?? ''),
            'short_description' => $request->short_description ?? '',
            'content'           => $request->content ?? '',
            'map_image'         => $request->map_image ?? '',
            'featured_image'    => $request->featured_image ?? '',
            'days'              => array_values($days),
            'sort'              => $request->sort ?? 0,
            'status'            => $request->status ?? 1,
        ];

        if ($request->id) {
            $item = Itinerary::findOrFail($request->id);
            $item->update($payload);
        } else {
            Itinerary::create($payload);
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function edit($id)
    {
        $data = Itinerary::findOrFail($id);

        return response()->json(['data' => $data, 'message' => 'success'], 200);
    }

    public function delete($id)
    {
        Itinerary::where('id', $id)->delete();

        return response()->json(['message' => 'success'], 200);
    }
}
