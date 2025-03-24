<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function toggle(Request $request, Chirp $chirp)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        if ($chirp->likes()->where('user_id', $user->id)->exists()) {
            $chirp->likes()->detach($user->id);
            $liked = false;
        } else {
            $chirp->likes()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $chirp->likes()->count(),
        ]);
    }
}
