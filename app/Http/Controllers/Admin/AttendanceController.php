<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Housemaker;
use App\Site;

class AttendanceController extends Controller
{
    //
    public function add()
    {
        return view('admin.attendancerecord.new_site', ['housemakers'=> Housemaker::all()]);
    }
    
    public function new_site(Request $request)
    {
        $this->validate($request, Site::$rules);
        $this->validate($request, Housemaker::$rules);
        
        
        $site = new Site;
        $site->name = $request->site_name;
        
        $housemaker = new Housemaker;
        $housemaker->name = $request->housemaker_name;
        $housemaker->get_help = $request->get_help;
        $housemaker->get_help = isset($housemaker['get_help']); //
        $housemaker->save();
        
        $site->housemaker_id = $housemaker->id;
        $site->save();
        
        
        return redirect('admin/site/new');
    }
}
