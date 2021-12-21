<?php
//user
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Housemaker;
use App\Site;
use App\User;
use Storage;

class AttendanceController extends Controller
{
    //
    
    public function home() //userホーム
    {
        return view('attendancerecord.home');
    }
    
    public function sites() //現場一覧
    {
        $sites = Site::all();
        $housemakers = Housemaker::all();
        
        return view('attendancerecord.sites',['sites' => $sites , 'housemakers' => $housemakers]);
    }
    
    public function edit_user(Request $request) //get従業員編集
    {
        $user = Auth::user();
        return view('attendancerecord.edit_user',['user' => $user]);
    }
    
    public function update_user() //post従業員編集
    {
        //
        return redirect('user/home');
    }
    /*
    public function new_attendancerecord()
    {
        //勤務登録申請
    }
    
    public function attendancerecords()
    {
        //勤務記録一覧
    }
    
    public function edit_attendancerecord()
    {
        //勤務記録編集申請
    }
    */ 
}
