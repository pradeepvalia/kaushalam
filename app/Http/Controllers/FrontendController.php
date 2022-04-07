<?php

namespace App\Http\Controllers;

use App\Models\multipleimage;
use App\Models\Order;
use App\Models\Order_detail;
use App\Modules\Category\Models\Category;
use App\Modules\Colour\Models\Colour;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function user()
    {
        return view('frontview.home');
    }

    public function list_grid()
    {
        $category = Category::where('deleted_at', 0)
            ->where('status', 1)->get();
        $colour = Colour::where('deleted_at', 0)
            ->where('status', 1)->get();
        $products = Product::where('deleted_at', 0)
            ->where('status', 1)->get();
        return view('frontview.slider', compact('products', 'category', 'colour'));
    }

    public function sortProduct(Request $request)
    {

        if (isset($request->category) && isset($request->color)) {
            $products = Product::whereIn('category_id', $request->category)->whereIn('colour_id', $request->color)->where('deleted_at', 0)->where('status', 1)->whereBetween('price', [$request->min_price, $request->max_price])->orderBy($request->sort_name_price, $request->sort_asc_desc)->get();
        } elseif (isset($request->category)) {
            $products = Product::whereIn('category_id', $request->category)->where('deleted_at', 0)->where('status', 1)->whereBetween('price', [$request->min_price, $request->max_price])->orderBy($request->sort_name_price, $request->sort_asc_desc)->get();
        } elseif (isset($request->color)) {

            $products = Product::whereIn('colour_id', $request->color)->where('deleted_at', 0)->where('status', 1)->whereBetween('price', [$request->min_price, $request->max_price])->orderBy($request->sort_name_price, $request->sort_asc_desc)->get();
        } else {
            $products = Product::where('deleted_at', 0)->where('status', 1)->whereBetween('price', [$request->min_price, $request->max_price])->orderBy($request->sort_name_price, $request->sort_asc_desc)->get();
        }

        if ($request->view == 'true') {

            return view('frontview.grid', compact('products'));
        } else {
            return view('frontview.list', compact('products'));
        }
    }
    public function detail($url)
    {
       $products=Product::where('url',$url)->where('deleted_at',0)->where('status',1)->first();
            $images=Multipleimage::where('product_id',$products->id)->orderBy('sort')->get();
            $colour=Colour::where('id',$products->colour_id)->first();
            $category=Category::where('id',$products->category_id)->first();
            // $value = session('product_id');
            // $value_qty = session('product_qty');
            // dd($value,$value_qty);
            return view('frontview.detail',compact('products','images','colour','category'));
    }

    public function showOrderDetails()
    {

        $product_details=Order::where('user_id', Auth::user()->id)->get();
        // dd($product_details);



        return view('payment/order_details',compact('product_details'));
    }
    public function vieworderdetails($id)
    {
        $order= Order::where('id',$id)->get();
        $order_detail=Order_detail::where('order_id',$id)->get();
        return view("payment/view_details",compact('order','order_detail'));
    }

}

