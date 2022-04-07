<?php

namespace App\Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\User;
use App\Modules\Order\Models\Order as ModelsOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $order=Order::get();
        return view("Order::index", compact('order'));
    }
    public function invoice($id)
    {
        $order= Order::where('id',$id)->get();
        $order_detail=Order_detail::where('order_id',$id)->get();
        return view("Order::invoice",compact('order','order_detail'));
    }
    public function edit($id)
    {
        $order = Order::find($id);
        return view('Order::edit', compact('order'));
    }
    public function update(request $request,$id)
    {
        Order::where('Id',$id)->update(['order_status'=>$request->order_status]);
        return redirect('/admin/order/orderview')->with('success','Item Updated successfully!');
        $data=Order::all();
    }
}
