<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Website;
use App\Models\Vote;


class VoteController extends Controller
{
    /**
    * Delete website data.
    *
    * @param int $id
    * @return JsonResponse
    */
    public function vote(int $id): JsonResponse
    {
        $user = auth()->user();
        $website = new Website();
        
        if (Vote::where('user_id', $user->id)->where('website_id', $id)->exists()) {
            return response()->json(['message' => 'You have already voted for this website'], 403);
        }

        Vote::create(['user_id' => $user->id, 'website_id' => $id]);
        Website::where('id', $id)->increment('votes_count');

        return response()->json(['message' => 'Vote recorded']);
    }

}
