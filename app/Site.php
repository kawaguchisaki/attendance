<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'site_name' => 'required',
    );
    
    public function house_maker(){
        return $this->belongsTo('App\Housemaker','housemaker_id'); //現場一覧画面でsitesテーブルに保存されたhousemaker_idをhousemakersテーブルに変換して表示するための設定
    }
}
