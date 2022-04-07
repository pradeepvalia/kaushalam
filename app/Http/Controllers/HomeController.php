<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Modules\Product\Models\Product;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role=Auth::user()->role;

        if ($role=="Admin") {
            return view('admin.dashboard');
        }
        else
        {
            $product_id = session('product_id');
            $product_qty = session('product_qty');
            $prod_check=Product::where('id',$product_id)->first();

            if($prod_check)
            {
                // if(Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists())
                // {
                //     // return response()->json(['status'=>$prod_check->name." already added to cart"]);
                // }
                // else
                $cartitem= new Cart();
                $cartitem->product_id=$product_id;
                $cartitem->user_id= Auth::id();
                $cartitem->qty=$product_qty;
                $cartitem->save();
                // return response()->json(['status'=>$prod_check->name." added to cart"]);
                // }
            }
            return view('frontview.home');
        }
    }

}
