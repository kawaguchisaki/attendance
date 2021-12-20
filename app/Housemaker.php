<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Housemaker extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'housemaker_name' => 'required',
    );
    
    public function getGetHelpAttribute($value){
        return $value == 1 ? "応援現場" : " "; //一覧表示画面で０１で表示されないように設定
    }
}
