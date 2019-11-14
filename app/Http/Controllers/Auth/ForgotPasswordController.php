<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Models\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'device_id' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
    }

    /**
     * @group Autentication
     * API for request reset password
     * @title request reset password
     * @bodyParam device_id string required the id of device. Example: 23456789@a
     * @bodyParam email string required the email user want to reset password. Example: 23456789@a
     * @response {
     * "status": "true"
     * }
     */
    public function requestResetPassword(Request $request)
    {
        $this->validator($request->all())->validate();
        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if (!$user) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'email not exit, please check again'
            );

            return response()->json($data, 200);
        }

        try {
            $code = rand(1000, 9999);

            $passwordReset = new PasswordReset();
            $passwordReset->email = $input['email'];
            $passwordReset->token = $code;
            $passwordReset->save();

            $params['code'] = $code;

            Mail::to($input['email'])->sendNow(new ForgotPassword($params));

            $data['status'] = true;

            return response()->json($data, 200);

        } catch (\Exception $e) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => $e->getMessage()
            );

            return response()->json($data, 200);
        }

    }

    protected function validateResetPass($data)
    {
        return Validator::make($data, [
            'device_id'     => 'required|string|max:255',
            'email'         => 'required|string|email|max:255',
            'code'          => 'required|string|email|max:255',
            'new_password'  => 'required|string|email|max:255',
        ]);
    }

    /**
     * @group Autentication
     * API for reset password
     * @title reset password
     * @bodyParam device_id string required the id of device. Example: 23456789@a
     * @bodyParam email string required the email user want to reset password. Example: 23456789@a
     * @bodyParam code string required The code was sent to email. Example: 23456789@a
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
    public function resetPassword(Request $request)
    {
        try {
            $this->validateResetPass($request->all())->validate();
            $input = $request->all();

            $user = User::where('email', $input['email'])->first();

            if (!$user) {
                $data['status'] = false;
                $data['errors'] = array(
                    'code' => -100,
                    'msg' => 'email not exit, please check again'
                );

                return response()->json($data, 200);
            }

            $passwordReset = PasswordReset::where('email', $input['email'])->where('token', $input['code'])->first();

            if (!$passwordReset) {
                $data['status'] = false;
                $data['errors'] = array(
                    'code' => -100,
                    'msg' => 'email or code not correnct, please check again'
                );

                return response()->json($data, 200);
            }

            $passwordReset->delete();

            $user->password = bcrypt($input['new_password']);
            $user->token()->revoke();
            $token = $user->createToken('newToken')->accessToken;

            $user->save();

            $data['status'] = true;
            $data['token']  = $token;
            $data['user']   = $user;

            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => $e->getMessage()
            );

            return response()->json($data, 200);
        }
    }
}
