<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SuperAdminController extends Controller
{
    public function index($lang)
    {
        $this->adminauthcheck();
        $lan = $lang;
        return view('admin.dashboard')->with('lang' ,$lan);
      
    }

    public function adminauthcheck()
    {
        $admin_id = Session::get('admin_id');
            if($admin_id)
            {
                return;
            }else{
                return Redirect::to('/admin')->send();
            }
    }
    public function logout()
    {
        //Session::put('admin_name', null);
        //Session::put('admin_id', null);
        Session::flush();
        return Redirect::to('/admin');
    }

    
}
