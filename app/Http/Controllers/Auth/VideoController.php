<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 11/3/19
 * Time: 2:51 PM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Video;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use PhpParser\Node\Expr\New_;

class VideoController extends Controller
{
    /**
     * @group Videos
     * API for user upload video
     * @authenticated
     * @bodyParam title string require the title  of video max 100. Example: video1
     * @bodyParam file file require this data is video file for upload. Example:"video file"
     * @bodyParam name string option name of this video max 100. Example: mucsic_video
     * @bodyParam artist string option the artist of video max 50. Example: Cuongdc123
     * @bodyParam type int option type of video must in [1,2,3]: 1: このサイトで依頼・購入, 2: 自作, 3: 他で依頼・購入 . Example: Cuongdc123
     * @response {
     * "status": true,
     * "video": {
     * "id": "1",
     * "name" : "video1",
     * "artist": "video1 artist",
     * "type": "1",
     *  "thumbnail_url": "http://videos/thumbnail/video_1.png",
     * "video_url": "http://videos/url/video1",
     * "created_at": "2019-01-01 01:00:00",
     * "updated_at": "2019-01-01 01:00:00",
     * "owned": {
     *  "name": "Cuongdc123",
     *  "id": "1",
     *  "profile_picture_url": "https://lh3.googleusercontent.com/--jvQFiFavr0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rea71C01D1HxUXaqKQ7Djj9e8Li4Q.CMID/s32-c/photo.jpg"
     * }
     * }
     * }
     */
    public function create(Request $request)
    {
        try {
            $user = Auth::user();
            $data = [];
            if (!Request::has("title")) {
                $data["status"] = false;
                $data["errors"] = array(
                    "code" => -1,
                    "msg" => "※タイトルを必ず入力してください"
                );

                return response()->json($data, 200);
            }

            if (!Request::hasFile('file')) {
                $data["status"] = false;
                $data["errors"] = array(
                    "code" => -2,
                    "msg" => "※動画を必ずアップロードしてください"
                );

                return response()->json($data, 200);
            }

            $file = Request::file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads', $fileName);

            $fileUrl = $this->getUrl('uploads/' . $fileName);

            $video = new Video();

            $input = $request::all();
            $video->user_id     = $user['id'];
            $video->video_url   = $fileUrl;
            $video->title       = $input['title'];
            if (Request::has("name")) {
                $video->name = $input['name'];
            }

            if (Request::has("artist")) {
                $video->artist = $input['artist'];
            }
            if (Request::has("type")) {
                $video->type = $input['type'];
            }

            $video->save();
            $video->owned = $user;

            $data['video'] = $video;
            $data["status"] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    /**
     * @group Videos
     * API for get list videos
     * @respone {
     * "status": true,
     *"videos": [
     * {
     * "id": 1,
     * "user_id": 2,
     * "title": "do.cao.cuong1@alliedtechbase.com",
     * "name": null,
     * "type": null,
     * "thumbnail_url": null,
     * "video_url": "http://127.0.0.1:8000/uploads/1572854724_download (7).jpeg",
     * "created_at": "2019-11-04 08:05:24",
     * "updated_at": "2019-11-04 08:05:24",
     * "owned": {
     * "id": 1,
     * "name": "Cuongdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * }
     * },
     * {
     * "id": 2,
     * "user_id": 2,
     * "title": "do.cao.cuong1@alliedtechbase.com",
     * "name": null,
     * "type": null,
     * "thumbnail_url": null,
     * "video_url": "http://127.0.0.1:8000/uploads/1572854727_download (7).jpeg",
     * "created_at": "2019-11-04 08:05:27",
     * "updated_at": "2019-11-04 08:05:27",
     * "owned": {
     * "id": 1,
     * "name": "Cuôngdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * }
     * }
     * ]
     * }
     */
    public function getListVideos()
    {
        $videos = Video::get();
        $data["status"] = true;


        foreach ($videos as $video) {
            $video->owned = User::find($video->user_id)->first();
            $data['videos'][] = $video;
        }

        return response()->json($data, 200);
    }
    /**
     * @group Videos
     * API for get video detail.
     * @responce {
     * "status": true,
     * "video": {
     * "id": 1,
     * "user_id": 2,
     * "title": "do.cao.cuong1@alliedtechbase.com",
     * "name": null,
     * "type": null,
     * "thumbnail_url": null,
     * "video_url": "http://127.0.0.1:8000/uploads/1572854724_download (7).jpeg",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:05:24",
     * "updated_at": "2019-11-04 08:05:24",
     * "owned": {
     * "id": 1,
     * "name": "Cuongdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * }
     * }
     * }
     */
    public function getVideoInfo($id)
    {
        $video = Video::find($id)->first();
        if ($video) {
            $video->owned = User::find($video->user_id)->first();
        }

        $data["status"] = true;
        $data['video'] = $video;

        return response()->json($data, 200);
    }

    /**
     * @group Comments
     * API for get list comments of a video
     * @responce {
     * "status": true,
     * "comments": [
     * {
     * "id": 1,
     * "user_id": 2,
     * "video_id": 1,
     * "comment_text": "this is a comment",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:45:04",
     * "updated_at": "2019-11-04 08:45:04",
     * "owned": {
     * "id": 1,
     * "name": "Cuongdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * }
     * },
     * {
     * "id": 2,
     * "user_id": 2,
     * "video_id": 1,
     * "comment_text": "this is a comment too",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:45:17",
     * "updated_at": "2019-11-04 08:45:17",
     * "owned": {
     * "id": 1,
     * "name": "Cuongdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * }
     * }
     * ]
     * }
     */
    public function getListComments(Request $request, $id)
    {
        $video = Video::find($id)->first();
        $data["status"] = true;
        if (!$video) {
            $data["status"] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => "video id not valid"
            );

            return response()->json($data, 200);
        }

        $comments = Comment::where('video_id', $id)->get();

        foreach ($comments as $comment) {
            $comment->owned = User::find($comment->user_id)->first();
            $data['comments'][] = $comment;
        }


        return response()->json($data, 200);
    }

    /**
     * @group Comments
     * API for create a comment for a video
     *
     * @authenticated
     * @bodyParam comment_text string require comment content for video. Example: Comment content for video.
     * @response {
     * "status": true,
     * "comment": {
     * "user_id": 2,
     * "video_id": 1,
     * "comment_text": "this is a comment too",
     * "updated_at": "2019-11-04 08:45:17",
     * "created_at": "2019-11-04 08:45:17",
     * "id": 2
     * }
     * }
     */
    public function createComment(Request $request, $id)
    {
        $user = Auth::user();
        $input = $request::all();

        if (!Request::has('comment_text')) {
            $data["status"] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => "comment_text required"
            );
        }

        $video = Video::find($id)->first();

        if (!$video) {
            $data["status"] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => "video id not valid"
            );

            return response()->json($data, 200);
        }

        $comment = new Comment();

        $comment->user_id       = $user['id'];
        $comment->video_id      = $video->id;
        $comment->comment_text  = $input['comment_text'];

        $comment->save();

        $data["status"] = true;
        $data['comment'] = $comment;

        return response()->json($data, 200);
    }

    protected function  getUrl($filePath) {
        return env('APP_URL') . '/' . $filePath ;
    }
}