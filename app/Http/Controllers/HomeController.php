<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class HomeController extends Controller
{
    public function index($lang=null)
    {
            $lan = $lang;
            if($lang == null){
                $lan = 'ar';
            }

            $all_product_info = DB::table('tbl_products')->where('products_publication', 1)->where('products_delete', 0)->get();
            $all_slider_info = DB::table('tbl_slider')->get();
            $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
            $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
            $manage_brand = view('pages.home_content')
            ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
            'all_product_info'=>$all_product_info , 'all_slider_info'=>$all_slider_info , 'lang'=>$lan]);
            return  $manage_brand;
    }

    public function category($lang=null, $categoryname)
    {
            $lan = $lang;
            if($lan != 'en'){
                $lan = 'ar';
            }
            $categoryname = $categoryname;
            $all_catgeory_info = DB::table('tbl_category')->where('category_name', $categoryname)
            ->orWhere('category_name_arabic', $categoryname)->where('publication_status', 1)->where('category_delete', 0)->first();
            $all_brand_info = DB::table('tbl_brand')->where('brand_name', $categoryname)
            ->orWhere('brand_name_arabic', $categoryname)->where('brand_publication', 1)->where('brand_delete', 0)->first();
            //dd($all_catgeory_info);
            
            if($categoryname == null && $all_catgeory_info == null){
                $all_product_info = DB::table('tbl_products')->where('products_publication', 1)->where('products_delete', 0)->get();
                $all_slider_info = DB::table('tbl_slider')->get();
                $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
                $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
                $manage_brand = view('pages.home_content')
                ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
                'all_product_info'=>$all_product_info , 'all_slider_info'=>$all_slider_info , 'lang'=>$lan]);
                return  $manage_brand;

            }elseif($categoryname != null && $all_brand_info != null){
                $brand_id = $all_brand_info->brand_id;
                $all_product_info = DB::table('tbl_products') ->where('brand_id', $brand_id)
                ->where('products_publication', 1)->where('products_delete', 0)->get();
                $all_slider_info = DB::table('tbl_slider')->get();
                $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
                $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
                $manage_brand = view('pages.category')
                ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
                'all_product_info'=>$all_product_info , 'all_slider_info'=>$all_slider_info , 'lang'=>$lan]);
                return  $manage_brand;
            }else{
                $category_id = $all_catgeory_info->category_id;
                $all_product_info = DB::table('tbl_products') ->where('category_id', $category_id)
                ->where('products_publication', 1)->where('products_delete', 0)->get();
                $all_slider_info = DB::table('tbl_slider')->get();
                $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
                $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
                $manage_brand = view('pages.category')
                ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
                'all_product_info'=>$all_product_info , 'all_slider_info'=>$all_slider_info , 'lang'=>$lan]);
                return  $manage_brand;
            }

    }


/*    public function show_product_by_categorys($category_id){
        $product_by_categorys = DB::table('tbl_products')
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        ->select('tbl_products.*', 'tbl_category.category_name')
        ->where('tbl_products.category_id', $category_id)
        ->where('tbl_products.products_publication', 1)
        ->limit(18)
        ->get();
        $manage_product_by_categorys= view('pages.category_by_products')->with('product_by_categorys' ,$product_by_categorys);
        return view('layout')->with('pages.category_by_products', $manage_product_by_categorys);
    }
    
    public function show_product_by_manufactures($brand_id){
        $product_by_brands = DB::table('tbl_products')
        ->join('tbl_brand', 'tbl_products.brand_id', '=', 'brand.brand_id')
        ->select('tbl_products.*', 'brand.brand_name')
        ->where('tbl_products.brand_id', $brand_id)
        ->where('tbl_products.publication_status', 1)
        ->limit(18)
        ->get();
        $manage_product_by_brands= view('pages.brand_by_products')->with('product_by_brands' ,$product_by_brands);
        return view('layout')->with('pages.manufactures_by_products', $manage_product_by_brands);
    }
*/
    public function product_details_by_id( $product_id, $lang=null){
        $lan = $lang;
        if($lan != 'en'){
            $lan = 'ar';
        }
        $product_by_details = DB::table('tbl_products')
        ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
        ->join('tbl_brand', 'tbl_products.brand_id', '=', 'tbl_brand.brand_id')
        ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name',
         'tbl_brand.brand_description_arabic', 'tbl_brand.brand_description', 'tbl_brand.brand_description')
        ->where('tbl_products.products_id', $product_id)
        ->where('tbl_products.products_publication', 1)
        ->first();
        // dd($product_by_details);
        // exit;
        $all_catgeory_info = DB::table('tbl_category')->where('publication_status', 1)->where('category_delete', 0)->get();
        $all_brand_info = DB::table('tbl_brand')->where('brand_delete', 0)->get();
       /* $manage_product_by_details= view('pages.prouduct_details')->with('product_by_details' ,$product_by_details);
        return view('layout')->with('pages.prouduct_details', $manage_product_by_details);*/

        $manage_brand = view('pages.prouduct_details')
                ->with(['all_brand_info'=>$all_brand_info ,'all_catgeory_info'=>$all_catgeory_info ,
                'product_by_details'=>$product_by_details, 'lang'=>$lan]);
                return  $manage_brand;
    }
}
