<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Order;
use App\Models\Order_detail;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $address = Checkout::where('user_id', Auth::user()->id)->get();
        return view('bill_address.add', compact('address'));
    }
    public function shipping()
    {
        $address = Checkout::where('user_id', Auth::user()->id)->get();
        return view('shipping_address.add', compact('address'));
    }
    public function add(Request $request)
    {
        $billing_id = $shipping_id = '';

        if ($request->addresses == 0) {
            $data = [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'address' => $request->address
            ];

            $id = Checkout::create($data);

            $billing_id = $id->id;
        } else {
            $billing_id = $request->addresses;
        }

        if (isset($request->shipping) && $request->shipping == 1) {
            $shipping_id = $billing_id;
        }
        $checkout_arr = [
            'billing_id' => $billing_id,
            'shipping_id' => $shipping_id,
        ];

        session()->put('id', $checkout_arr);

        if ($request->shipping == 1) {
            return redirect('/payment');
        } else {
            return redirect('/shipping');
        }
    }

    public function getShipping(Request $request)
    {

        $session_store = session('id');
        $billing_id = (int) $session_store['billing_id'];

        if ($request->addresses == 0) {

            $data = [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'state' => $request->state,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'address' => $request->address
            ];

            $id = Checkout::create($data);
            $shipping_id = $id->id;
        } else {
            $shipping_id = $request->addresses;
        }

        if (isset($request->shipping) && $request->shipping = 1) {
            $shipping_id = $shipping_id;
        }
        $checkout_arr = [
            'billing_id' => $billing_id,
            'shipping_id' => $shipping_id,
        ];
        session()->put('id', $checkout_arr);
        return redirect('/payment');
    }

    public function payment()
    {
        return view("payment.payment");
    }

    public function orderreview()
    {
        $session_store = session('id');
        $billing_id = (int) $session_store['billing_id'];
        $shipping_id = (int) $session_store['shipping_id'];


        $billing = Checkout::where('id', $billing_id)->where('user_id', Auth::user()->id)->get();
        $shipping = Checkout::where('id', $shipping_id)->where('user_id', Auth::user()->id)->get();

        $address = Checkout::where('user_id', Auth::user()->id)->get();
        return view('payment.order', compact('address', 'billing', 'shipping'));
    }

    public function store_order(Request $request)
    {

        $store_session_value = session('id');

        $billing_id = (int)$store_session_value['billing_id'];
        $shipping_id = (int)$store_session_value['shipping_id'];


        $order_data = Order::create([
            'user_id' => Auth::user()->id,
            'shipping_id' => $shipping_id,
            'billing_id' => $billing_id,
            'payment_id' => 1,
            'total_price' => $request->total_price,
            'order_status' => 'pending',

        ]);

        foreach ($request->product_id as $key => $value) {

            Order_detail::insert([
                'order_id' => $order_data->id,
                'product_id' => $value,
                'qty' => $request->qty[$key],
                'total_price' => $request->sub_total[$key],
            ]);
        }
        $Product_id = Product::where('id', $value)->decrement('stock', $request->qty[$key]);

        Cart::where('User_id', Auth::user()->id)->delete();

        return redirect('/')->with('success','order placed.');
    }
}
