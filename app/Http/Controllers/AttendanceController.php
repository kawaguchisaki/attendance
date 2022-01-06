<?php
//user
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Housemaker;
use App\Site;
use App\User;
use App\Attendance;
use Storage;

class AttendanceController extends Controller
{
    //
    
    public function home() //userホーム
    {
        return view('attendancerecord.home', ['attendances' => Attendance::all()]);
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
    
    public function add_new_attendancerecord() //get勤務登録申請
    {
        return view('attendancerecord.new', ['sites' => Site::all(),'housemakers' => Housemaker::all()]);
    }
    
    public function new_attendancerecord() //post勤務登録申請
    {
        return redirect('/attendancerecords');
    }
    
    public function attendancerecords() //勤務記録一覧
    {
        $attendances = Attendance::where('user_id', Auth::user()->id)->get();
        return view('attendancerecord.attendancerecords', ['attendances' => $attendances]);
    }
    
    public function edit_attendancerecord() //get勤務記録編集申請
    {
        $attendance = Attendance::find($request->id);
        $thisUser = User::where('id',$attendance->user_id)->first();
        $thisSite = Site::where('id',$attendance->site_id)->first();
        
        if(empty($attendance)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.edit_attendancerecord', ['attendance' => $attendance, 'users' => User::all(), 'sites' => Site::all(), 'housemakers' => Housemaker::all(), 'thisUser' => $thisUser, 'thisSite'=> $thisSite]);
    }
    
    public function update_attendancerecord() //post勤務記録編集申請
    {
        return redirect('/attendancerecords');
    }
}
