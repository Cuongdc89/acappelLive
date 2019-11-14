<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * @group Autentication
     * @title API register new user
     * @bodyParam email email required This param must validate email format. Example: cuongdc@gmail.com
     * @bodyParam password string required The password must has min 8 chars. Example: 12345678@a
     * @bodyParam password_confirmation string required The password must has min 8 chars. Example: 12345678@a
     * @bodyParam name string required This param will be use to display on user info and comment of user. Example: Cuongdc
     * @response {
     *  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVlOGMyOGM1ZTZ",
     *  "user": {
     * "id": "2",
     * "name": "Cuongdc",
     * "email": "cuongdc@gmail.com",
     * "created_at": "2019-10-23 04:15:26",
     * "updated_at": "2019-10-23 04:15:26"
     * },
     * "status": "true"
     * }
     * @response 422 {
     * "message": "The given data was invalid.",
     * "errors":{
     * "email":[
     * "The email has already been taken."
     * ]
     * }
     * }
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            $this->guard()->login($user);
            $success['token'] = $user->createToken('nfce_client')->accessToken;
            $success['user'] = $user;
            $success['status'] = true;
            DB::commit();

            return response()->json($success, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            $success['status'] = false;
            $success['error']['msg'] = $e->getMessage();

            return response()->json($success, 201);
        }
    }    
}
