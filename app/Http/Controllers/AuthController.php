<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequests\ForgetPasswordRequest;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Requests\AuthRequests\ResetPasswordRequest;
use App\Responses\ApiResponse;
use App\Services\AuthService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;
    private $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function emailVerification(EmailVerificationRequest $request)
    {
        $data = $this->authService->emailVerification($request);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $data = $this->authService->forgetPassword($request);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $this->authService->resetPassword($request);
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function resendVerificationCode()
    {
        $data = $this->authService->resendVerificationCode();
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }

    public function logout()
    {
        $data = $this->authService->logout();
        return $this->apiResponse($data['data'],$data['message'], $data['status']);
    }
}
