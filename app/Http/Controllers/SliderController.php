<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class SliderController extends Controller
{
    public function index()
    {
        $this->adminauthcheck();
        return view('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
        $this->adminauthcheck();
        $data = array();
        $data['slider_name'] = $request->slider_name;
        $data['slider_name_arabic'] = $request->slider_name_arabic;
        $data['slider_description'] = $request->slider_description; 
        $data['slider_description_arabic'] = $request->slider_description_arabic;
        $data['slider_link'] = $request->slider_link;

        $image= $request->file('slider_image'); 
        if($request->slider_name == null && $request->slider_name_arabic == null && $request->slider_description == null 
            && $request->slider_description_arabic == null && $request->slider_link == null )
        {
            Session::put('error', 'faileds empty');
            return Redirect::to('/add-slider');
        }else{

            if($image)
            {
                $image_name = str_random(20);
                $ext=strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'slider/';
                $image_url = $upload_path.$image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                    if($success)
                    {
                        $data['slider_image'] = $image_url;
                        DB::table('tbl_slider')->insert($data);
                        Session::put('message', 'Slider Added Successfully');
                        return Redirect::to('/add-slider');
                    }
                }    

                Session::put('error', 'product Added Failed');
                return Redirect::to('/add-slider');

        }       
    }

    public function all_sliders()
    {
        $this->adminauthcheck();
        $all_sliders_info = DB::table('tbl_slider')
        ->get();
        $manage_sliders = view('admin.all_slider')->with('all_sliders_info' ,$all_sliders_info);
        return view('admin_layout')->with('admin.all_slider', $manage_sliders);
    }

    public function edit_slider($slider_id)
    {
        $this->adminauthcheck();
        $slider_info = DB::table('tbl_slider')
        ->where('sider_id', $slider_id)
        ->first();
        $slider_info = view('admin.edit_slider')->with('slider_info' ,$slider_info);
        return view('admin_layout')->with('admin.edit_slider', $slider_info);
        //return view('admin.edit_category');

        
    }

    public function update_slider(Request $request, $slider_id)
    {
        $this->adminauthcheck();
        $data = array();
        $data['slider_name'] = $request->slider_name;
        $data['slider_name_arabic'] = $request->slider_name_arabic;
        $data['slider_description'] = $request->slider_description; 
        $data['slider_description_arabic'] = $request->slider_description_arabic;
        $data['slider_link'] = $request->slider_link;

        $image= $request->file('slider_image'); 
        if($request->slider_name == null && $request->slider_name_arabic == null && $request->slider_description == null 
            && $request->slider_description_arabic == null && $request->slider_link == null )
        {
            Session::put('error', 'faileds empty');
            return Redirect::to('/add-slider');
        }else{

            if($image)
            {
                $image_name = str_random(20);
                $ext=strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'slider/';
                $image_url = $upload_path.$image_full_name;
                $success = $image->move($upload_path, $image_full_name);
                    if($success)
                    {
                        $data['slider_image'] = $image_url;
                        DB::table('tbl_slider')
                        ->where('sider_id', $slider_id)
                        ->update($data);
                        Session::put('message', 'Slider Update Successfully');
                        return Redirect::to('/add-slider');
                    }
                }    
                $data['slider_image'] =  $request->oldimage;
                DB::table('tbl_slider')
                ->where('sider_id', $slider_id)
                ->update($data);
                Session::put('message', 'Slider Update Successfully');
                return Redirect::to('/add-slider');

        }       
    }

    public function delete_slider($slider_id)
    {
        $this->adminauthcheck();
        DB::table('tbl_slider')
        ->where('sider_id', $slider_id)
        ->delete();
        Session::put('message', 'product Deleted Successfully');
        return Redirect::to('/all-sliders');
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
