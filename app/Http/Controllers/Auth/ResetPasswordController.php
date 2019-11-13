<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * @group Autentication
     * API for change password
     * @title change password
     * @authenticated
     * @bodyParam new_password string required The password required min 8 char. Example: 23456789@a
     * @response {
     * "status": "true",
     * "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
     * "user" : {
     *  "name": "Cuongdc123",
     *  "email" : "cuongdc@gmail.com",
     *  "id": "1",
     *  "profile_picture_url": "https://lh3.googleusercontent.com/--jvQFiFavr0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID/s32-c/photo.jpg"
     * }
     * }
     */
    function changePassword(Request $request) {
        $data = $request::all();
        $user = Auth::user();
        //Changing the password only if is different of null
        if(isset($data['new_password']) && !empty($data['new_password']) && $data['new_password'] !== "" && $data['new_password'] !=='undefined') {
            $user->password = bcrypt($data['new_password']);
            $user->token()->revoke();
            $token = $user->createToken('newToken')->accessToken;

            $user->save();

            $data['status'] = true;
            $data['token'] = $token;

            return response()->json($data, 200);
        }

        $data['status'] = false;
        $data['errors'] = array(
            'code' => -100,
            'msg'  => 'new_password of action is required'
        );

        return response()->json($data, 200);
    }
}
