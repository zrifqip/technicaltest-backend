<?php

namespace App\Http\Controllers\API;

use App\enums\TokenAbility;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $success['remember_token'] = $user->createToken('access_token', [TokenAbility::ACCESS_ADMIN->value], Carbon::now()->addMinutes(config('sanctum.ac_expiration')))->plainTextToken;
            $success['name'] =  $user->name;
            return $this->sendResponse($success, 'Admin login successfully.')->withCookie($this->createCookie($success['remember_token']));
        }
        else{
            return $this->sendError('Unauthorized', ['error'=>'Unauthorized'],401);
        }
    }
    public function loginGuest(Request $request)
    {
        $UserData = $request->validate([
            'name'=>'required|string',
        ]);
        $user = User::where('name',$UserData['name'])->first();
        if(!$user){
            $user = User::create([
                'name' => $request->name,
            ]);
        }
        $accessToken = $user->createToken(
            'access_token',
            [TokenAbility::ACCESS_GUEST->value],
            Carbon::now()->addMinutes(config('sanctum.ac_expiration')))->plainTextToken;

        return response()->json([
            'token' => $accessToken,
            'user' => $user,
        ])->withCookie($this->createCookie($accessToken));
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
    private function createCookie($token){
        return cookie('XSRF_TOKEN', $token, 60, null, null, false, true, false, 'Strict');
    }
}
