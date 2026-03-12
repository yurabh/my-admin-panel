<?php

namespace App\Http\Controllers\User;

use App\Actions\Auth\RegistrationAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return UserResource::collection(User::with(['posts', 'comments', 'pages'])->get());
    }


    public function store(RegisterRequest $request, RegistrationAction $action)
    {
        $user = DB::transaction(callback: fn() => $action->handle($request));
        return UserResource::make($user);
    }


    public function show(User $user)
    {
        return UserResource::make($user);
    }


    public function update(RegisterRequest $request, User $user, UpdateUserAction $action)
    {
        $this->authorize('update', $user);

        $user = DB::transaction(callback: fn() => $action->handle($request, $user));
        return UserResource::make($user);
    }


    public function destroy(User $user)
    {
        $user->delete();

        Log::debug('User removed with id', [$user->id]);

        return response()->json(['message' => 'User deleted'], 204);
    }
}
