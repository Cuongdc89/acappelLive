<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 05/11/2019
 * Time: 13:43
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Support\Facades\Request;

class ViewController extends Controller
{
    /**
     * @group Videos
     * API for create a view for a video
     * @response {
     *  "status":  true
     * }
     */
    public function updateVideoViewCount(Request $request, $id)
    {
        if (!$id) {
            $data["status"] = false;

            return response()->json($data, 200);
        }

        $video = Video::find($id)->first();
        $video->view_count = $video->view_count + 1;
        $video->save();

        $data["status"] = true;

        return response()->json($data, 200);
    }
}