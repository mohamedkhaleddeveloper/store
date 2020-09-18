<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CheckoutController extends Controller
{
    public function login_check($lang=null)
    {
        $lan = $lang;
        if($lan != 'en'){
            $lan = 'ar';
        }
        $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
        $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();

        $manage_brand = view('pages.login')
        ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
         'lang'=>$lan]);
        return  $manage_brand;
    }

    public function customer_registration(Request $request)
    {
        $data = array();
            $data['customer_name']=$request->customer_name;
            $data['customer_email']=$request->customer_email;
            $data['password']=md5($request->customer_password);
            $data['mobile_number']=$request->mobile_number;
            
            $customer_id = DB::table('tbl_customer')
                ->insertGetId($data);
                Session::put('customer_id', $customer_id);
                Session::put('customer_name', $request->customer_name);
                return Redirect('/checkout');
    }

    public function checkout($lang = null)
    {
        /*
        $all_published_category= DB::table('tbl_category')
        ->where('publication_status',1)
        ->get();
            $manage_published_Category = view('pages.checkout')->with('all_published_category' ,$all_published_category);
            return view('layout')->with('pages.checkout', $manage_published_Category);
            */
             $lan = $lang;
            if($lan != 'en'){
            $lan = 'ar';
             }

            $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
            $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
    
            $manage_brand = view('pages.checkout')
            ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
             'lang'=>$lan]);
            return  $manage_brand;
    }

    public function save_shiping_details(Request $request)
    {
        $data = array();
            $data['shipping_email'] = $request->shipping_email;
            $data['shipping_First_name'] = $request->shipping_First_name;
            $data['shipping_last_name'] = $request->shipping_last_name;
            $data['shipping_address'] = $request->shipping_address;
            $data['shipping_mobile_number'] = $request->shipping_mobile_number;
            $data['shipping_city'] = $request->shipping_city;

            $shipping_id = DB::table('tbl_shipping')
            ->insertGetId($data);
            Session::put('shipping_id', $shipping_id);
            return Redirect('/payment');
    }

    public function customer_login(Request $request)
    {
        $lan = $request->lang;
        if($lan != 'en'){
            $red = '/checkout';
        }else{
            $red = '/checkout'.'/'.$lan;
        }
        $customer_email = $request->customer_email;
        $password = md5($request->password);
        $result = DB::table('tbl_customer')
        ->where('customer_email', $customer_email)
        ->where('password', $password)
        ->first();

        if($result)
        {   
            Session::put('customer_id', $result->customer_id);
            return Redirect($red);
        }else{
            return Redirect('/login-check');
        }
    }

    public function customer_logout( $lang = null)
    {
       
        $lan = $lang;
    if($lan != 'en'){
        $lan = 'ar';
    }
        Session::flush();
        return Redirect::to('/'.$lan);
    }

    public function payment($lang=null)
    {
        
        $lan = $lang;
        if($lan != 'en'){
        $lan = 'ar';
        }
        $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
        $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();

        $manage_brand = view('pages.payment')
        ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
        'lang'=>$lan]);
        return  $manage_brand;
    }

    public function order_place(Request $request)
    {
        $lang = $request->lang;
        $lan = $lang;
        if($lan != 'en'){
        $lan = 'ar';
        }
        $payment_getway = $request->payment_getway;

        $pdata = array();
           $pdata['payment_method'] = $payment_getway;
           $pdata['payment_status'] = 'pinding'; 
           $payment_id = DB::table('tbl_payment')
            ->insertGetId($pdata);
           
            

        $odata = array();
            $odata['customer_id'] = Session::get('customer_id');
            $odata['shipping_id'] = Session::get('shipping_id');
            $odata['payment_id'] = $payment_id;
            $odata['order_total'] =Cart::total();
            $odata['order_status'] = 'pinding';
                $order_id = DB::table('tbl_order')
                ->insertGetId($odata);
               

        $contents = Cart::content();
      
        $oddata = array();
           foreach($contents as $v_content)
           {
                $oddata['order_id'] = $order_id;
                $oddata['product_id'] = $v_content->id;
                $oddata['product_name'] = $v_content->name;
                $oddata['product_price'] = $v_content->price;
                $oddata['product_sales_quantity'] = $v_content->qty;

                 DB::table('tbl_order_details')
                ->insert($oddata);
               

               
           }

            if($payment_getway = "cash")
            {
                $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
                $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
        
                $manage_brand = view('pages.cash')
                ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
                'lang'=>$lan]);
                return  $manage_brand;
                 Cart::destroy();

            }else{
                echo "failed done by handcash";
            }

    }

    private function sslapi()
    {

    }

    public function manage_order($lang= null)
    {
        $this->adminauthcheck();
        $lan = $lang;
        if($lan != 'en'){
        $lan = 'ar';
        }
        $all_order_info = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->select('tbl_order.*', 'tbl_customer.customer_name')
        ->orderBy('order_id', 'DESC')
        ->get();
       
        $manage_order= view('admin.manage_order')->with(['all_order_info'=>$all_order_info , 
        'lang'=>$lan]);       
         return $manage_order;
    }

    public function view_order($order_id, $lang=null)
  {
     $this->adminauthcheck();
     $lan = $lang;
     if($lan != 'en'){
     $lan = 'ar';
     }
      $order_by_id=DB::table('tbl_order')
              ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
              ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
              ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
              ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')
              ->where('tbl_order.order_id',$order_id)
              ->get();

             
       $view_order=view('admin.view_order')->with(['order_by_id'=>$order_by_id , 
       'lang'=>$lan]);       
             
       return $view_order;
                     // echo "<pre>";
                     //  print_r($order_by_id);
                     // echo "</pre>";
                     
  }


  public function unactive_order($order_id, $lang=null)
  {
      $this->adminauthcheck();
      $lan = $lang;
      if($lan != 'en'){
      $lan = 'ar';
      }
      $red = "manage-order/".$lan;
    DB::table('tbl_order')
    ->where('order_id', $order_id)
    ->update(['order_status'=>0]);
    Session::put('message', 'order Unactive Successfully');
    return Redirect::to($red);
  }

  public function active_order($order_id, $lang=null)
  {
      
      $this->adminauthcheck();
      $lan = $lang;
      if($lan != 'en'){
      $lan = 'ar';
      }
      $red = "manage-order/".$lan;
    DB::table('tbl_order')
    ->where('order_id', $order_id)
    ->update(['order_status'=>1]);
    Session::put('message', 'order Active Successfully');
    return Redirect::to($red);
  }



  public function delete_order($order_id, $lang=null)
  {
      $this->adminauthcheck();
      $lan = $lang;
        if($lan != 'en'){
        $lan = 'ar';
        }
      DB::table('tbl_order')
      ->where('order_id', $order_id)
      ->delete();
      Session::put('message', 'product Deleted Successfully');
      $red = "manage-order/".$lan;
      return Redirect::to($red);
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
