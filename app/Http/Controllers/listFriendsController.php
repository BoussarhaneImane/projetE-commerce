<?php

namespace App\Http\Controllers;

use App\Models\friendList;
use App\Models\message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class listFriendsController extends Controller
{
    /**
     * TODO: List users controller.
     */
    public function index(Request $request)
    {
        $id_current_user = Auth::guard('web')->id();
        // TODO: Get list friends
        // TODO: Get friendList id
        $id_friend = FriendList::get('id');
        $friends = FriendList::join('users', function ($join) use ($id_current_user, $id_friend) {
            foreach ($id_friend as $id) {
                if($id->id == $id_current_user){
                    $join->on('users.id', '=', 'friend_lists.id_friends')
                    ->where('friend_lists.id', '=', $id_current_user);
                }else{
                    $join->on('users.id', '=', 'friend_lists.id')
                    ->where('friend_lists.id_friends', '=', $id_current_user);
                }
            }
        })
        ->get();
        $lastData = [];
        foreach ($friends as $friend) {
            $message = message::where(function ($query) use ($friend, $id_current_user){
                $query->where('id_sender', $friend->id)
                ->where('id_receiver', $id_current_user);
            })
            ->orWhere(function ($query) use ($friend, $id_current_user){
                $query->where('id_sender', $id_current_user)
                ->where('id_receiver', $friend->id);
            })
            ->latest()->first();
            array_push($lastData, [
                'message' => $message,
                'friend' => $friend
            ]);
        }
        usort($lastData, function ($a, $b) {
            $createdAtA = optional($a['message'])->created_at;
            $createdAtB = optional($b['message'])->created_at;

            return $createdAtB <=> $createdAtA;
        });
        return $lastData;
    }
}
