<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //
    public function follow(User $user)
    {
        $currentUser = Auth::user();

        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot follow yourself 😅');
        }

        /** @var User $currentUser */
        $currentUser->following()->syncWithoutDetaching([$user->id]);

        return back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow(User $user)
    {
        $currentUser = Auth::user();

        /** @var User $currentUser */
        $currentUser->following()->detach($user->id);

        return back()->with('success', 'You have unfollowed ' . $user->name);
    }
}
