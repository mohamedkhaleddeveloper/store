<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CompanyController extends Controller
{

    public function all_company($lang)
    {
        $this->adminauthcheck();
        $lan = $lang;
        $all_company_info = DB::table('tbl_company')->where('company_delete', 0)->get();
        $manage_Company = view('admin.company')->with(['all_company_info'=>$all_company_info , 'lang'=>$lan]);
        return  $manage_Company;
        
       
    }

    public function save_company(Request $requset)
    {
        $this->adminauthcheck();
        $lang = $requset->lang;
        $data = array();
        $data['company_name'] = $requset->company_name;
        $data['company_name_arabic'] =  $requset->company_name_arabic;
        $data['company_description'] =  $requset->company_description;
        $data['company_description_arabic'] =  $requset->company_description_arabic;
        $data['company_publication'] =  1;
        $data['company_delete'] = 0;

        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($requset->company_name == null)
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
                    $addcompany  = DB::table('tbl_company')->insert($data);
                    $last_company_id = DB::getPdo()->lastInsertId();
                    $all_company_info = DB::table('tbl_company')->where('company_id', $last_company_id)->get();
                    $return['tables'] = $all_company_info;
                    if($addcompany){
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

    public function active_company($company_id)
    {   
        
        $company_id = $company_id; 
        $company_info = DB::table('tbl_company')
        ->where('company_id', $company_id)
        ->first();
        $company_publish = $company_info->company_publication;
        
        if ($company_publish == 0) {
            $company_publish = 1;
        } else {
            $company_publish = 0;
        }
        
        //$category_publish= !$category_publish;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        //Begin form validation functionality

        //Begin form success functionality
            if ($return['error'] === false){ 
                $updatecategory = DB::table('tbl_company')
                ->where('company_id', $company_id)
                ->update(['company_publication'=>$company_publish]);
                if($updatecategory){
                    $return['msg'].=  $company_publish;
                }else{
                    $return['msg'].=  $company_publish;
                }
            }
        //Return json encoded results
        return json_encode($return);
    }
    
    public function edit_company ($company_id)
    {
        $this->adminauthcheck();
        $company_id = $company_id;
        $company_info = DB::table('tbl_company')
        ->where('company_id', $company_id)
        ->first();
        //Establish values that will be returned via ajax
        $return = array();
        $return['result']='';
        //Begin form validation functionality
        $return['result'] = $company_info;
        
        //Return json encoded results
        return json_encode($return);
    }

    public function update_company(Request $requset)
    {
        //$this->adminauthcheck();
        $lang = $requset->lang;
        $company_id =  intval($requset->company_id);
        $data = array();
        $data['company_name'] =  $requset->company_name;
        $data['company_name_arabic'] =  $requset->company_name_arabic;
        $data['company_description'] =  $requset->company_description;
        $data['company_description_arabic'] =  $requset->company_description_arabic;
        $data['company_publication'] =  $requset->company_publication;
        $data['company_delete'] = 0;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($requset->company_name == null){
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>الحقول فارغه</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Field Empty</span></div>";   
            }
        }else{
           if ($return['error'] === false){ 
            $updatecompany = DB::table('tbl_company')
            ->where('company_id', $company_id)
            ->update($data);
            $all_company_info = DB::table('tbl_company')->where('company_id', $company_id)->get();
            $return['tables'] = $all_company_info;
            if($updatecompany){
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

    public function delete_company(Request $requset)
    {
        
        $this->adminauthcheck();
        $lang = $requset->lang;
        $company_id =  intval($requset->company_id);
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if ($return['error'] === false){ 
            $removecompany = DB::table('tbl_company')
            ->where('company_id', $company_id)
            ->update(['company_delete' => 1]);
           
            if($removecompany){
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

            $return['company_id'] = $company_id;
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
