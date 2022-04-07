@extends('frontview.front-master')
@section('frontcontent')

<div class="main-container col1-layout content-color color">
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li class="home"><a href="/" title="Go to Home Page">Home</a></li>
                <li><strong><a href="/showOrder">My Orders</a></strong></li>
                <li><strong>My Products</strong></li>
            </ul>
        </div>
    </div>
    <!--- .breadcrumbs-->
    <div class="container">
        <div class="content-top no-border">
            <h2>My Products</h2>
            <div class="row invoice-info" style=" padding:50px; border: solid #4f4e4e">
                <div class="col-sm-12 invoice-col right" style="padding-bottom: 40px">
                        @foreach ($order as $col)

                            <div class="col-sm-4 invoice-col" style="font-size: 15px;">

                                        <strong>Billing Address</strong><br>
                                        {{ $col->billing_address->address }}<br>
                                        {{ $col->billing_address->city }}
                                        {{ $col->billing_address->state }}<br>
                                        Phone: {{ $col->billing_address->mobile_number }}<br>
                                        Email: {{ $col->billing_address->email }}

                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col" style="font-size: 15px;">

                                    <strong>Shipping Address</strong><br>
                                    {{ $col->shipping_address->address }}<br>
                                    {{ $col->shipping_address->city }}
                                    {{ $col->shipping_address->state }}<br>
                                    Phone: {{ $col->shipping_address->mobile_number }}<br>
                                    Email: {{ $col->shipping_address->email }}

                            </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col right" style="font-size: 15px;">
                    <b>Order ID:</b> {{ $col->Id }}<br>
                    <b>Order status:</b> {{ $col->order_status }}<br>
                    <b>Payment Method:</b> Cash On delivery<br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive" style="font-size:15px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><b>Product Name </b></th>
                                <th><b>Image</b></th>
                                <th><b>Qty</b></th>
                                <th><b>Price</b></th>
                                <th><b>Product Code</b></th>
                                <th><b>Order Date</b></th>

                            </tr>
                        </thead>
                        @foreach ($order_detail as $prod)
                            <tbody>
                                <tr>
                                    <td>{{ $prod->product->name }}</td>
                                    <td><img src="{{ asset('uploads/products/' . $prod->product->image) }}"
                                            width="130px" height="100px" alt="image"></td>
                                    <td>{{ $prod->qty }}</td>
                                    <td>{{ $prod->total_price }}</td>
                                    <td>{{ $prod->product->upc }}</td>
                                    <td>{{ $prod->created_at }}</td>
                                </tr>
                            </tbody>

                        @endforeach
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <!-- accepted payments column -->

                <div class="col-12">
                    {{-- <p class="lead">Amount Due {{ $odr->payment->created_at }}</p> --}}

                    <div class="table-responsive " style="font-size: 15px;">
                        <table class="table">
                            <tr>
                                <th><b>Total price:{{ $col->total_price }}</th>

                            </tr>
                        </table>
                        <hr>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            @endforeach
            <!-- this row will not appear when printing -->

        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
</div><!-- /.row -->

@endsection
