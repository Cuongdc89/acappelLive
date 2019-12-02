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
