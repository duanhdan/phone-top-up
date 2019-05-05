<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    protected $table = 'topup';

    protected $fillable = [
        'user_id','parent_id','telco_id','upload_id','mobile','amount','type','status','result'
    ];

    public static function getListTopup($params = array()){
    	$topup = Topup::orderBy('id','desc');

    	if(!empty($params['telco'])){
    		$topup->where('telco_id',(int)$params['telco']);
    	}

    	if(!empty($params['mobile'])){
    		$topup->where('mobile',$params['mobile']);
    	}

    	if(!empty($params['type'])){
    		$topup->where('type',(int)$params['type']);
    	}

    	if(!empty($params['user_id'])){
    		$topup->where('user_id',(int)$params['user_id']);
    	}

    	if(!empty($params['upload_id'])){
    		$topup->where('upload_id',(int)$params['upload_id']);
    	}

    	if(isset($params['status'])){
    		$topup->where('status',(int)$params['status']);
    	}
    	return $topup->paginate(20);
    }

    public static function getTotalAmountTopup($params = array()){
    	
    	if(isset($params['status'])){
    		$topup = Topup::where('status',(int)$params['status']);
    	} else {
    		$topup = Topup::orderBy('id', 'desc');
    	}
    	if(!empty($params['telco'])){
    		$topup->where('telco_id',(int)$params['telco']);
    	}

    	if(!empty($params['mobile'])){
    		$topup->where('mobile',$params['mobile']);
    	}

    	if(!empty($params['type'])){
    		$topup->where('type',(int)$params['type']);
    	}

    	if(!empty($params['user_id'])){
    		$topup->where('user_id',(int)$params['user_id']);
    	}

    	if(!empty($params['upload_id'])){
    		$topup->where('upload_id',(int)$params['upload_id']);
    	}

    	
    	return $topup->sum('amount');
    }
}
