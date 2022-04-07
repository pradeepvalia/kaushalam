@extends('frontview.front-master')
@section('frontcontent')
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"> <a href="/" title="Go to Home Page">Home</a></li>
                    <li class="category4"><a href="{{ route('frontview.slider') }}"
                            title="Go to t-shirt Page">T-SHIRT</a></li>
                    <li> <strong>My Cart</strong></li>
                </ul>
            </div>
        </div>
        <!--- .breadcrumbs-->
        <div class="container">
            <div class="content-top no-border">
                <h2>My Cart</h2>

            </div>
            <div class="table-responsive-wrapper product_list product_data">
                @if (!$cartitems->isEmpty())
                <table class="table-order table-wishlist">
                    <thead>
                        <tr>
                            <td>Remove</td>
                            <td>Product Detail</td>
                            <td>Items</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cartitems as $item)
                            <tr class="list_item">
                                <td><button type="button" class="button-remove " id="" onclick="removeitem(this)"
                                        data-product_id="{{ $item->product_id }}"><i class="icon-close"></i></button>
                                </td>
                                <td>
                                    <table class="table-order-product-item fixed-solution">
                                        <tr>
                                            <td width="10%">
                                                <a href="{{ $item->product->name }}" title="{{ $item->product->name }}">
                                                    <img src="{{ url('uploads/products/' . $item->product->image) }}"
                                                        width="100" />
                                                </a>
                                            </td>
                                            <td>
                                                <p>
                                                    <a href="{{ $item->product->name }}"
                                                        title="{{ $item->product->name }}">{{ $item->product->name }}</a>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="wish-list-control">
                                    <div class="price_{{ $item->product_id }}">
                                        <h2>₹{{ $item->product->price * $item->qty }}</h2>

                                    </div>
                                    <input type="hidden" class="prod_id" value="{{ $item->product_id }}">
                                    <div class="number-input">
                                        <button type="button" class="minus"
                                            data-product_id="{{ $item->product_id }}"
                                            id="{{ $item->product_id }}">-</button>
                                        <input type="text" value="{{ $item->qty }}" name="qty" class="qty"
                                            maxlength="2" data-product_id="{{ $item->product_id }}" readonly>
                                        <button type="button" class="plus"
                                            data-product_id="{{ $item->product_id }}">+</button>
                                        <input type="hidden" name="product_id" id="qty_data_{{ $item->product_id }}">
                                        <input type="hidden" name="product_price" id="{{ $item->product->price }}">
                                    </div>

                                </td>
                            </tr>
                            @php
                                $total += $item->product->price * $item->qty;
                            @endphp
                        @endforeach
                        {{-- <tr>
                        <td colspan="3" class="text-right">
                                <h1>Total Price:-{{ $total }}</h1>
                        </td>
                    </tr> --}}
                        <tr>
                            <td colspan="3" class="text-right">
                                {{-- <h1>Total Price:-{{ $total }}</h1> --}}
                                <a href="{{ url('/checkout') }}" class="btn-step checkout">Checkout</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                   <div class="wish-list-notice">
                        <i class="fa-blank"></i>
                        The Cart is Empty.
                        <a href="{{ url('/products') }}">Click here</a> to Shop now .
                    </div>
            @endif

            </div>
            <!--- .table-responsive-wrapper-->
        </div>
        <!--- .container-->
    </div>
    <!--- .main-container -->
@endsection


@push('front-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('resources/assets/front/scripts/jquery-3.4.1.min.js') }} "></script> --}}
    <script type="text/javascript">
        function removeitem(data) {
            console.log(data);
            var product_id = $(data).attr("data-product_id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/deletecartitem",
                data: {
                    'product_id': product_id,
                },
                success: function(response) {
                    swal("",response.status,"success")
                    window.location.reload();

                }
            });

        }

        // $(document).ready(function () {

        // });
        $('.plus,.minus,.qty').click(function(e) {
            e.preventDefault();

            var product_id = $(this).attr('data-product_id');
            console.log('product_id', product_id);
            var qty = $(`#qty_data_${product_id}`).val();
            console.log('qty', qty);

            data = {
                'product_id': product_id,
                'qty': qty,
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/update-cart",
                data: data,
                success: function(response) {
                    swal(response.status);




                    let price_qty = parseInt(response.cart.qty);
                    let price_int = parseInt(response.product_price);
                    // console.log(typeof price_qty);
                    let price = price_int * price_qty;
                    console.log(price);
                    $(`.product_data .list_item .wish-list-control .price_${product_id} h2`).html('');
                    $(`.product_data .list_item .wish-list-control .price_${product_id} h2`).html(`₹${price}`);
                    qty++;
                    $(this).before('#qty').val(qty);
                    // window.location.reload();
                }
            });
        });
        // function updateCart(data) {
        //     // console.log('hello',data);

        // };
    </script>
@endpush
