<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\VerficationEmailCode;
use Ichtrojan\Otp\Otp;

class AuthService
{
    private $otp;

    public function __construct(Otp $otp)
    {
        $this->otp = $otp;
    }

    private function generateToken(User $user)
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    public function register($request)
    {
        $user = User::create($request->validated());
        $code = $this->otp->generate($user->email,'numeric',6,50);
        $user->notify(new VerficationEmailCode($code->token));
        $token = $this->generateToken($user);
        return [
            'data' => [
                'token' => $token,
                'user' => new UserResource($user),
            ],
            'message' => 'Register and Send verification code successfully',
            'status' => 201,
        ];
    }

    public function login($request)
    {
        if(!$token = auth()->attempt($request->validated())){
            return [
                'data' => null,
                'message' => 'password is invalid',
                'status' => 401,
            ];
        }
        $user = User::query()->where('email',$request->email)->first();
        $token = $this->generateToken($user);
        return [
          'data' => [
              'token' => $token,
              'user' => new UserResource($user),
          ],
            'message' => 'Login successfully',
            'status' => 200,
        ];
    }


    public function emailVerification($request){
        $email = auth()->user()->email;
        $otp =  $this->otp->validate($email,$request->code);
        if($otp->status){
            User::where('email',$email)->update(['email_verified_at'=>now()]);
            return ['data' =>null,'message'=>'Verification code successfully','status' => 200];
        }

        return [
            'data' => $otp->status,
            'message'=>'Code is invalid',
            'status' => 401
        ];
    }

    public function forgetPassword($request)
    {
        $user = User::where('email',$request->email)->first();
        $token = $this->generateToken($user);
        User::where('id',$user->id)->update(['email_verified_at'=>null]);
        $code = $this->otp->generate($user->email,'numeric',6,50);
        $user->notify(new VerficationEmailCode($code->token));
        return [
            'data' =>[
                'token' => $token
            ],
            'message' => 'Send verification code successfully',
            'status' => 200
        ];
    }

    public function resendVerificationCode()
    {
        $user = auth()->user();
        User::where('id',$user->id)->update(['email_verified_at'=>null]);
        $code = $this->otp->generate($user->email,'numeric',6,50);
        $user->notify(new VerficationEmailCode($code->token));
        return [
            'data' =>null,
            'message' => 'Send verification code successfully',
            'status' => 200
        ];
    }

    public function resetPassword($request)
    {
        $newPassword = bcrypt($request->password);
        User::where('email',auth()->user()->email)->update(['password'=>$newPassword]);
        return [
            'data' =>null,
            'message'=>'Reset password successfully ',
            'status' => 200
        ];
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        $user->save();
        return [
            'data' => null,
            'message' => 'Logout successfully',
            'status' => 200
        ];
    }

}
