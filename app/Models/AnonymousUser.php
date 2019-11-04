<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class AnonymousUser extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'anonymous_users';
}