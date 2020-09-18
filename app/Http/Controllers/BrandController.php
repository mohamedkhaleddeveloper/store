<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class BrandController extends Controller
{
    public function all_brand($lang)
    {
        $this->adminauthcheck();
        $lan = $lang;
        $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
        $manage_brand = view('admin.Brand')->with(['all_brand_info'=>$all_brand_info , 'lang'=>$lan]);
        return  $manage_brand;
        
       
    }

    public function save_brand(Request $requset)
    {
        $this->adminauthcheck();
        $lang = $requset->lang;
        $data = array();
        $data['brand_name'] = $requset->brand_name;
        $data['brand_name_arabic'] =  $requset->brand_name_arabic;
        $data['brand_description'] =  $requset->brand_description ;
        $data['brand_description_arabic'] =  $requset->brand_description_arabic;
        $data['brand_publication'] =  1;
        $data['brand_delete'] = 0;

        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($requset->brand_name == null)
        {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>الحقول فارغه</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Field Empty</span></div>";   
            }
        }else{
            //Begin form success functionality
                if ($return['error'] === false){ 
                    $addbrand  = DB::table('tbl_brand')->insert($data);
                    $last_brand_id = DB::getPdo()->lastInsertId();
                    $all_brand_info = DB::table('tbl_brand')->where('brand_id', $last_brand_id)->get();
                    $return['tables'] = $all_brand_info;
                    if($addbrand){
                        if($lang == "ar"){
                            $return['msg'].= "<div class='alert alert-success text-sm-center'>
                            <span>تم الإضافه بنجاح</span></div>";
                        }else{
                            $return['msg'].= "<div class='alert alert-success text-sm-center'>
                            <span>Has been successfully added</span></div>";
                        }
                    }else{
                        if($lang == "ar"){
                            $return['msg'].= "<div class='alert alert-danger'>
                            <span>فشل في الإضافه مشكله في البرنامج</span></div>";
                        }else{
                            $return['msg'].= "<div class='alert alert-danger'>
                            <span>Proplem In Data Base Please Check It</span></div>";
                        }
                    }
                }
            }
            //Return json encoded results
            return json_encode($return);
       
    }

    public function active_brand($brandId)
    {   
        
        $brand_id = $brandId; 
        $brand_info = DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->first();
        $brand_publish = $brand_info->brand_publication;
        
        if ($brand_publish == 0) {
            $brand_publish = 1;
        } else {
            $brand_publish = 0;
        }
        
        //$brand_publish= !$brand_publish;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        //Begin form validation functionality

        //Begin form success functionality
            if ($return['error'] === false){ 
                $updatebrand = DB::table('tbl_brand')
                ->where('brand_id', $brand_id)
                ->update(['brand_publication'=>$brand_publish]);
                if($updatebrand){
                    $return['msg'].=  $brand_publish;
                }else{
                    $return['msg'].=  $brand_publish;
                }
            }
        //Return json encoded results
        return json_encode($return);
    }
    
    public function edit_brand($brand_id)
    {
        $this->adminauthcheck();
        $brand_id = $brand_id;
        $brand_info = DB::table('tbl_brand')
        ->where('brand_id', $brand_id)
        ->first();
        //Establish values that will be returned via ajax
        $return = array();
        $return['result']='';
        //Begin form validation functionality
        $return['result'] = $brand_info;
        
        //Return json encoded results
        return json_encode($return);
    }

    public function update_brand(Request $requset)
    {
        //$this->adminauthcheck();
        $lang = $requset->lang;
        $brand_id =  intval($requset->brand_id);
        $data = array();
        $data['brand_name'] =  $requset->brand_name;
        $data['brand_name_arabic'] =  $requset->brand_name_arabic;
        $data['brand_description'] =  $requset->brand_description ;
        $data['brand_description_arabic'] =  $requset->brand_description_arabic;
        $data['brand_publication'] =  $requset->brand_publication;
        $data['brand_delete'] = 0;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($requset->brand_name == null){
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>الحقول فارغه</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Field Empty</span></div>";   
            }
        }else{
           if ($return['error'] === false){ 
            $updatebrand = DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->update($data);
            $all_brand_info = DB::table('tbl_brand')->where('brand_id', $brand_id)->get();
            $return['tables'] = $all_brand_info;
            if($updatebrand){
                if($lang == "ar"){
                    $return['msg'].= "<div class='alert alert-success text-sm-center'>
                    <span>تم التعديل بنجاح</span></div>";
                }else{
                    $return['msg'].= "<div class='alert alert-success text-sm-center'>
                    <span>Has been successfully Updated</span></div>";
                }
            }else{
                if($lang == "ar"){
                    $return['msg'].= "<div class='alert alert-danger'>
                    <span>فشل في التعديل مشكله في البرنامج</span></div>";
                }else{
                    $return['msg'].= "<div class='alert alert-danger'>
                    <span>Proplem In Data Base Please Check It</span></div>";
                }
            }
           
            }

        }
        
        //Return json encoded results
        return json_encode($return);
    }

    public function delete_brand(Request $requset)
    {
        
        $this->adminauthcheck();
        $lang = $requset->lang;
        $brand_id =  intval($requset->brand_id);
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if ($return['error'] === false){ 
            $removebrand = DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->update(['brand_delete' => 1]);
           
            if($removebrand){
                if($lang == "ar"){
                    $return['msg'].= "<div class='alert alert-success text-sm-center'>
                    <span>تم الحذف بنجاح</span></div>";
                }else{
                    $return['msg'].= "<div class='alert alert-success text-sm-center'>
                    <span>Has been successfully removed</span></div>";
                }
            }else{
                if($lang == "ar"){
                    $return['msg'].= "<div class='alert alert-danger'>
                    <span>فشل في الحذف مشكله في البرنامج</span></div>";
                }else{
                    $return['msg'].= "<div class='alert alert-danger'>
                    <span>Proplem In Data Base Please Check It</span></div>";
                }
            }
           
            }

            $return['brand_id'] = $brand_id;
        //Return json encoded results
        return json_encode($return);

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
