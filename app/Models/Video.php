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

    const BUTTON_DEFAULT_TEXT = "♡を押して \n動画を「自動削除」から守ろう！\n※動画は一定期間経過後、\n自動的に削除されてしまいます。";

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
