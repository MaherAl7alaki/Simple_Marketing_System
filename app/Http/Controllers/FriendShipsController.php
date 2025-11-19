<?php

namespace App\Http\Controllers;

use App\Http\Requests\respondFriendRequest;
use App\Responses\ApiResponse;
use App\Services\FriendShipService;
use Illuminate\Http\Request;

class FriendShipsController extends Controller
{
    use ApiResponse;
    private $friendshipService;
    public function __construct(FriendshipService $friendshipService)
    {
        $this->friendshipService = $friendshipService;
    }
    public function getFriends()
    {
        $data = $this->friendshipService->getFriends();
        return $this->apiResponse($data['data'],$data['message'] ,$data['status']);
    }

    public function manageFriendShip($receiverId)
    {
        $data = $this->friendshipService->manageFriendShip($receiverId);
        return $this->apiResponse($data['data'],$data['message'] ,$data['status']);
    }

    public function respondFriendRequest(respondFriendRequest $request, $friendShipId)
    {
        $data = $this->friendshipService->respondFriendRequest($request->action,$friendShipId);
        return $this->apiResponse($data['data'],$data['message'] ,$data['status']);
    }


}
