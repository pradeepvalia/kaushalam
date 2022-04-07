@extends('frontview.front-master')
@section('frontcontent')
    <div class="main-container col2-left-layout ">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"><a href="{{ route('frontview.home') }}" title="Go to Home Page">Home</a>
                    </li>
                    <li class="category4"><a href="{{ route('frontview.slider') }}"
                            title="Go to t-shirt Page">T-SHIRT</a></li>
                    <li class="category4"><a
                            title="{{ $products->name }}"><strong>{{ $products->name }}</strong></a></li>
                </ul>
            </div>
        </div>
        <!--- .breadcrumbs-->
        <div class="container">
            <div class="main product_data">
                <div class="row">
                    <div class="col-main col-lg-12">
                        <div class="product-view">
                            <div class="product-essential">
                                <div class="row">
                                    <form action="#" method="post" id="product_addtocart_form">
                                        <div class="product-img-box clearfix col-md-5 col-sm-5 col-xs-12">
                                            <div class="product-img-content">
                                                <div class="product-image product-image-zoom">
                                                    <div class="product-image-gallery"><span
                                                            class="sticker top-left"></span>
                                                        <img id="image-main" class="gallery-image visible img-responsive"
                                                            src="{{ url('uploads/products/' . $products->image) }}"
                                                            alt="{{ $products->name }}" title="{{ $products->name }}"
                                                            style="height: 450px" />
                                                    </div>
                                                </div>
                                                <!--- .product-image-->
                                                <div class="more-views">
                                                    <h2>More Views</h2>
                                                    <ul class="product-image-thumbs">
                                                        <li>
                                                            <a class="thumb-link" href="#" title=""
                                                                data-image-index="0">
                                                                <img class="img-responsive sub_img"
                                                                    src="{{ url('uploads/products/' . $products->image) }}"
                                                                    style="height: 70px" alt="img" />
                                                            </a>
                                                        </li>
                                                        @foreach ($images as $image)
                                                            <li>
                                                                <a class="thumb-link" href="#" title=""
                                                                    data-image-index="">
                                                                    <img class="img-responsive sub_img"
                                                                        src="{{ url('uploads/products/' . $image->image) }}"
                                                                        style="height: 70px" alt="img" />
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!--- .more-views -->
                                            </div>
                                            <!--- .product-img-content-->
                                        </div>
                                        <!--- .product-img-box-->
                                        <div class="product-shop col-md-7 col-sm-7 col-xs-12">
                                            <div class="product-shop-content">
                                                <div class="product-name">
                                                    <h1>{{ $products->name }}<br>({{ $colour->name }}/{{ $category->name }})
                                                    </h1>
                                                </div>
                                                <div class="product-type-data">
                                                    <div class="price-box">
                                                        <p class="new-price"><span class="price">MRP:-
                                                                ₹{{ $products->price }} </span></p>
                                                    </div>
                                                    @if ($products->stock < 1)
                                                                <p class="availability in-stock ">Availability: <span
                                                                        style="color: red">Out Of Stock
                                                                    </span>
                                                                </p>
                                                            @elseif ($products->stock < 5)
                                                                <p class="availability in-stock ">Availability: <span
                                                                        style="color: red">Hurry up! only
                                                                        {{ $products->stock }} left !
                                                                    </span>
                                                                </p>
                                                            @else
                                                                <p class="availability in-stock ">Availability: <span>In
                                                                        stock</span>
                                                                </p>
                                                            @endif
                                                    <div class="products-sku"><span class="text-sku">PRODUCT
                                                            CODE:{{ $products->upc }}</span>
                                                    </div>
                                                </div>
                                                <div class="short-description">
                                                    <h2> Description</h2>
                                                    <p>{{ $products->discription }}</p>
                                                </div>
                                                <div class="add-to-box">
                                                    @if($products->stock >0)
                                                    <div class="product-qty">
                                                        <input type="hidden"
                                                            class="prod_id" value="{{ $products->id }}">
                                                        <label for="qty">Qty:</label>
                                                        <div class="custom-qty"> <input type="text" name="qty" id="qty"
                                                                maxlength="12" value="1" title="Qty"
                                                                class="input-text qty" />
                                                                <button type="button" class="increase items changeqty"
                                                                onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )&& qty < {{ $products->stock }}&& qty < 5) result.value++;return false;">
                                                                <i class="fa fa-plus"></i> </button>
                                                                <button type="button" class="reduced items changeqty"
                                                                onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) && qty > 1 ) result.value--;return false;">
                                                                <i class="fa fa-minus"></i> </button></div>
                                                    </div>

                                                <div class="add-to-cart">
                                                        <button type="button" id="btncart" title="Add to Cart"
                                                            class="button btn-cart"><span>
                                                                <span class="view-cart icon-handbag icons">Add to
                                                                    Cart</span> </span>
                                                        </button>

                                                    </div>
                                                    @else
                                                    <h1 style="color: red">OUT OF STOCK </h1>
                                                    @endif

                                                    <br>

                                                </div>
                                                <div class="addit">
                                                    <div class="alo-social-links clearfix">

                                                    </div>
                                                </div>
                                            </div>
                                            <!--- .product-shop-content-->
                                        </div>
                                        <!--- .product-shop-->
                                    </form>
                                </div>
                            </div>
                            <!--- .product-essential-->

                        </div>
                        <!--- .product-view-->
                    </div>
                    <!--- .col-main-->
                </div>
                <!--- .row-->
            </div>
            <!--- .main-->
        </div>
        <!--- .container-->
    </div>
    <!--- .main-container -->
@endsection
@push('front-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('resources/assets/front/scripts/jquery-3.4.1.min.js') }} "></script> --}}
    <script type="text/javascript">
        $(function() {
            $('.thumb-link').hover(function() {
                $('#image-main').
                attr('src', $(this).children('.sub_img').attr('src'));
            });

        });
        $('#btncart').click(function(e) {
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.prod_id').val();
            var product_qty = $(this).closest('.product_data').find('.qty').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/cart",
                data: {
                    'product_id': product_id,
                    'product_qty': product_qty,
                },

                success: function(response) {
                    swal("",response.status,"success")
                    if (response.minicart){
                            jQuery('.mini-contentCart').html(response.minicart);
                        }

                }
            });
        });


    </script>
@endpush
