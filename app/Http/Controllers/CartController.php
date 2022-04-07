<?php

namespace App\Http\Controllers;
use App\Modules\Product\Models\Product;
use App\Models\Cart;
use App\Modules\Category\Models\Category;
use App\Modules\Colour\Models\Colour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        $product_id= $request->input('product_id');
        $product_qty= $request->input('product_qty');

        if(Auth::check())
        {
            $prod_check=Product::where('id',$product_id)->first();

            if($prod_check)
            {
                if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $minicart=view('frontview.minicart')->render();
                    return response()->json(['status'=>$prod_check->name." already added to cart",'minicart'=>$minicart]);
                }

                else
                {
                $cartitem= new Cart();
                $cartitem->product_id=$product_id;
                $cartitem->user_id= Auth::id();
                $cartitem->qty=$product_qty;
                $cartitem->save();
                $minicart=view('frontview.minicart')->render();
                return response()->json(['status'=>$prod_check->name." added to cart",'minicart'=>$minicart]);
                }
            }
        }
        else
        {
            // return response()->json(['status'=>"login to continue"]);
            session(['product_id'=>$product_id,'product_qty'=>$product_qty]);

        }
    }
    public function cartview()
    {
        $cartitems= Cart::where('user_id',Auth::id())->get();
        return view('frontview.cart',compact('cartitems'));
    }

    public function removecart(Request $request)
    {
        if(Auth::check())
        {
            $product_id = $request->input('product_id');
            if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                $cartItem = Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                $minicart=view('frontview.minicart')->render();

                return response()->json(['status'=>"Product Removed From your Cart",'minicart'=>$minicart]);
            }
        }
        else
        {
            return response()->json(['status'=>"Login To Continue!!"]);
        }

    }
    public function updatecart(Request $request)
    {
        $product_id= $request->input('product_id');
        $product_qty= $request->input('qty');

        if(Auth::check())
        {
            $qty = Product::where('id',$product_id)->first(['stock']);
            // $qty=DB::table('product')->where('id',$product_id)->get(['stock'])->first();

                if($product_qty <= 5 && $product_qty <= $qty->stock && $product_qty > 0)
                {
            if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                $cart= Cart::where('product_id',$product_id)->where('user_id',Auth::id())->first();
                $cart->qty= $product_qty;
                $cart->update();
                $product_price = $cart->product->price;
                $minicart=view('frontview.minicart')->render();
                return response()->json(['status'=>"qty updated",'cart'=>$cart,'product_price'=>$product_price,'minioart'=>$minicart]);
            }
        }
        else
          {
            return response()->json(['status'=>"Enter valid QTY"]);
          }

        }
    }


}
