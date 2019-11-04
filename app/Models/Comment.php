<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 04/11/2019
 * Time: 15:24
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App\Models
 */
class Comment extends BaseModel
{
    use SoftDeletes;

    protected $table ="comments";

    protected $fillable = [
        'user_id',
        'video_id',
        'comment_text'
    ];
}