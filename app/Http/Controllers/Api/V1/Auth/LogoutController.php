<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Models\OauthAccessToken;
use Auth;

class LogoutController extends ApiController
{
    public function logout(Request $request){
        if($request->user()->oAuthAcessToken()->delete()){
            return $this->respondSuccess(trans('auth.logout.success'));
        }

        return $this->setStatusCode(500)->respondWithError([trans('auth.logout.fail')]);;
    }
}
