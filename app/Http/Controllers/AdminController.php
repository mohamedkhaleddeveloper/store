<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.admin_login');
    }

    

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result  = DB::table('tbl_admin')
        ->where('admin_email' , $admin_email)
        ->where('admin_password' , $admin_password)
        ->first();
        
        if($result){
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            $lang='ar';
            return Redirect::to('/dashboard/ar')->with('lang' ,$lang);
        }else{
            Session::put('message' , 'تسجيل دخول خاطئ');
            return Redirect::to('/admin');
        }
    }
}
