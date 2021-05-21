<?php

namespace App\Api;

use Tymon\JWTAuth\Contracts\JWTSubject;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use JWTAuth;

class FlutterUser extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'flutter_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'epf', 'email', 'password', 'phone', 'report', 'district'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public static function checkToken($token)
    {
        if ($token->token) {
            return true;
        }
        return false;
    }
    public static function getCurrentUser($request)
    {
        if (!User::checkToken($request)) {
            return response()->json([
                'message' => 'Token is required'
            ], 422);
        }

        $user = JWTAuth::parseToken()->authenticate();
        return $user;
    }
}
