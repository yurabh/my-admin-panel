<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CreateAccessToken;
use App\Actions\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest      $request,
                             CreateAccessToken $accessToken,
                             LoginAction       $action)
    {
        return $action->handle($request, $accessToken);
    }
}
