<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ManufactureController extends Controller
{
    public function index()
    {
        $this->adminauthcheck();
        return view('admin.add_manufacture');
    }

    public function save_manufacture(Request $requset)
    {
        $this->adminauthcheck();
        $data = array();
        $data['manufacture_name'] =  $requset->manufacture_name;
        $data['manufacture_name_arabic'] =  $requset->manufacture_name_arabic;
        $data['manufacture_description'] =  $requset->manufacture_description;
        $data['manufacture_description_arabic'] =  $requset->manufacture_description_arabic;
        $data['publication_status'] =  $requset->publication_status; 
        if($requset->manufacture_name == null && $requset->manufacture_name_arabic == null 
            && $requset->manufacture_description == null && $requset->manufacture_description_arabic == null)
        {
            Session::put('error', 'faileds empty');
            return Redirect::to('/add-manufacture');
        }else{
        DB::table('manufacture')->insert($data);
        Session::put('message', 'manufacture Added Successfully');
        return Redirect::to('/add-manufacture');
        }
    }

    public function all_manufacture()
    {
        $this->adminauthcheck();
        $all_manufacture_info = DB::table('manufacture')->get();
        $manage_manufacture = view('admin.all_manufacture')->with('all_manufacture_info' ,$all_manufacture_info);
        return view('admin_layout')->with('admin.all_manufacture', $manage_manufacture);
    }

    public function unactive_manufacture($manufacture_id)
    {
        $this->adminauthcheck();
      DB::table('manufacture')
      ->where('manufacture_id', $manufacture_id)
      ->update(['publication_status'=>0]);
      Session::put('message', 'manufacture Unactive Successfully');
      return Redirect::to('/all-manufacture');
    }

    public function active_manufacturer($manufacture_id)
    {
        $this->adminauthcheck();
      DB::table('manufacture')
      ->where('manufacture_id', $manufacture_id)
      ->update(['publication_status'=>1]);
      Session::put('message', 'manufacture Unactive Successfully');
      return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($manufacture_id)
    {
        $this->adminauthcheck();
        $manufacture_info = DB::table('manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->first();
        $manufacture_info = view('admin.edit_manufacture')->with('manufacture_info' ,$manufacture_info);
        return view('admin_layout')->with('admin.edit_manufacture', $manufacture_info);
    }

    public function update_manufacture(Request $requset, $manufacture_id)
    {
        $this->adminauthcheck();
        $data = array();
        $data['manufacture_name'] =  $requset->manufacture_name;
        $data['manufacture_name_arabic'] =  $requset->manufacture_name_arabic;
        $data['manufacture_description'] =  $requset->manufacture_description;
        $data['manufacture_description_arabic'] =  $requset->manufacture_description_arabic;
        if($requset->manufacture_name == null && $requset->manufacture_name_arabic == null 
        && $requset->manufacture_description_arabic == null && $requset->manufacture_description_arabic == null)
        {
            Session::put('error', 'faileds empty');
            return Redirect::to('/add-manufacture');
        }else{
            DB::table('manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update($data);
            Session::put('message', 'manufacture Update Successfully');
            return Redirect::to('/all-category');
        }
    }

    public function delete_manufacture($manufacture_id)
    {
        $this->adminauthcheck();
        DB::table('manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->delete();
        Session::put('message', 'manufacture Deleted Successfully');
        return Redirect::to('/all-manufacture');
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
}
