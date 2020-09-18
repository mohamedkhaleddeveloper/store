<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProductController extends Controller
{
    public function all_products($lang)
    {
        $this->adminauthcheck();
        $lan = $lang;
        $all_product_info = DB::table('tbl_products')->where('products_delete',0)
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        //->join('tbl_brand', 'tbl_products.brand_id', '=', 'tbl_brand.brand_id')
        ->select('tbl_products.*', 'tbl_category.category_name')
        ->get();
        $all_category_info = DB::table('tbl_category')->where('category_parent', 0)->where('publication_status', 1)->where('category_delete', 0)->get();
        $all_company_info = DB::table('tbl_company')->where('company_publication', 1)->where('company_delete', 0)->get();
        $all_brand_info = DB::table('tbl_brand')->where('brand_publication', 1)->where('brand_delete', 0)->get();
        $manage_products = view('admin.products')->with(['all_products_info'=>$all_product_info ,
        'all_category_info'=>$all_category_info , 'all_company_info'=>$all_company_info , 'all_brand_info'=>$all_brand_info , 'lang'=>$lan]);
        //dd($manage_products);
        return  $manage_products;
    }

    public function getsubcategory($categoryid){
        $category_id = $categoryid;
        $all_subcategory_info = DB::table('tbl_category')->where('category_delete','0')->where('category_parent',$category_id)->get();
        $return = array();
        $return['subcategory'] = $all_subcategory_info;
        return json_encode($return);
    }
    public function save_product(Request $request)
    {
        $this->adminauthcheck();
        $lang = $request->lang;
        $data = array();
        $data['products_name'] = $request->product_name;
        $data['products_name_arabic'] = $request->product_name_arabic;
        $data['category_id'] = $request->subcategoryid;
        $data['company_id'] = $request->company_id;
        $data['brand_id'] = $request->brand_id;
        $data['products_short_description'] = $request->product_short_description; 
        $data['products_short_description_arabic'] = $request->product_short_description_arabic;
        $data['products_long_description'] = $request->product_long_description;
        $data['products_long_description_arabic'] = $request->product_long_description_arabic;
        $data['products_price'] = $request->product_price;
        $data['products_priceg'] = $request->product_priceg;
        $data['products_size'] = null;
        $data['products_color'] = null;
        $data['products_publication'] = 1;
        $image1= $request->file('product_image1'); 
        $image2= $request->file('product_image2'); 
        $image3= $request->file('product_image3'); 
        $image4= $request->file('product_image4'); 
        
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;

        if($request->product_name_arabic == null){
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل الاسم باللغه العربية</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Arabic Product Name</span></div>";   
            }
        }elseif($request->subcategoryid == 0) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>اختر المجموعة</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>please Choose Gruop</span></div>";   
            }
        }elseif($request->brand_id == 0) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>اختر الماركه</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>please Choose Brand</span></div>";   
            }
        }elseif($request->product_short_description_arabic == null) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل الوصف العربيب القصير</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Arabic Short  Description</span></div>";   
            }
        }elseif($request->product_short_description_arabic == null) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل الوصف العربيب القصير</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Arabic Short  Description</span></div>";   
            }
        }elseif($request->product_price == null) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل سعر المنتج</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Price</span></div>";   
            }
        }elseif(!$image1) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل صورة المنتج</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Photo</span></div>";   
            }
        }else{
            if ($return['error'] === false){ 
               // echo "here";
            $data['products_image1'] = "image/noimage.jpg";
            $data['products_image2'] = "image/noimage.jpg";
            $data['products_image3'] = "image/noimage.jpg";
            $data['products_image4'] = "image/noimage.jpg";
            if($image1){
                $image_name = str_random(20);
                $ext=strtolower($image1->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image1->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image1'] = $image_url;
                }   
            }  
            if($image2){
                $image_name = str_random(20);
                $ext=strtolower($image2->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image2->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image2'] = $image_url;
                }  
            }
            if($image3){
                $image_name = str_random(20);
                $ext=strtolower($image3->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image3->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image3'] = $image_url;
                } 
            } 
            if($image4){
                $image_name = str_random(20);
                $ext=strtolower($image4->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image4->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image4'] = $image_url;
                }    
            }
            if($request->product_name == null){
                $request->product_name = $request->product_name_arabic;
                $data['products_name'] = $request->product_name;
            }
            if($request->product_short_description == null){
                $request->product_short_description = $request->product_short_description_arabic;
                $data['products_short_description_arabic'] = $request->product_short_description_arabic;
            }
                //echo "here";
                        $addProducts = DB::table('tbl_products')->insert($data);
                        $last_products_id = DB::getPdo()->lastInsertId();
                        $all_products_info = DB::table('tbl_products')->where('products_id', $last_products_id)->get();
                        $return['tables'] = $all_products_info;
                        if($addProducts){
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
               // }   
            } 
        
       }   
            //Return json encoded results
            return json_encode($return);
    }    

    public function active_products($productId)
    {     
        $products_id = $productId; 
        $products_info = DB::table('tbl_products')
        ->where('products_id', $products_id)
        ->first();
        $products_publish = $products_info->products_publication;
        
        if ($products_publish == 0) {
            $products_publish = 1;
        } else {
            $products_publish = 0;
        }
        
        //$category_publish= !$category_publish;
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        //Begin form validation functionality

        //Begin form success functionality
            if ($return['error'] === false){ 
                $updateproduct = DB::table('tbl_products')
                ->where('products_id', $products_id)
                ->update(['products_publication'=>$products_publish]);
                if($updateproduct){
                    $return['msg'].=  $products_publish;
                }else{
                    $return['msg'].=  $products_publish;
                }
            }
        //Return json encoded results
        return json_encode($return);
    }

    public function edit_product($product_id)
    {
        $this->adminauthcheck();
        $product_id = $product_id;
        $product_info = DB::table('tbl_products')
        ->where('products_id', $product_id)
        ->first();

        
        $category_id = $product_info->category_id;
        $category_info = DB::table('tbl_category')
        ->where('category_id', $category_id)
        ->first();

        $category_parent = $category_info->category_parent;
        $subcategory_info = DB::table('tbl_category')
        ->where('category_parent', $category_parent)
        ->get();

        $maincategory = $category_parent;
        $subcategory  =  $category_id;
        $allsubcategory = $subcategory_info;
        

        //Establish values that will be returned via ajax
        $return = array();
        $return['result']='';
        //Begin form validation functionality
        $return['result'] = $product_info;
        $return['maincategory'] = $maincategory;
        $return['subcategory'] = $subcategory;
        $return['allsubcategory'] = $allsubcategory;
        
        //Return json encoded results
        return json_encode($return);
    }

    public function update_product(Request $request)
    {

        $this->adminauthcheck();
        $lang = $request->lang;
        $products_id = $request->products_id;
        $product_info = DB::table('tbl_products')
        ->where('products_id', $products_id)
        ->first();
        $data = array();
        $data['products_name'] = $request->products_name;
        $data['products_name_arabic'] = $request->products_name_arabic;
        $data['category_id'] = $request->subcategoryid;
        $data['company_id'] = $request->company_id;
        $data['brand_id'] = $request->brand_id;
        $data['products_short_description'] = $request->products_short_description; 
        $data['products_short_description_arabic'] = $request->products_short_description_arabic;
        $data['products_long_description'] = $request->products_long_description;
        $data['products_long_description_arabic'] = $request->productst_long_description_arabic;
        $data['products_price'] = $request->products_price;
        $data['products_priceg'] = $request->products_priceg;
        $data['products_size'] = null;
        $data['products_color'] = null;
        $data['products_publication'] = $request->products_publication;
        $image1= $request->file('products_image1'); 
        $image2= $request->file('products_image2'); 
        $image3= $request->file('products_image3'); 
        $image4= $request->file('products_image4'); 
        
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if($request->products_name_arabic == null){
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل الاسم باللغه العربية</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Arabic Product Name</span></div>";   
            }
        }elseif($request->subcategoryid == 0) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>اختر المجموعة</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>please Choose Gruop</span></div>";   
            }
        }elseif($request->brand_id == 0) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>اختر الماركه</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>please Choose Brand</span></div>";   
            }
        }elseif($request->products_short_description_arabic == null) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل الوصف العربيب القصير</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Arabic Short  Description</span></div>";   
            }
        }elseif($request->products_short_description_arabic == null) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل الوصف العربيب القصير</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Arabic Short  Description</span></div>";   
            }
        }elseif($request->products_price == null) {
            if($lang == "ar"){
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>ادخل سعر المنتج</span></div>";   
            }else{
                $return['error'] = true;
                $return['msg'].= "<div class='alert alert-danger'><span>Please Insert Price</span></div>";   
            }
        }else{
            if ($return['error'] === false){ 
               // echo "here";
            $data['products_image1'] = $product_info->products_image1;
            $data['products_image2'] = $product_info->products_image2;
            $data['products_image3'] = $product_info->products_image3;
            $data['products_image4'] = $product_info->products_image4;
            if($image1){
                $image_name = str_random(20);
                $ext=strtolower($image1->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image1->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image1'] = $image_url;
                }   
            }  
            if($image2){
                $image_name = str_random(20);
                $ext=strtolower($image2->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image2->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image2'] = $image_url;
                }  
            }
            if($image3){
                $image_name = str_random(20);
                $ext=strtolower($image3->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image3->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image3'] = $image_url;
                } 
            } 
            if($image4){
                $image_name = str_random(20);
                $ext=strtolower($image4->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'image/';
                $image_url = $upload_path.$image_full_name;
                $success = $image4->move($upload_path, $image_full_name);
                if($success)
                {
                    $data['products_image4'] = $image_url;
                }    
            }
            if($request->products_name == null){
                $request->products_name = $request->products_name_arabic;
                $data['products_name'] = $request->products_name;
            }
            if($request->products_short_description == null){
                $request->products_short_description = $request->products_short_description_arabic;
                $data['products_short_description_arabic'] = $request->products_short_description_arabic;
            }
                //echo "here";
                        $updateProducts = DB::table('tbl_products')->where('products_id', $products_id)->update($data);
                        $last_products_id = $products_id;
                        $all_products_info = DB::table('tbl_products')->where('products_id', $last_products_id)->get();
                        $return['tables'] = $all_products_info;
                        if($updateProducts){
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
               // }   
            } 
        
       }   
            //Return json encoded results
            return json_encode($return);
    }    


    public function delete_product(Request $requset)
    {
        $this->adminauthcheck();
        $lang = $requset->lang;
        $product_id =  intval($requset->products_id);
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if ($return['error'] === false){ 
            $removeproduct = DB::table('tbl_products')
            ->where('products_id', $product_id)
            ->update(['products_delete' => 1]);
           
            if($removeproduct){
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

            $return['product_id'] = $product_id;
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
