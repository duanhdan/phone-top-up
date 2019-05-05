<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $fillable = [
        'user_id', 'parent_id', 'file','discount','type'
    ];

    public static function getListUpload($params = array()){

    	$upload = Upload::orderBy('id', 'desc');
        if(!empty($params['type'])){
            $upload->where('type',(int)$params['type']);
        }
        return  $upload->paginate(20);
    	
    }

    public static function getTotalAmountUpload($params = array()){
    	
    	$upload = Upload::orderBy('id', 'desc');
        if(!empty($params['type'])){
            $upload->where('type',(int)$params['type']);
        }
    	
    	return $upload->sum('total_price');
    }
}
