<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout');
    }

    public function login(AuthRequest $request)
    {
        $user = User::whereEmail($request->safe()->email)
            ->where(function (Builder|EloquentBuilder $q) {
                $q->where('role', User::LEADER)->orwhere('role', User::ADMIN);
            })->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.']
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(
            ['message' => 'Logged Out Successfully']
        );
    }
}
