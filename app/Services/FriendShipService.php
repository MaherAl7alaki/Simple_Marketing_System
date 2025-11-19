<?php

namespace App\Services;

use App\Http\Resources\UserResource;

class FriendShipService
{

    public function getFriends()
    {
        $friends = auth()->user()->friendShips()->latest()->get();
        return [
            'data' => UserResource::collection($friends),
            'message' => 'Get list of friends successfully',
            'status' => 200
        ];
    }

    //send and Unfriend
    public function manageFriendShip($receiverId)
    {
        $user = auth()->user();
        if($user->friendShips()->where('receiver_id', $receiverId)->exists()){
            $user->friendShips()->detach($receiverId);
            return [
                'data' => null,
                'message' => 'The friendship was successfully cancelled.',
                'status' => 200
            ];
        }
        $user->friendShips()->attach($receiverId);

        return [
            'data' => null,
            'message' => 'Friend request has been sent successfully.',
            'status' => 200
        ];
    }

    public function respondFriendRequest($friendshipId,$action)
    {
        $friendship = auth()->user()->friendShips()->find($friendshipId);
        if($action == 'accepted'){
            $friendship->update(['status' => 'accepted']);
            return [
                'data' => null,
                'message' => 'Friend request accepted successfully.',
                'status' => 200
            ];
        }
        auth()->user()->friendShips()->detach($friendshipId);
        return [
            'data' => null,
            'message' => 'Friend request has been deleted.',
            'status' => 200
        ];
    }
}
