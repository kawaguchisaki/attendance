<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'date' => 'required',
        'user' => 'required',
        'site' => 'required',
    );
    
    public function user(){
        return $this->belongsTo('App\User','user_id'); //attendancesテーブルはusersテーブルと１：多
    }
    
    public function site(){
        return $this->belongsTo('App\Site','site_id'); //attendancesテーブルはsitesテーブルと１：多
    }
    
    public function house_maker(){
        return $this->belongsTo('App\Housemaker','housemaker_id'); //attendancesテーブルはhousemakersテーブルと１：多
    }
    
    public function getWorkTimeStringAttribute(){//ここで$valueを渡してしまうと勤務日数計算のときに１日、半日がここで上書きされてしまい、整数として計算ができない。
        switch($this->work_time){
            case 8:
                return "１日";
                break;
            case 4:
                return "半日";
                break;
            default:
                return $this->work_time."時間";
        }
        //一覧表示画面でで表示されないように設定
    }
    
    public function getApprovalStatusAttribute($value){
        return $value == 1 ? " " : "申請中"; //一覧表示画面で０１で表示されないように設定
    }
}
