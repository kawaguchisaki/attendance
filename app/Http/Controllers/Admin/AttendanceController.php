<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Housemaker;
use App\Site;

class AttendanceController extends Controller
{
    //
    public function add()
    {
        return view('admin.attendancerecord.new_site');
    }
    
    public function new_site(Request $request)
    {
        $this->validate($request, Customer::$rules);
        $this->validate($request, Housemaker::$rules);
        
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->save();
        
        $housemaker = new Housemaker;
        $housemaker_form = $request->all();
        unset($housemaker_form['name']);
        
        $housemaker->fill($housemaker_form);
        $housemaker->save();
        
        
        
        return redirect('admin/site/new');
    }
}
