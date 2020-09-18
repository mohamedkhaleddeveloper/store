<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class CategoryController extends Controller
{

    public function all_category($lang)
    {
        $this->adminauthcheck();
        $lan = $lang;
        $all_category_info = DB::table('tbl_category')->where('category_delete', 0)->get();
        $manage_Category = view('admin.category')->with(['all_category_info'=>$all_category_info , 'lang'=>$lan]);
        return  $manage_Category;
        
       
    }

    public function save_category(Request $requset)
    {
        $this->adminauthcheck();
        $lang = $requset->lang;
        $data = array();
        $data['category_name'] = $requset->category_name;
        $data['category_name_arabic'] =  $requset->category_name_arabic;
        $data['category_description'] =  $requset->category_description ;
        $data['category_description_arabic'] =  $requset->category_description_arabic;
        $data['category_parent'] = intval($requset->category_parent);
        $data['publication_status'] =  1;
        $data['category_delete'] = 0;

        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($requset->category_name == null)
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
                    $addcategory  = DB::table('tbl_category')->insert($data);
                    $last_category_id = DB::getPdo()->lastInsertId();
                    $all_category_info = DB::table('tbl_category')->where('category_id', $last_category_id)->get();
                    $return['tables'] = $all_category_info;
                    if($addcategory){
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

    public function unactive_category($category_id)
    {
        $this->adminauthcheck();
      DB::table('tbl_category')
      ->where('category_id', $category_id)
      ->update(['publication_status'=>0]);
      Session::put('message', 'Category Unactive Successfully');
      return Redirect::to('/all-category');
    }

    public function active_category1($category_id)
    {
        
        $this->adminauthcheck();
        $lang = $requset->lang;
        $data = array();
      DB::table('tbl_category')
      ->where('category_id', $category_id)
      ->update(['publication_status'=>1]);
      Session::put('message', 'Category Active Successfully');
      return Redirect::to('/all-category');
    }


    public function active_category($categoryId)
    {   
        
        $category_id = $categoryId; 
        $category_info = DB::table('tbl_category')
        ->where('category_id', $category_id)
        ->first();
        $category_publish = $category_info->publication_status;
        
        if ($category_publish == 0) {
            $category_publish = 1;
        } else {
            $category_publish = 0;
        }
        
        //$category_publish= !$category_publish;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        //Begin form validation functionality

        //Begin form success functionality
            if ($return['error'] === false){ 
                $updatecategory = DB::table('tbl_category')
                ->where('category_id', $category_id)
                ->update(['publication_status'=>$category_publish]);
                if($updatecategory){
                    $return['msg'].=  $category_publish;
                }else{
                    $return['msg'].=  $category_publish;
                }
            }
        //Return json encoded results
        return json_encode($return);
    }
    
    public function edit_category($category_id)
    {
        $this->adminauthcheck();
        $category_id = $category_id;
        $category_info = DB::table('tbl_category')
        ->where('category_id', $category_id)
        ->first();
        //Establish values that will be returned via ajax
        $return = array();
        $return['result']='';
        //Begin form validation functionality
        $return['result'] = $category_info;
        
        //Return json encoded results
        return json_encode($return);
    }

    public function update_category(Request $requset)
    {
        //$this->adminauthcheck();
        $lang = $requset->lang;
        $category_id =  intval($requset->category_id);
        $data = array();
        $data['category_name'] =  $requset->category_name;
        $data['category_name_arabic'] =  $requset->category_name_arabic;
        $data['category_description'] =  $requset->category_description ;
        $data['category_description_arabic'] =  $requset->category_description_arabic;
        $data['category_parent'] = intval($requset->category_parent);
        $data['publication_status'] =  $requset->publication_status;
        $data['category_delete'] = 0;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($requset->category_name == null){
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>الحقول فارغه</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Field Empty</span></div>";   
            }
        }else{
           if ($return['error'] === false){ 
            $updatecategory = DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update($data);
            $all_category_info = DB::table('tbl_category')->where('category_id', $category_id)->get();
            $return['tables'] = $all_category_info;
            if($updatecategory){
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

    public function delete_category(Request $requset)
    {
        
        $this->adminauthcheck();
        $lang = $requset->lang;
        $category_id =  intval($requset->category_id);
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if ($return['error'] === false){ 
            $removecategory = DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update(['category_delete' => 1]);
           
            if($removecategory){
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

            $return['category_id'] = $category_id;
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
