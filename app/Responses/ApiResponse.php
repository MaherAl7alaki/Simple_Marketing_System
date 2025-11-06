<?php

namespace App\Responses;

trait ApiResponse
{
    public function apiResponse($data = null, $message = null, $status = null)
    {
        $array = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($array, $status);
    }
}
