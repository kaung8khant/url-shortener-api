<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    use ResponseHelper;

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'password' => 'required|string|min:6',
        ]);

        $result = $this->attemptLogin($request);

        if ($result) {
            return response()->json(['token' => $result], 200);
        }

        return response()->json(['message' => 'Username or password wrong.'], 401);
    }

    private function attemptLogin(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        if ($user) {

            return Auth::guard('users')->claims($user->toArray())->attempt([
                'username' => $request->username,
                'password' => $request->password,
            ]);
        }

        return false;
    }

    public function logout()
    {
        Auth::guard('users')->logout();
        return response()->json(['message' => 'User successfully logged out.'], 200);
    }

    public function refreshToken()
    {
        return response()->json(['token' => Auth::guard('users')->refresh()], 200);
    }

}
