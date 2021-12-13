<?php
//admin
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Housemaker;
use App\Site;

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
        $site->name = $request->site_name;
        
        $housemaker = new Housemaker;
        $housemaker->name = $request->housemaker_name; //housemaker_nameフォームに入力された値を取得し、$housemaker->nameにセット
        $housemakers_table = Housemaker::select('id', 'name', 'get_help')->get(); //housemakersテーブルの'id', 'name', 'get_help'カラムに保存されている値を$housemakers_tableに代入
        foreach($housemakers_table as $housemaker_record){ //$housemakers_tableはhousemakersテーブル、$housemaker_recordはその中の１つ１つのレコードを指す
            if($housemaker_record->name == $housemaker->name && $housemaker_record->get_help == $housemaker->get_help){ //$housemaker->nameにセットされた値が$housemaker_record->nameと一致、かつ&&、$housemaker->get_helpにセットされた値が$housemaker_record->get_helpと一致する場合
                $site->housemaker_id = $housemaker_record->id; //$housemaker_record->id(housemakersテーブルにある既存のデータのid)を$site->housemaker_id(sitesテーブルのhousemaker_id)とし、
                $site->save(); //foreach外でセットした値と一緒にsitesテーブルに保存
                break; //既存のデータと一致した場合はここでループを抜ける
            } else { //$housemaker->nameにセットされた値が既存のデータにない場合
                $housemaker->get_help = $request->get_help; //値を取得(foreach外の続き)
                $housemaker->get_help = isset($housemaker['get_help']); //$housemaker->get_helpがtrueの場合(チェックが入ってる場合)true=1を代入、そうでなければfalse=0を代入
                $housemaker->save(); //foreach外でセットした値と一緒にhousemakersテーブルに保存
                $site->housemaker_id = $housemaker->id; //else内で保存されたhouswmakersテーブルのidをsitesテーブルのhousemaker_idにセットし
                $site->save(); //foreach外でセットした値と一緒に保存
            }
        }
        
        return redirect('admin/sites');
    }
    
    public function home() //adminホーム
    {
       //
    }
    
    public function sites() //現場一覧
    {
        $sites = Site::all();
        $housemakers = Housemaker::all();
        
        return view('admin.attendancerecord.sites',['sites' => $sites , 'housemakers' => $housemakers]);
    }
    
    public function edit_site(Request $request) //get現場情報編集
    {
        /*
        $sites = Site::find($request->id);
        if (empty($sites)) {
            abort(404);
        }
        */
        return view('admin.attendancerecord.edit_site', ['housemakers'=> Housemaker::all()]);
    }
    
    public function update_site(Request $request) //post現場情報編集
    {
        $this->validate($request, Site::$rules);
        $this->validate($request, Housemaker::$rules);
        
        $sites = Site::find($request->id);
        $site->name = $request->site_name;
        $housemaker->name = $request->housemaker_name; //housemaker_nameフォームに入力された値を取得し、$housemaker->nameにセット
        $housemakers_table = Housemaker::select('id', 'name', 'get_help')->get(); //housemakersテーブルの'id', 'name', 'get_help'カラムに保存されている値を$housemakers_tableに代入
        foreach($housemakers_table as $housemaker_record){ //$housemakers_tableはhousemakersテーブル、$housemaker_recordはその中の１つ１つのレコードを指す
            if($housemaker_record->name == $housemaker->name && $housemaker_record->get_help == $housemaker->get_help){ //$housemaker->nameにセットされた値が$housemaker_record->nameと一致、かつ&&、$housemaker->get_helpにセットされた値が$housemaker_record->get_helpと一致する場合
                $site->housemaker_id = $housemaker_record->id; //$housemaker_record->id(housemakersテーブルにある既存のデータのid)を$site->housemaker_id(sitesテーブルのhousemaker_id)とし、
                $site->save(); //foreach外でセットした値と一緒にsitesテーブルに保存
                break; //既存のデータと一致した場合はここでループを抜ける
            } else { //$housemaker->nameにセットされた値が既存のデータにない場合
                $housemaker->get_help = $request->get_help; //値を取得(foreach外の続き)
                $housemaker->get_help = isset($housemaker['get_help']); //$housemaker->get_helpがtrueの場合(チェックが入ってる場合)true=1を代入、そうでなければfalse=0を代入
                $housemaker->save(); //foreach外でセットした値と一緒にhousemakersテーブルに保存
                $site->housemaker_id = $housemaker->id; //else内で保存されたhouswmakersテーブルのidをsitesテーブルのhousemaker_idにセットし
                $site->save(); //foreach外でセットした値と一緒に保存
            }
        }
        
        return redirect('admin/sites');
    }
    
    public function delete_site(Request $request) //現場情報削除
    {
        $site = Site::find($request->id);
        $site->delete();
        return redirect('admin/sites');
    }
    
    public function new_user() //従業員登録
    {
        //
    }
    
    public function users() //従業員一覧
    {
        //
    }
    
    public function edit_user() //従業員編集
    {
        //
    }
    
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