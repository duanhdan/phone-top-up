<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $fillable = [
        'user_id', 'parent_id', 'file','discount','type'
    ];
}
