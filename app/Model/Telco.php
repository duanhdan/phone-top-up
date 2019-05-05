<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Telco extends Model
{
    protected $table = 'telco';

    protected $fillable = [
        'name', 'code', 'status'
    ];
}
