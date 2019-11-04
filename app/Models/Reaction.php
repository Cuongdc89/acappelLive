<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Reaction
 * @package App\Models
 */
class Reaction extends BaseModel
{
    use SoftDeletes;

    protected $table ="reactions";

    const TYPE_REED       = 1; //リード
    const TYPE_HARMONIZED = 2; //ハモリ
    const TYPE_EXPRESSIVE = 3; //表現力
    const TYPE_RHYTHM     = 4; //リズム

    const AUTH_USER         = 1; // auth user
    const ANONYMOUS_USER    = 2; //

    const TYPE = array(
        self::TYPE_REED,
        self::TYPE_HARMONIZED,
        self::TYPE_EXPRESSIVE,
        self::TYPE_RHYTHM
    );

    protected $fillable = [
        'video_id',
        'user_id',
        'type',
        'auth_type'
    ];
}