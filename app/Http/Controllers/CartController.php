<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $lan = $request->lang;
        $qty = $request->qty;
        $product_id = $request->id;
        $product_info = DB::table('tbl_products')
        ->where('products_id',$request->products_id)
        ->first();
        
        $data['id'] = $product_info->products_id;
        $data['name'] = $product_info->products_name;
        $data['namearabic'] = $product_info->products_name_arabic;
        $data['price'] = $product_info->products_price;
        $data['qty'] = $qty;
        $data['options']['image'] = $product_info->products_image1;
        $data['options']['name'] = $product_info->products_name_arabic;
        Cart::add($data);
        $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
        $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
        // $manage_add_cart = view('pages.add_to_cart')
        // ->with(['all_catgeory_info'=>$all_catgeory_info , 'all_brand_info'=>$all_brand_info , 'lang'=>$lan]);
        // return  $manage_add_cart;
        if($lan == "ar"){
             return Redirect::to('/show-cart');
        }else{
            return Redirect::to('/show-cart/en');
        }
    }

    public function show_cart($lang = null)
    {
       $lan = $lang;
            if($lang == null){
                $lan = 'ar';
            }
       
        $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
        $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
        $all_published_category= DB::table('tbl_category')
								->where('publication_status',1)
                                ->get();
                                
        $manage_published_Category = view('pages.add_to_cart')->with(['all_brand_info'=>$all_brand_info ,
        'all_catgeory_info'=>$all_catgeory_info ,'all_published_category'=>$all_published_category, 'lang'=>$lan]);
        return  $manage_published_Category;
    }
    public function cart_update(Request $request)
    {
        
       
        $lan = $request->lang;
        $qty = $request->qty;
        $rowId = $request->rowId;

        Cart::update($rowId, $qty);
        if($lan == "ar"){
            return Redirect::to('/show-cart');
        }else{
            return Redirect::to('/show-cart/en');
        }
        
    }

    public function delete_to_cart($rowId, $lang=null)
    {
        Cart::update($rowId, 0);
        $lan = $lang;
        if($lan == "en"){
            return Redirect::to('/show-cart/en');
        }else{
            return Redirect::to('/show-cart');
        }
    }
}
