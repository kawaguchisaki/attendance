<?php
//admin
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use Illuminate\Support\Facades\Hash;
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
            $site->housemaker_id = $saved_housemaker->id; //housemakersテーブルにある既存のデータのidを$site->housemaker_idとする
            if ($request->input('get_help') == 'on') { //checkboxがon=チェックされたら
                $saved_housemaker->get_help = 1;
            } else {
                $saved_housemaker->get_help = 0;
            }
            $saved_housemaker->save();
            $site->save();
        }else {
            $housemaker = new Housemaker;
            $housemaker->name = $request->housemaker_name;
            if ($request->input('get_help') == 'on') {
                $housemaker->get_help = 1;
            } else {
                $housemaker->get_help = 0;
            }
            $housemaker->save(); //foreach外でセットした値と一緒にhousemakersテーブルに保存
            $site->name = $request->site_name;
            $site->housemaker_id = $housemaker->id; //else内で保存されたhouswmakersテーブルのidをsitesテーブルのhousemaker_idにセット
            $site->save();
        }
        
        return redirect('admin/sites');
    }
    
    public function home() //adminホーム
    {
        $approval_0_attendances = Attendance::where('approval_status', 0)->get();
        
        return view('admin.attendancerecord.home', ['approval_0_attendances' => $approval_0_attendances]);
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
        $the_housemaker = Housemaker::find($site->housemaker_id);
        
        if (empty($site)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.edit_site', ['site' => $site, 'housemakers'=> Housemaker::all(), 'the_housemaker' => $the_housemaker]);
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
            if ($request->input('get_help') == 'on') {
                $saved_housemaker->get_help = 1;
            } else {
                $saved_housemaker->get_help = 0;
            }
            $saved_housemaker->save();
            $site->save();
        }else {
            $housemaker = new Housemaker;
            $housemaker->name = $request->housemaker_name;
            if ($request->input('get_help') == 'on') {
                $housemaker->get_help = 1;
            } else {
                $housemaker->get_help = 0;
            }
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
        $request->validate(['password' => ['required', new Hankaku, 'min:8', 'unique:users'],]);
        
        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
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
        
        $request->validate([
            'name' => ['required', Rule::unique('users', 'name')->ignore($user->id)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($user->id)],
            ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        if($user->is_admin = 1){ //管理者＝1
            $user->is_admin = 1;
        } else {
            $user->is_admin = 0; //従業員＝0
        }
        
        $user->save();
        
        
        return redirect('admin/users');
    }
    
    public function add_import_user() //getCSVからインポート
    {
        return view('admin.attendancerecord.user_csv_import');
    }
    
    public function import_user(Request $request) //postCSVからインポート
    {
        //一時的なTMPファイルを生成
        $tmpName = mt_rand().".".$request->file('user')->guessExtension();
        $request->file('user')->move(public_path()."/csv/tmp/",$tmpName);
        $tmpPath = public_path()."/csv/tmp/".$tmpName;
        
        //goodby csvのconfig設定
        $config = new LexerConfig();
        $interpreter = new Interpreter();
        $lexer = new Lexer($config);
        
        //CharsetをUTF-8に変換
        $config->setToCharset('UTF-8');
        $config->setFromCharset('SJIS-win');
        
        $config->setIgnoreHeaderLine(true);//CSVのヘッダーを無視
        
        $datalist = [];
        
        //$datalistに配列を代入する新規observer
        $interpreter->addObserver(function (array $row) use (&$datalist){
            $datalist[] = $row;
        });
        
        $lexer->parse($tmpPath,$interpreter); //CSVデータをパース
        
        unlink($tmpPath); //TMP(一時的に作成される)ファイルを削除
        
        $count = 0;
        $import_users = collect();
        foreach($datalist as $row){
                $import_user = new User();
                $import_user->name = $row[0];
                $import_user->email = $row[1];
                $import_user->password = $row[2];
                $import_users->push($import_user); //コレクションにアイテムを追加
        }
        
        return view('admin.attendancerecord.user_csv_import_check', ['import_users' => $import_users]);
    }
    /*
    public function add_import_user_check() //post csvから取得した内容を確認、編集
    {
        return view('admin.attendancerecord.user_csv_import_check');
    }
    */
    public function import_user_check(Request $request) //post csvから取得した内容を保存
    {
        
        
        
        for($i = 0; $i < count($request->name); $i++){
          $data = ["name"=>$request->name[$i], "email"=>$request->email[$i], "password"=>Hash::make($request->password[$i])];
          User::create($data);
        }
        
        
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
        $housemakers = Housemaker::all();
        $sites = Site::all();
        
        $cond_user = User::where('name', $request->cond_user)->first();
        $cond_housemaker = Housemaker::where('name', $request->cond_housemaker)->first();
        $cond_site = Site::where('name', $request->cond_site)->first();
        
        $day_from = $request->from;
        $day_until = $request->until;
        
        $query = Attendance::query();
        if ($cond_user != '') { //名前検索
            $query->where('user_id', $cond_user->id);
        }
        if ($cond_site != '') { //現場名検索
            $query->where('site_id', $cond_site->id);
        }
        if ($cond_housemaker != '') { //ハウスメーカー検索
            $query->where('housemaker_id', $cond_housemaker->id);
        }
        if (!empty($day_from) && !empty($day_until)) { //期間指定検索
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_user != '' && !empty($day_from) && !empty($day_until)) { //名前、期間指定検索
            $query->where('user_id', $cond_user->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_site != '' && !empty($day_from) && !empty($day_until)) { //現場名、期間指定検索
            $query->where('site_id', $cond_site->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_housemaker != '' && !empty($day_from) && !empty($day_until)) { //ハウスメーカー、期間指定検索
            $query->where('housemaker_id', $cond_housemaker->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_user != '' && $cond_site != ''){ //名前、現場名検索
            $query->where('user_id', $cond_user->id);
            $query->where('site_id', $cond_site->id);
        }
        if ($cond_user != '' && $cond_housemaker != '') { //名前、ハウスメーカー検索
            $query->where('user_id', $cond_user->id);
            $query->where('housemaker_id', $cond_housemaker->id);
        }
        if ($cond_site != '' && $cond_housemaker != '') { //現場名、ハウスメーカー検索
            $query->where('site_id', $cond_site->id);
            $query->where('housemaker_id', $cond_housemaker->id);
        }
        if ($cond_user != '' && $cond_site != '' && $cond_housemaker != '') { //名前、現場名、ハウスメーカー検索
            $query->where('user_id', $cond_user->id);
            $query->where('site_id', $cond_site->id);
            $query->where('housemaker_id', $cond_housemaker->id);
        }
        if ($cond_user != '' && $cond_site != '' && !empty($day_from) && !empty($day_until)) {//名前、現場名、期間指定検索
            $query->where('user_id', $cond_user->id);
            $query->where('site_id', $cond_site->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_user != '' && $cond_housemaker != '' && !empty($day_from) && !empty($day_until)) {//名前、ハウスメーカー、期間指定検索
            $query->where('user_id', $cond_user->id);
            $query->where('housemaker_id', $cond_housemaker->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_site != '' && $cond_housemaker != '' && !empty($day_from) && !empty($day_until)) { //現場名、ハウスメーカー、期間指定検索
            $query->where('site_id', $cond_site->id);
            $query->where('housemaker_id', $cond_housemaker->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        if ($cond_user != '' && $cond_site != '' && $cond_housemaker != '' && !empty($day_from) && !empty($day_until)) { //名前、現場名、ハウスメーカー、期間指定検索
            $query->where('user_id', $cond_user->id);
            $query->where('site_id', $cond_site->id);
            $query->where('housemaker_id', $cond_housemaker->id);
            $query->whereBetween('date', [$day_from, $day_until]);
        }
        
        $attendances = $query->groupBy('id')->get();
        
        $q = $request->all();
        
        //検索ワードを保持
        $q['cond_user'] = !isset($q['cond_user']) ? '' : $q['cond_user'];
        $q['cond_site'] = !isset($q['cond_site']) ? '' : $q['cond_site'];
        $q['cond_housemaker'] = !isset($q['cond_housemaker']) ? '' : $q['cond_housemaker'];
        $q['from'] = !isset($q['from']) ? '' : $q['from'];
        $q['until'] = !isset($q['until']) ? '' : $q['until'];
        
        $total_day = !empty($day_from) && !empty($day_until) ? $attendances->sum('work_time')/8 : null;
        
        return view('admin.attendancerecord.attendancerecords',['users' => $users, 'sites' => $sites, 'attendances' => $attendances, 'housemakers' => $housemakers, 'cond_user' => $cond_user, 'cond_site' => $cond_site, 'q' => $q, 'total_day' => $total_day]);
    }
    
    public function edit_attendancerecord(Request $request) //get勤務記録編集
    {
        
        $attendance = Attendance::find($request->id);
        $thisUser = User::where('id',$attendance->user_id)->first();
        $thisSite = Site::where('id',$attendance->site_id)->first();
        
        if(empty($attendance)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.edit_attendancerecord', ['attendance' => $attendance, 'users' => User::all(), 'sites' => Site::all(), 'thisUser' => $thisUser, 'thisSite'=> $thisSite]);
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
    
    public function approval_check(Request $request) //申請内容確認
    {
        $approval_0_attendance = Attendance::find($request->id);
        $thisUser = User::where('id',$approval_0_attendance->user_id)->first();
        $thisSite = Site::where('id',$approval_0_attendance->site_id)->first();
        
        if(empty($approval_0_attendance)) {
            abort(404);
        }
        
        return view('admin.attendancerecord.approval', ['approval_0_attendance' => $approval_0_attendance, 'users' => User::all(), 'sites' => Site::all(), 'thisUser' => $thisUser, 'thisSite'=> $thisSite]);
    }
    
    public function approval(Request $request) //申請承認
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
}