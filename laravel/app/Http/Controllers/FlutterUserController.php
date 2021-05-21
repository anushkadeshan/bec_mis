<?php

namespace App\Http\Controllers;

use Mail;
use App\Api\FlutterUser;
use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class FlutterUserController extends Controller
{
    public function register(Request $request)
    {
        $plainPassword = $request->password;
        $password = bcrypt($request->password);
        $request->request->add(['password' => $password]);
        // create the user account
        $created = FlutterUser::create($request->all());
        $request->request->add(['password' => $plainPassword]);
        // login now..
        return $this->login($request);
    }
    public function login(Request $request)
    {

        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        // get the user
        $user = Auth::user();

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => $user
        ]);
    }
    public function logout(Request $request)
    {
        if (!FlutterUser::checkToken($request)) {
            return response()->json([
                'message' => 'Token is required',
                'success' => false,
            ], 422);
        }

        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getCurrentUser(Request $request)
    {
        if (!FlutterUser::checkToken($request)) {
            return response()->json([
                'message' => 'Token is required'
            ], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        // add isProfileUpdated....
        $isProfileUpdated = false;
        if ($user->isPicUpdated == 1 && $user->isEmailUpdated) {
            $isProfileUpdated = true;
        }
        $user->isProfileUpdated = $isProfileUpdated;

        return $user;
    }


    public function update(Request $request)
    {
        $user = $this->getCurrentUser($request);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User is not found'
            ]);
        }

        unset($data['token']);

        $updatedUser = FlutterUser::where('id', $user->id)->update($data);
        $user =  FlutterUser::find($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Information has been updated successfully!',
            'user' => $user
        ]);
    }
}
