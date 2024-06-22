<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Http\Requests\WebsiteRequest;
use Illuminate\Http\JsonResponse;

class WebsiteController extends Controller
{
    /**
    * Display a listing of websites
    *
    * @return JsonResponse
    */
    public function index(): JsonResponse
    {
        $websites = Website::with('categories')->orderBy('votes_count', 'desc')->paginate(10);
        return response()->json($websites);
    }

    /**
    * Search websites.
    *
    * @return JsonResponse
    */
    public function search(Request $request): JsonResponse
    {
        $query = Website::query();
        
        if ($request->has('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $websites = $query->with('categories')->orderBy('votes_count', 'desc')->paginate(10);
        return response()->json($websites);
    }

    /**
    * Store a newly created website.
    *
    * @param WebsiteRequest $request
    * @return JsonResponse
    */
    public function store(WebsiteRequest $request): JsonResponse
    {

        $website = Website::create($request->safe()->only(['url', 'title', 'description']));
        $website->categories()->attach($request->categories);

        return response()->json($website, 201);
    }

    /**
    * Delete the specified website
    *
    * @param int $id
    * @return JsonResponse
    */
    public function destroy(int $id): JsonResponse
    {
        Website::where('id', $id)->delete();
        return response()->json(['message' => 'Recorded deleted'], 204);
    }
}
