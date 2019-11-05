<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 11/3/19
 * Time: 2:51 PM
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AnonymousUser;
use App\Models\Reaction;
use App\Models\Video;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * Class VideoController
 * @package App\Http\Controllers\Auth
 */
class VideoController extends Controller
{

    const DEFAULT_PAGE_SIZE = 10;
    /**
     * @group Videos
     * API for user upload video
     * @authenticated
     * @bodyParam title string required the title  of video max 100. Example: video1
     * @bodyParam file file required this data is video file for upload. Example:"video file"
     * @bodyParam type int required type of video must in [1,2,3]: 1: このサイトで依頼・購入, 2: 自作, 3: 他で依頼・購入 . Example: Cuongdc123
     * @bodyParam name string option name of this video max 100. Example: mucsic_video
     * @bodyParam artist string option the artist of video max 50. Example: Cuongdc123
     * @response {
     * "status": true,
     * "video": {
     * "id": "1",
     * "name" : "video1",
     * "artist": "video1 artist",
     * "type": "1",
     * "view_count": 0,
     *  "thumbnail_url": "http://videos/thumbnail/video_1.png",
     * "video_url": "http://videos/url/video1",
     * "created_at": "2019-01-01 01:00:00",
     * "updated_at": "2019-01-01 01:00:00",
     * "user": {
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
            $video->user = $user;

            $data['video'] = $video;
            $data["status"] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data["status"] = false;
            return response()->json($data, 200);
        }
    }
    
    /**
     * @group Videos
     * API for get list videos
     * @queryParam page int option this field use to filter what page client want to get.( default 10 video for 1 page): Example: 1
     * @queryParam q string option this field use to filter tilte of video. Example: abc
     * @queryParam type int option this field use to filter type of video. Example: 2
     * @queryParam user_id int option this field use to filter list video upload by an user. Example: 2
     * @response {
     *"status": true,
     *"videos": [
     *{
     *"id": 1,
     *"user_id": 2,
     *"title": "do.cao.cuong1@alliedtechbase.com",
     *"name": null,
     *"type": 2,
     *"view_count": 100,
     *"thumbnail_url": null,
     *"video_url": "http://127.0.0.1:8000/uploads/1572854724_download (7).jpeg",
     *"deleted_at": null,
     *"created_at": "2019-11-04 08:05:24",
     *"updated_at": "2019-11-04 08:05:24",
     *"user": {
     *"id": 2,
     *"name": "Cuongdc123",
     *"email": "do.cao.cuong1@alliedtechbase.com",
     *"created_at": "2019-10-23 04:15:26",
     *"updated_at": "2019-11-04 07:39:14",
     *"profile_picture_url": "http://127.0.0.1:8000/avatars/image_1572853154.png"
     *},
     * "reactions":[
     * {"type": 1, "count": 1, "reaction_status": true},
     * {"type": 2, "count": 1, "reaction_status": true},
     * {"type": 3, "count": 0, "reaction_status": false},
     * {"type": 4, "count": 0, "reaction_status": false},
     * {"type": 5, "count": 0, "reaction_status": false}
     * ]
     *},
     *{
     *"id": 2,
     *"user_id": 2,
     *"title": "do.cao.cuong1@alliedtechbase.com",
     *"name": null,
     *"type": 2,
     *"view_count": 100,
     *"thumbnail_url": null,
     *"video_url": "http://127.0.0.1:8000/uploads/1572854727_download (7).jpeg",
     *"deleted_at": null,
     *"created_at": "2019-11-04 08:05:27",
     *"updated_at": "2019-11-04 08:05:27",
     *"user": {
     *"id": 2,
     *"name": "Cuongdc123",
     *"email": "do.cao.cuong1@alliedtechbase.com",
     *"created_at": "2019-10-23 04:15:26",
     *"updated_at": "2019-11-04 07:39:14",
     *"profile_picture_url": "http://127.0.0.1:8000/avatars/image_1572853154.png"
     *},
     * "reactions":[
     * {"type": 1, "count": 1, "reaction_status": true},
     * {"type": 2, "count": 1, "reaction_status": true},
     * {"type": 3, "count": 0, "reaction_status": false},
     * {"type": 4, "count": 0, "reaction_status": false},
     * {"type": 5, "count": 0, "reaction_status": false}
     * ]
     *}
     *],
     *"meta_data": {
     *"total": 2,
     *"paging": {
     *"current_page": 1,
     *"last_page": 1,
     *"per_page": 10,
     *"from": 0,
     *"to": 2
     *}
     *}
     *}
     */
    public function getListVideos(Request $request)
    {
        $input = $request::all();
        $query = Video::where('id', '<>', 0);
        
        if (isset($input['user_id']) && $input['user_id'] > 0) {
            $query->where('user_id', $input['user_id']);
        }

        if (isset($input['q'])) {
            $query->where('videos.title', 'LIKE',  "%{$input['q']}%");
        }

        $totalVideos = $query->count();

        $currentPage    = isset($input['page']) ? $input['page'] : 1;
        $lastPage       = ceil($totalVideos / static::DEFAULT_PAGE_SIZE);

        if ($currentPage > $lastPage) {
            $currentPage = $lastPage;
        }

        if ($currentPage <= 0 ) {
            $currentPage = 1;
        }

        $offsetFrom     = (($currentPage - 1) * static::DEFAULT_PAGE_SIZE);
        $offsetTo       = ($lastPage > $currentPage) ? $currentPage * static::DEFAULT_PAGE_SIZE : $totalVideos;
        $query->offset($offsetFrom);
        $query->limit(static::DEFAULT_PAGE_SIZE);

        $videos =  $query->get();


        $data["status"] = true;


        foreach ($videos as $video) {
            $video->user = User::where('id', $video->user_id)->get()->first();
            $video->reactions = $this->getListReactionCount($video->id);
            $data['videos'][] = $video;
        }

        $data['meta_data'] = [
            'total'         => $totalVideos,
            'paging'        => [
                'current_page'  => $currentPage,
                'last_page'     => $lastPage,
                'per_page'      => static::DEFAULT_PAGE_SIZE,
                'from'          => $offsetFrom,
                'to'            => $offsetTo,
                ]
        ];

        return response()->json($data, 200);
    }

    
    /**
     * @group Videos
     * API for get video detail.
     * @response {
     * "status": true,
     * "video": {
     * "id": 1,
     * "user_id": 2,
     * "title": "do.cao.cuong1@alliedtechbase.com",
     * "name": null,
     * "type": 1,
     * "view_count": 100,
     * "thumbnail_url": null,
     * "video_url": "http://127.0.0.1:8000/uploads/1572854724_download (7).jpeg",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:05:24",
     * "updated_at": "2019-11-04 08:05:24",
     * "user": {
     * "id": 1,
     * "name": "Cuongdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * },
     * "reactions":[
     * {"type": 1, "count": 1, "reaction_status": true},
     * {"type": 2, "count": 1, "reaction_status": true},
     * {"type": 3, "count": 0, "reaction_status": false},
     * {"type": 4, "count": 0, "reaction_status": false},
     * {"type": 5, "count": 0, "reaction_status": false}
     * ]
     * }
     * }
     */
    public function getVideoInfo($id)
    {
        $video = Video::find($id)->first();
        if ($video) {
            $video->user = User::find($video->user_id)->first();
            $video->reactions = $this->getListReactionCount($video->id);
        }

        $data["status"] = true;
        $data['video'] = $video;

        return response()->json($data, 200);
    }

    protected function  getUrl($filePath) {
        return env('APP_URL') . '/' . $filePath ;
    }


    /**
     * @param $videoId
     * @return array
     */
    private function getListReactionCount($videoId)
    {
        $authType = Reaction::ANONYMOUS_USER;
        if (Auth::user()) {
            $authType = Reaction::AUTH_USER;
            $userId = Auth::user()['id'];
        } else {
            $userId = $this->getAnonymousUserId();
        }

        $countReed = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_REED)->count();
        $countHar = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_HARMONIZED)->count();
        $countEx = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_EXPRESSIVE)->count();
        $countRH = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_RHYTHM)->count();
        $countCA = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_CARE)->count();

        return $data = array(
            [
                "type"  => Reaction::TYPE_REED,
                "count" => $countReed,
                "reaction_status" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_REED, $authType),
            ],
            [
                "type"  => Reaction::TYPE_HARMONIZED,
                "count" => $countHar,
                "reaction_status" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_HARMONIZED, $authType),
            ],
            [
                "type"  => Reaction::TYPE_EXPRESSIVE,
                "count" => $countEx,
                "reaction_status" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_EXPRESSIVE, $authType),
            ],
            [
                "type"  => Reaction::TYPE_RHYTHM,
                "count" => $countRH,
                "reaction_status" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_RHYTHM, $authType),
            ],
            [
                "type"  => Reaction::TYPE_CARE,
                "count" => $countCA,
                "reaction_status" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_CARE, $authType),
            ]
        );
    }

    /**
     * @param $videoId
     * @param $userId
     * @param $type
     * @param $authType
     * @return bool
     */
    private function getReactionStatus($videoId, $userId, $type, $authType) {

        $reaction = Reaction::where('video_id', $videoId)->where('type', $type)
            ->where('user_id', $userId)->where('auth_type', $authType)->first();
        if ($reaction) {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    private function getAnonymousUserId() {
        $agent  = $_SERVER['HTTP_USER_AGENT'];
        $ip     = $_SERVER['REMOTE_ADDR'];
        $hashId = md5($agent . $ip);

        $au = AnonymousUser::where('hash_id', $hashId)->first();

        if (!$au) {
            $au = new AnonymousUser();
            $au->hash_id = $hashId;
            $au->save();
        }

        return $au->id;

    }
}