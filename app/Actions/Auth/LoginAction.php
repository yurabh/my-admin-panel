<?php

namespace App\Actions\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Jobs\NotifyAdminsAboutLoginJob;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginAction
{
    public function __construct()
    {
    }

    public function handle(LoginRequest $request, CreateAccessToken $accessToken): LoginResource
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        $token = $accessToken->handle($user);

        Log::debug('Access token create and user found');

        NotifyAdminsAboutLoginJob::dispatch($user);

        return new LoginResource([
            'user' => $user,
            'token' => $token
        ]);
    }
}
