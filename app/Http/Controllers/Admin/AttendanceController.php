<?php
//admin
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Housemaker;
use App\Site;
use App\User;
use Storage;
//use App\User;

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
        $housemaker = new Housemaker;
        
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
        
        if (isset($user_form['icon_path'])){
          $path = Storage::disk('s3')->putFile('/',$user_form['image'],'icon_path');
          $user->icon_path = Storage::disk('s3')->url($path);
        } else {
            $user->icon_path = null;
        }
        unset($news_form['image']);
        
        $user->fill($user_form);
        $user->is_admin = 0; //従業員＝０
        $user->save();
        
        return redirect('admin/users');
    }
    
    public function users() //従業員一覧
    {
        //
        return view('admin.attendancerecord.users');
    }
    
    //get従業員編集は従業員画面と共通
    //post従業員編集は従業員画面と共通
    
    public function add_new_attendancerecord() //get勤務記録登録
    {
        return view('admin.attendancerecord.new');
    }
    
    public function new_attendancerecord() //post勤務記録登録
    {
        //
    }
    
    public function attendancerecords() //勤務記録一覧
    {
        //
    }
    
    public function approval() //申請一覧
    {
        //
    }
    
}