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
    
    public function getWorkTimeAttribute($value){
        switch($value){
            case 8:
                return "１日";
                break;
            case 4:
                return "半日";
                break;
            default:
                return $value."時間";
        }
        //一覧表示画面でで表示されないように設定
    }
    
    /*
    public function getCalendarDates($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);
        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $date->subDay($date->dayOfWeek);
        // 同上。右下の隙間のための計算。
        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $dates = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            // copyしないと全部同じオブジェクトを入れてしまうことになる
            $dates[] = $date->copy();
        }
        return $dates;
    }
    */
}
