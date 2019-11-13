<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AnonymousUser;
use App\Models\Reaction;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * Class ReactionController
 * @package App\Http\Controllers\Auth
 */
class ReactionController extends Controller
{
    /**
     * @group Reaction
     * API for create a reaction for a video
     * @bodyParam type int required The type of reaction. (must be in array [1,2,3,4, 5]. 1: REED, 2: HARMONIZED, 3: EXPRESSIVE, 4: RHYTHM, 5: CARE (消さないで！). Example: 1
     * @bodyParam device_id string required The  id of device. Example: 1
     * @bodyParam user_id int option The user of reaction if user already login please sent token on header. Example: 1
     * @response {
     * "status": true,
     * "reaction_id": 1
     * }
     * @response 404 {
     * "status": false,
     * "errors": {
     * "code": -1,
     * "msg": "User already Reaction"
     * }
     * }
     */
    public function createReaction(Request $request, $id)
    {
        if (!Request::has('type')) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'type of action is required'
            );

            return response()->json($data, 200);
        }

        if (!Request::has('device_id')) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'device_id of action is required'
            );

            return response()->json($data, 200);
        }

        $input = $request::all();

        $device_id = $input['device_id'];
        $type = $input['type'];
        if (!in_array($type, Reaction::TYPE)) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'type of action is not valid'
            );

            return response()->json($data, 200);
        }

        $video = Video::find($id)->first();

        if (!$video) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'Video id not valid'
            );

            return response()->json($data, 200);
        }

        if ($user = Auth::user()) {
            $reaction = Reaction::where('video_id', $id)->where('type', $input['type'])
                ->where('user_id', $user['id'])->where('auth_type', Reaction::AUTH_USER)->first();

            if ($reaction) {
                $data['status'] = false;
                $data['errors'] = array(
                    'code' => -1,
                    'msg'  => 'User already Reaction'
                );

                return response()->json($data, 200);
            }

            $reaction = new Reaction();

            $reaction->video_id     = $id;
            $reaction->user_id      = $user['id'];
            $reaction->type         = $input['type'];
            $reaction->auth_type    = Reaction::AUTH_USER;

            $reaction->save();

            $data['status'] = true;

            return response()->json($data, 200);
        }

        $auId = $this->getAnonymousUserId($device_id);

        $reaction = Reaction::where('video_id', $id)->where('type', $input['type'])
            ->where('user_id', $auId)->where('auth_type', Reaction::ANONYMOUS_USER)->first();

        if ($reaction) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -1,
                'msg'  => 'User already Reaction'
            );

            return response()->json($data, 200);
        }

        $reaction = new Reaction();

        $reaction->video_id     = $id;
        $reaction->user_id      = $auId;
        $reaction->type         = $input['type'];
        $reaction->auth_type    = Reaction::ANONYMOUS_USER;

        $reaction->save();

        $data['status'] = true;
        $data['reaction_id'] = $reaction->id;
        return response()->json($data, 200);

    }

    /**
     * @group Reaction
     * API for destroy a reaction.
     * @queryParam device_id required The  id of device. Example: 1
     * @response {
     * "status": true
     * }
     */

    public function destroyReaction(Request $request,$id)
    {
        if (!Request::has('device_id')) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'device_id of action is required'
            );

            return response()->json($data, 200);
        }

        $input = $request::all();
        $device_id = $input['device_id'];

        $authType = Reaction::ANONYMOUS_USER;
        if (Auth::user()) {
            $authType = Reaction::AUTH_USER;
            $userId = Auth::user()['id'];
        } else {
            $userId = $this->getAnonymousUserId($device_id);
        }

        Reaction::where('id', $id)->where('user_id', $userId)->where('auth_type', $authType)->delete();

        $data['status'] = true;
        return response()->json($data, 200);

    }

    /**
     * @group Reaction
     * API for get list reaction of a video
     * @queryParam device_id required The  id of device. Example: 1
     * @response {
     * "status": true,
     * "reactions" : [
     *  {
     *  "type" : "1",
     *  "count": "4",
     *  "user_reaction": {"status":false, "reaction_id": -1}
     * },
     * {
     * "type" : "2",
     *  "count": "4",
     *  "user_reaction": {"status":true, "reaction_id": 1}
     * },
     *  {
     *  "type" : "3",
     *  "count": "20",
     *  "user_reaction": {"status":true, "reaction_id": 3}
     * },
     * {
     * "type" : "4",
     *  "count": "10",
     *  "user_reaction": {"status":true, "reaction_id": 5}
     * }
     * , {
     *  "type" : "5",
     *  "count": "100",
     *  "user_reaction": {"status":true, "reaction_id": 7}
     * }
     * ]
     * }
     */
    public function getListReaction(Request $request, $id)
    {
        if (!Request::has('device_id')) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'device_id of action is required'
            );

            return response()->json($data, 200);
        }

        $input = $request::all();
        $device_id = $input['device_id'];

        $video = Video::find($id)->first();

        if (!$video) {
            $data['status'] = false;
            $data['errors'] = array(
                'code' => -100,
                'msg'  => 'Video id not valid'
            );

            return response()->json($data, 200);
        }

        $data['status'] = true;
        $data['reactions'] = $this->getListReactionCount($id, $device_id);

        return response()->json($data, 200);
    }

    private function getAnonymousUserId($device_id)
    {
        $agent  = $device_id;
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

    /**
     * @param $videoId
     * @return array
     */
    private function getListReactionCount($videoId, $device_id)
    {
        $authType = Reaction::ANONYMOUS_USER;
        if (Auth::user()) {
            $authType = Reaction::AUTH_USER;
            $userId = Auth::user()['id'];
        } else {
            $userId = $this->getAnonymousUserId($device_id);
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
                "user_reaction" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_REED, $authType),
            ],
            [
                "type"  => Reaction::TYPE_HARMONIZED,
                "count" => $countHar,
                "user_reaction" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_HARMONIZED, $authType),
            ],
            [
                "type"  => Reaction::TYPE_EXPRESSIVE,
                "count" => $countEx,
                "user_reaction" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_EXPRESSIVE, $authType),
            ],
            [
                "type"  => Reaction::TYPE_RHYTHM,
                "count" => $countRH,
                "user_reaction" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_RHYTHM, $authType),
            ],
            [
                "type"  => Reaction::TYPE_CARE,
                "count" => $countCA,
                "user_reaction" => $this->getReactionStatus($videoId, $userId, Reaction::TYPE_CARE, $authType),
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
}