<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 11/3/19
 * Time: 11:57 AM
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @response {
     * "status": "true",
     * "user" : {
     *  "email" : "cuongdc@gmail.com",
     *  "id": "1",
     *  "profile_picture_url": "https://lh3.googleusercontent.com/--jvQFiFavr0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID/s32-c/photo.jpg"
     * }
     * }
     */
    public function getUserInfo()
    {
        if ($user = Auth::user()) {
            $success['user'] = $user;
            $success['status'] = true;

            return response()->json($success, 200);
        }

        $success['status'] = false;
        $success['errors']['msg'] = "User not authentication";
        return response()->json($success, 200);
    }

    /**
     * @bodyParam name string option update user name of auth user.
     * @bodyParam profile_picture file option update profile of user
     * @response {
     *  "status" : true,
     *  "user": {
     *  "email" : "cuongdc@gmail.com",
     *  "id": "1",
     *  "profile_picture_url": "https://lh3.googleusercontent.com/--jvQFiFavr0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID/s32-c/photo.jpg"
     * }
     * }
     * @param Request $request
     */
    public function updateUserInfo(Request $request)
    {

    }

}