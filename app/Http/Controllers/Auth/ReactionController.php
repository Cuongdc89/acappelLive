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
     * @bodyParam type int require The type of reaction (must be in array [1,2,3,4]. 1: REED, 2: HARMONIZED, 3: EXPRESSIVE, 4: RHYTHM. Example: 1
     * @response {
     * "status": true
     * }
     * @response Errors {
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

        $input = $request::all();

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

        $auId = $this->getAnonymousUserId();

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
        return response()->json($data, 200);

    }

    /**
     * @group Reaction
     * API for destroy a reaction.
     * @response {
     * "status": true
     * }
     */

    public function destroyReaction($id)
    {
        $authType = Reaction::ANONYMOUS_USER;
        if (Auth::user()) {
            $authType = Reaction::AUTH_USER;
            $userId = Auth::user()['id'];
        } else {
            $userId = $this->getAnonymousUserId();
        }

        Reaction::where('id', $id)->where('user_id', $userId)-where('auth_type', $authType)->delete();

        $data['status'] = true;
        return response()->json($data, 200);

    }

    /**
     * @group Reaction
     * API for get list reaction of a video
     * @response {
     * "status": true,
     * "reactions" : [
     *  {
     *  "type" : "1",
     *  "count": "4",
     *  "reaction_status": true
     * },
     * {
     *  "type" : "2",
     *  "count": "3",
     *  "reaction_status": true
     * },
     * {
     *  "type" : "3",
     *  "count": "6",
     *  "reaction_status": false
     * },
     * {
     *  "type" : "4",
     *  "count": "0",
     *  "reaction_status": false
     * },
     * ]
     * }
     */
    public function getListReaction($id)
    {
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
        $data['reactions'] = $this->getListReactionCount($id);

        return response()->json($data, 200);
    }
    
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
}