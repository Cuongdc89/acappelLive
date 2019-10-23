<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @bodyParam email email required The title of the post.
     * @bodyParam password string required The content of the post.
     * @response {
     *  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
     *  "user": {
     * "id": "2",
     * "name": "Cuongdc",
     * "email": "cuongdc316@gmail.com",
     * "created_at": "2019-10-23 04:15:26",
     * "updated_at": "2019-10-23 04:15:26"
     * }
     * }
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors":{
     * "email":[
     * "These credentials do not match our records."
     * ]
     * }
     * }
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['user'] = $user;
            return response()->json($success, 200);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @response {
     * "status": "true"
     * }
     */
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        $user->token()->delete();

        $success["status"] = true;
        return response()->json($success, 200);
    }
}
