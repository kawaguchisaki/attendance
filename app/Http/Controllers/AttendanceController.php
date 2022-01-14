<?php
//user
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Housemaker;
use App\Site;
use App\User;
use App\Attendance;
use Storage;
use App\Rules\Hankaku;

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
    
    public function mypage() //マイページ
    {
        return view('attendancerecord.mypage', ['user' => Auth::user()]);
    }
    
    public function update_user(Request $request) //post従業員編集
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => ['required', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => [new Hankaku, 'min:8', 'unique:users'],
            ]);
        
        if(empty($request->password)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $user->password;
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
        }
        
        $user->is_admin = 0; //従業員＝０
        $user->save();
        
        return redirect('user/home');
    }
    
    public function add_new_attendancerecord() //get勤務登録申請
    {
        return view('attendancerecord.new', ['sites' => Site::all(),'housemakers' => Housemaker::all()]);
    }
    
    public function new_attendancerecord(Request $request) //post勤務登録申請
    {
        $this->validate($request, Attendance::$rules);
        
        $attendance = new Attendance();
        
        $attendance->date = $request->date;
        
        
        $saved_user = User::where('name', $request->user)->first();
        $attendance->user_id = $saved_user->id;
    
        $saved_site = Site::where('name', $request->site)->first();
        $attendance->site_id = $saved_site->id;
        $attendance->housemaker_id = $saved_site->housemaker_id;
        
        
        
        
        $attendance->work_time = $request->work_time;
        if(isset($attendance['work_time'])){
            if($request->work_time == 8){
                $attendance->work_time = 8;
            } else {
                $attendance->work_time = 4;
            }
        }
        
        $attendance->approval_status = 0;
        
        $attendance->save();
        
        return redirect('/attendancerecords');
    }
    
    public function attendancerecords() //勤務記録一覧
    {
        $attendances = Attendance::where('user_id', Auth::user()->id)->get();
        return view('attendancerecord.attendancerecords', ['attendances' => $attendances]);
    }
    
    public function edit_attendancerecord(Request $request) //get勤務記録編集申請
    {
        $attendance = Attendance::find($request->id);
        $thisUser = User::where('id',$attendance->user_id)->first();
        $thisSite = Site::where('id',$attendance->site_id)->first();
        
        if(empty($attendance)) {
            abort(404);
        }
        
        return view('attendancerecord.edit_attendancerecord', ['attendance' => $attendance, 'users' => User::all(), 'sites' => Site::all(), 'housemakers' => Housemaker::all(), 'thisUser' => $thisUser, 'thisSite'=> $thisSite]);
    }
    
    public function update_attendancerecord() //post勤務記録編集申請
    {
        return redirect('/attendancerecords');
    }
}
