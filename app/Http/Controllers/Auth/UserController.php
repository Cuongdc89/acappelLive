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

/**
 * Class UserController
 * @package App\Http\Controllers\Auth
 */
class UserController extends Controller
{
    /**
     * @group User Information
     * API for get user information
     * @title get user information
     * @authenticated
     * @response {
     * "status": "true",
     * "user" : {
     *  "name": "Cuongdc123",
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
     * @group User Information
     * API for update user information (user name, profile picture)
     * @authenticated
     * @bodyParam name string option update user name of auth user. Example: Cuongdc123
     * @bodyParam image string(base64_endcode) option data formart mustbe base64_endcode of image file. Example: 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
     * @response {
     *  "status" : true,
     *  "user": {
     *  "name": "Cuongdc123",
     *  "email" : "cuongdc@gmail.com",
     *  "id": "1",
     *  "profile_picture_url": "https://lh3.googleusercontent.com/--jvQFiFavr0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID/s32-c/photo.jpg"
     * }
     * }
     * @param Request $request
     */
    public function updateUserInfo(Request $request)
    {
        $user = Auth::user();

        if (isset($request['name'])) {
            $user['name'] = $request['name'];
        }

        if (isset($request['image'])) {
            $url = $this->createImageFromBase64($request['image']);
            if ($url) {
                $user['profile_picture_url'] = $url;
            }
        }

        $user->save();

        $success['status']  = true;
        $success['user']    = $user;

        return response()->json($success, 200);
    }


    public function createImageFromBase64($file_data){
        //generating unique file name;
        $file_name = 'image_'.time().'.png';
        //@list($type, $file_data) = explode(';', $file_data);
        //@list(, $file_data)      = explode(',', $file_data);
        if($file_data!=""){
            // storing image in storage/app/public Folder
            \Storage::disk('public')->put($file_name,base64_decode($file_data));
            return env('APP_URL') . '/avatars/' . $file_name ;
        }

        return null;
    }

}