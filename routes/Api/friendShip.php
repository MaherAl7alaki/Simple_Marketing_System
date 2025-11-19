<?php

use App\Http\Controllers\FriendShipsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum','verify-email'])->group(function () {
   Route::get('/friendships', [FriendshipsController::class, 'getFriends']);
   Route::post('/friendship/manage/{$receiverId}', [FriendshipsController::class, 'manageFriendship']);
   Route::post('/friendship/respond/{friendShipID}', [FriendshipsController::class, 'respondFriendRequest']);
});
