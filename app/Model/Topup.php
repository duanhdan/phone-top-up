<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = 'topup';

    protected $fillable = [
        'user_id','parent_id','telco_id','upload_id','mobile','amount','type','status','result'
    ];
}
