<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Admin;
use Auth;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use Notification;
use App\Notifications\SuccessLoginNotification;

class LoginController extends ApiController
{
    public function login(LoginRequest $request){

        $params = $request->only('username', 'password');
        $username = $params['username'];
        $password =  $params['password'];

        $user = Admin::where('email', $username)
        ->first();

        if(!$user){
            return $this->setStatusCode(403)->respondWithError(['User does not exists !']);
        }

        if (!Auth::attempt(['email' => $user->email, 'password' => $password])) {
            return $this->setStatusCode(403)->respondWithError(['Invalid Credientails !']);            
        }

        Notification::send($user, new SuccessLoginNotification($user->toArray()));
        
        return $this->setStatusCode(200)->respondWithData(array_merge($user->toArray(),$this->getUserTokenData($user)),'login success !');
    }

    protected function getUserTokenData(Admin $user)
    {
        if (!$user->id) {
            throw new \Exception;
        }

        return ['accessToken' => $user->createToken('user')->accessToken, 'expiredAt' => strtotime('+23 hour')];
    }

    public function check(Request $request){
        if(Auth::user()){
            return $this->respondSuccess('User is authenticated !');
        }

        return $this->respondUnauthorized();
    }
}
