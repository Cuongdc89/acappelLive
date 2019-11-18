<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 05/11/2019
 * Time: 11:09
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Video;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
/**
 * Class CommentController
 * @package App\Http\Controllers\Auth
 */
class CommentController extends Controller
{
    /**
     * @group Comments
     * API for get list comments of a video
     * @queryParam page int option this field use to filter what page client want to get.( default 10 video for 1 page): Example: 1
     * @response {
     * "status": true,
     * "comments": [{
     * "id": 1,
     * "user_id": 2,
     * "video_id": 1,
     * "comment_text": "this is a comment",
     * "deleted_at": null,
     * "created_at": "2019-11-04 08:45:04",
     * "updated_at": "2019-11-04 08:45:04",
     * "user": {
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
     * "user": {
     * "id": 1,
     * "name": "Cuongdc",
     * "email": "do.cao.cuong@alliedtechbase.com",
     * "created_at": "2019-10-23 04:01:24",
     * "updated_at": "2019-10-23 04:01:24",
     * "profile_picture_url": null
     * }
     * }
     * ],
     * "meta_data": {
     * "total": 0,
     * "paging": {
     * "current_page": 1,
     * "last_page": 0,
     * "per_page": 10,
     * "from": 0,
     * "to": 0
     * }
     * }
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

        $query = Comment::where('video_id', $id);
        $total = $query->count();

        $input = $request::all();
        $currentPage    = isset($input['page']) ? $input['page'] : 1;
        $lastPage       = ceil($total / static::DEFAULT_PAGE_SIZE);

//        if ($currentPage > $lastPage) {
//            $currentPage = $lastPage;
//        }
        
        if ($currentPage <= 0 ) {
            $currentPage = 1;
        }

        $offsetFrom     = (($currentPage - 1) * static::DEFAULT_PAGE_SIZE);
        $offsetTo       = ($lastPage > $currentPage) ? $currentPage * static::DEFAULT_PAGE_SIZE : $total;
        $query->orderBy('created_at', static::ORDER_BY_DESC);
        $query->offset($offsetFrom);
        $query->limit(static::DEFAULT_PAGE_SIZE);

        $comments = $query->get();
        foreach ($comments as $comment) {
            $comment->user = User::where('id', $comment->user_id)->get()->first();
            $data['comments'][] = $comment;
        }

        $data['meta_data'] = [
            'total'         => $total,
            'paging'        => [
                'current_page'  => (int) $currentPage,
                'last_page'     => $lastPage,
                'per_page'      => static::DEFAULT_PAGE_SIZE,
                'from'          => $offsetFrom,
                'to'            => $offsetTo,
            ]
        ];

        return response()->json($data, 200);
    }

    /**
     * @group Comments
     * API for create a comment for a video
     * @authenticated
     * @bodyParam comment_text string required comment content for video. Example: Comment content for video.
     * @response {
     * "status": true,
     * "comment": {
     * "user_id": 2,
     * "video_id": 1,
     * "comment_text": "this is a comment too",
     * "updated_at": "2019-11-04 08:45:17",
     * "created_at": "2019-11-04 08:45:17",
     * "id": 2,
     * "user": {
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

        $video = Video::where('id', $id)->first();

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

        $comment->user   = User::where('id', $comment->user_id)->get()->first();
        $data['comment'] = $comment;
        $data["status"]  = true;

        return response()->json($data, 200);
    }
}