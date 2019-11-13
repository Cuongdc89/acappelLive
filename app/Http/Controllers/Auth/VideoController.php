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

    /**
     * @group Videos
     * API for user upload video
     * @authenticated
     * @bodyParam title string required the title  of video max 100. Example: video1
     * @bodyParam file file required this data is video file for upload. Example:"video file"
     * @bodyParam thumbnail_image string required  data formart mustbe base64_endcode of image file. Example: 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
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
     * "thumbnail_url": "http://34.87.16.238/avatars/image_1573625594.png",
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

            if (!Request::has('file')) {
                $data["status"] = false;
                $data["errors"] = array(
                    "code" => -2,
                    "msg" => "※動画を必ずアップロードしてください"
                );

                return response()->json($data, 200);
            }

            $file = Request::file('file');
            $mime = $file->getMimeType();

            if (!strstr($mime, "video/")){
                $data["status"] = false;
                $data["errors"] = array(
                    "code" => -2,
                    "msg" => "file not correct video type"
                );

                return response()->json($data, 200);
            }

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

            if (Request::has("thumbnail_image")) {
                $url = $this->createImageFromBase64($input['thumbnail_image']);
                if ($url) {
                    $video->thumbnail_url = $url;
                }
            }

            $video->save();
            $video->user = $user;

            $data['video'] = $video;
            $data["status"] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data["status"] = false;
            $data["msg"] = $e->getMessage();
            return response()->json($data, 200);
        }
    }
    
    /**
     * @group Videos
     * API for get list videos
     * @queryParam page int option this field use to filter what page client want to get ( default 10 video for 1 page). Example: 1
     * @queryParam type int option this field use to filter type of video. Example: 2
     * @queryParam user_id int option this field use to filter list video upload by an user. Example: 2
     * @queryParam search string option this field use to filter tilte of video. Example: abc
     * @response {
     * "status": true,
     * "videos": [
     * {
     * "id": 1,
     * "user_id": 2,
     * "title": "do.cao.cuong1@alliedtechbase.com",
     * "name": null,
     * "type": 2,
     * "view_count": 100,
     * "thumbnail_url": null,
     * "video_url": "http://127.0.0.1:8000/uploads/1572854724_download (7).jpeg",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:05:24",
     * "updated_at": "2019-11-04 08:05:24",
     * "user": {
     * "id": 2,
     * "name": "Cuongdc123",
     * "email": "do.cao.cuong1@alliedtechbase.com",
     * "created_at": "2019-10-23 04:15:26",
     * "updated_at": "2019-11-04 07:39:14",
     * "profile_picture_url": "http://127.0.0.1:8000/avatars/image_1572853154.png"
     * },
     * "reactions":[
     * {"type": 1, "count": 1, "reaction_status": true},
     * {"type": 2, "count": 1, "reaction_status": true},
     * {"type": 3, "count": 0, "reaction_status": false},
     * {"type": 4, "count": 0, "reaction_status": false},
     * {"type": 5, "count": 0, "reaction_status": false}
     * ]
     * },
     * {
     * "id": 2,
     * "user_id": 2,
     * "title": "do.cao.cuong1@alliedtechbase.com",
     * "name": null,
     * "type": 2,
     * "view_count": 100,
     * "thumbnail_url": null,
     * "video_url": "http://127.0.0.1:8000/uploads/1572854727_download (7).jpeg",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:05:27",
     * "updated_at": "2019-11-04 08:05:27",
     * "user": {
     * "id": 2,
     * "name": "Cuongdc123",
     * "email": "do.cao.cuong1@alliedtechbase.com",
     * "created_at": "2019-10-23 04:15:26",
     * "updated_at": "2019-11-04 07:39:14",
     * "profile_picture_url": "http://127.0.0.1:8000/avatars/image_1572853154.png"
     * },
     * "reactions":[
     * {"type": 1, "count": 1, "reaction_status": true},
     * {"type": 2, "count": 1, "reaction_status": true},
     * {"type": 3, "count": 0, "reaction_status": false},
     * {"type": 4, "count": 0, "reaction_status": false},
     * {"type": 5, "count": 0, "reaction_status": false}
     * ]
     * }
     * ],
     * "meta_data": {
     * "total": 2,
     * "paging": {
     * "current_page": 1,
     * "last_page": 1,
     * "per_page": 10,
     * "from": 0,
     * "to": 2
     * }
     * }
     * }
     */
    public function getListVideos(Request $request)
    {
        $input = $request::all();
        $query = Video::where('id', '<>', 0);
        
        if (isset($input['user_id']) && $input['user_id'] > 0) {
            $query->where('user_id', $input['user_id']);
        }

        if (isset($input['search'])) {
            $query->where('videos.title', 'LIKE',  "%{$input['search']}%");
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

        $query->orderBy('created_at', static::ORDER_BY_DESC);
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
        $video = Video::where('id', $id)->first();
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

        $countReed  = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_REED)->count();
        $countHar   = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_HARMONIZED)->count();
        $countEx    = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_EXPRESSIVE)->count();
        $countRH    = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_RHYTHM)->count();
        $countCA    = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_CARE)->count();
        $countShare = Reaction::where('video_id', $videoId)->where('type', Reaction::TYPE_SHARE)->count();

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
            ],
            [
                "type"  => Reaction::TYPE_SHARE,
                "count" => $countShare,
                "user_reaction" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_SHARE, $authType),
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
    private function getReactionStatus($videoId, $userId, $type, $authType)
    {
        $reaction = Reaction::where('video_id', $videoId)->where('type', $type)
            ->where('user_id', $userId)->where('auth_type', $authType)->first();

        if ($reaction) {
            $data["status"] = true;
            $data["reaction_id"] = $reaction->id;

            return $data;
        }

        $data["status"] = false;
        $data["reaction_id"] = -1;

        return $data;
    }

    /**
     * @return mixed
     */
    private function getAnonymousUserId()
    {
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