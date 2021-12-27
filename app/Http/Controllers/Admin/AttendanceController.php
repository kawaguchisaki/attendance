<?php
//admin
namespace App\Http\Controllers\Admin;

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
    public function add_new_site() //get現場登録
    {
        return view('admin.attendancerecord.new_site', ['housemakers'=> Housemaker::all()]);
    }
    
    public function new_site(Request $request) //post現場登録
    {
        $this->validate($request, Site::$rules);
        $this->validate($request, Housemaker::$rules);
        
        $site = new Site;
        
        
        $saved_housemaker = Housemaker::where('name', $request->housemaker_name)->first(); //hosemakersテーブルでnameを検索、フォームから送られてきたhousemaker_nameと一致するものがあればそれを代入
        if($saved_housemaker){
            $site->name = $request->site_name;
            $site->housemaker_id = $saved_housemaker->id; //housemakersテーブルにある既存のデータのidを$site->housemaker_idとし、
            $site->save();
        }else {
            $housemaker = new Housemaker;
            $housemaker->name = $request->housemaker_name;
            $housemaker->get_help = $request->get_help;
            $housemaker->get_help = isset($housemaker['get_help']); //$housemaker->get_helpがtrueの場合(チェックが入ってる場合)true=1を代入、そうでなければfalse=0を代入
            $housemaker->save(); //foreach外でセットした値と一緒にhousemakersテーブルに保存
            $site->name = $request->site_name;
            $site->housemaker_id = $housemaker->id; //else内で保存されたhouswmakersテーブルのidをsitesテーブルのhousemaker_idにセット
            $site->save();
        }
        
        return redirect('admin/sites');
    }
    
    public function home() //adminホーム
    {
        return view('admin.attendancerecord.home');
    }
    
    public function sites() //現場一覧
    {
        $sites = Site::all();
        $housemakers = Housemaker::all();
        
        return view('admin.attendancerecord.sites',['sites' => $sites , 'housemakers' => $housemakers]);
    }
    
    public function edit_site(Request $request) //get現場情報編集
    {
        $site = Site::find($request->id);
        
        if (empty($site)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.edit_site', ['site' => $site, 'housemakers'=> Housemaker::all()]);
    }
    
    public function update_site(Request $request) //post現場情報編集
    {
        $this->validate($request, Site::$rules);
        $this->validate($request, Housemaker::$rules);
        
        $site = Site::find($request->id);
        
        $saved_housemaker = Housemaker::where('name', $request->housemaker_name)->first(); //hosemakersテーブルでnameを検索、フォームから送られてきたhousemaker_nameと一致するものがあればそれを代入
        if($saved_housemaker){
            $site->name = $request->site_name;
            $site->housemaker_id = $saved_housemaker->id; //housemakersテーブルにある既存のデータのidを$site->housemaker_idとし、
            $site->save();
        }else {
            $housemaker->name = $request->housemaker_name;
            $housemaker->get_help = $request->get_help;
            $housemaker->get_help = isset($housemaker['get_help']); //$housemaker->get_helpがtrueの場合(チェックが入ってる場合)true=1を代入、そうでなければfalse=0を代入
            $housemaker->save(); //foreach外でセットした値と一緒にhousemakersテーブルに保存
            $site->name = $request->site_name;
            $site->housemaker_id = $housemaker->id; //else内で保存されたhouswmakersテーブルのidをsitesテーブルのhousemaker_idにセット
            $site->save();
        
        }
        
        return redirect('admin/sites');
    }
    
    public function delete_site(Request $request) //現場情報削除
    {
        $site = Site::find($request->id);
        $site->delete();
        return redirect('admin/sites');
    }
    
    public function add_new_user() //get従業員登録
    {
        return view('admin.attendancerecord.new_user');
    }
    
    public function new_user(Request $request) //post従業員登録
    {
        $this->validate($request, User::$rules);
        
        $user = new User;
        $user_form = $request->all();
        
        if (isset($user_form['icon_path'])) {
            $path = $request->file('icon_path')->store('public/icon_path');
            $user->icon_path = basename($path);
        } else {
            $user->icon_path = null;
        }
        
        unset($user_form['icon_path']);
        
        /*
        if (isset($user_form['icon_path'])){
          $path = Storage::disk('s3')->putFile('/',$user_form['image'],'icon_path');
          $user->icon_path = Storage::disk('s3')->url($path);
        } else {
            $user->icon_path = null;
        }
        unset($user_form['icon_path']);
        */
        $user->fill($user_form);
        $user->is_admin = 0; //従業員＝０
        $user->save();
        
        return redirect('admin/users');
    }
    
    public function users() //従業員一覧
    {
        $users = User::all();
        
        return view('admin.attendancerecord.users',['users' => $users]);
    }
    
    public function edit_user(Request $request) //get従業員編集
    {
        $user = User::find($request->id);
        
        if(empty($user)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.edit_user',['user' => $user]);
    }
    
    public function update_user(Request $request) //post従業員編集
    {
        $this->validate($request, User::$rules);
        
        $user = User::find($request->id);
        
        //
        
        return redirect('admin/users');
    }
    
    public function add_import() //getCSVからインポート
    {
        return view('admin.attendancerecord.import');
    }
    
    public function import() //postCSVからインポート
    {
        return redirect('admin/users');
    }
    
    
    public function delete_user(Request $request) //従業員削除
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect('admin/users');
    }
    
    public function add_new_attendancerecord(Request $request) //get勤務記録登録
    {
        
        
        return view('admin.attendancerecord.new',['users' => User::all(), 'sites' => Site::all(),'housemakers' => Housemaker::all()]);
    }
    
    public function new_attendancerecord(Request $request) //post勤務記録登録
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
        
        $attendance->approval_status = 1;
        
        $attendance->save();
        
        return redirect('admin/attendancerecords');
    }
    
    public function attendancerecords(Request $request) //勤務記録一覧
    {
        $users = User::all();
        
        
        $cond_user = User::find($request->cond_user);
        if($cond_user != ''){
            
            $attendances = Attendance::where('user_id', $cond_user->id)->get();
        } else {
            $attendances = Attendance::all();
        }
        
        return view('admin.attendancerecord.attendancerecords',['users' => $users, 'cond_user' => $cond_user, 'attendances' => $attendances]);
    }
    
    public function edit_attendancerecord(Request $request) //get勤務記録編集
    {
        
        $attendance = Attendance::find($request->id);
        $this_user = User::where('id',$attendance->user_id)->get();
        
        if(empty($attendance)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.edit_attendancerecord', ['attendance' => $attendance, 'users' => User::all(), 'sites' => Site::all(), 'housemakers' => Housemaker::all(), 'this_user' => $this_user]);
    }
    
    public function update_attendancerecord(Request $request) //post勤務記録編集
    {
        $this->validate($request, Attendance::$rules);
        
        $attendance = Attendance::find($request->id);
        
        $attendance->date = $request->date;
        
        $saved_user = User::find($request->user);
        $attendance->user_id = $saved_user->id;
        
        $saved_site = Site::find($request->site);
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
        
        $attendance->approval_status = 1;
        
        $attendance->save();
        
        return redirect('admin/attendancerecords');
    }
    
    public function delete_attendancerecord(Request $request)
    {
        $attendance = Attendance::find($request->id);
        $attendance->delete();
        return redirect('admin/attendancerecords');
    }
    
    public function approval() //申請一覧
    {
        //
    }
    
}