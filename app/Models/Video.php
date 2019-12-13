<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Video
 * @package App\Models
 */
class Video extends BaseModel
{
    use SoftDeletes;

    protected $table ="videos";

    const DEFAULT_COMENT_TEXT = [
        "対バンしませんか？",
        "一緒に練習しませんか？"
    ];

    const BUTTON_DEFAULT_TEXT = "❤️を押せば動画が時間を経過しても自動で削除されないよ、ぜひ押してね！";

    protected $fillable = [
        'user_id',
        'title',
        'name',
        'artist',
        'type',
        'thumbnail_url',
        'video_url'
    ];
}
