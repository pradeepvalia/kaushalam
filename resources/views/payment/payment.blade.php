@extends('frontview.front-master')
@section('frontcontent')
    <style>
        .btn-step.continue:hover
        {
            color: white;
        }
    </style>
    <div class="main-container col1-layout content-color color">
        <div class="breadcrumbs">
            <div class="container">
                <ul>
                    <li class="home"><a href="#" title="Go to Home Page">Home</a></li>
                    <li><strong>Checkout</strong></li>
                </ul>
            </div>
        </div><!--- .breadcrumbs-->
        <div class="woocommerce">
            <div class="container">
                <div class="content-top">
                    <h2>Checkout</h2>
                    <p>Need to Help? Call us: +9 123 456 789 or Email: <a href="mailto:Support@Rosi.com">Support@Rosi.com</a></p>
                </div>
                <div class="checkout-step-process">
                    <ul>

                        <li>
                            <div class="step-process-item"><i data-href="checkout-step2.html" class="redirectjs fa fa-check step-icon"></i><span class="text">Address</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i class="fa fa-check step-icon"></i><span class="text">Shipping</span></div>
                        </li>
                        <li>
                            <div class="step-process-item active"><i data-href="checkout-step4.html" class="redirectjs step-icon icon-wallet"></i><span class="text">Delivery & Payment</span></div>
                        </li>
                        <li>
                            <div class="step-process-item"><i data-href="checkout-step5.html" class="redirectjs step-icon icon-notebook"></i><span class="text">Order Review</span></div>
                        </li>
                    </ul>
                </div>
                <form action="{{url('store/payment/details')}}" name="credit_cart" class="form-in-checkout" method="post">
                    @csrf
                    <div class="checkout-info-text">
                        <h3>Payment Method</h3>
                    </div>
                    <div class="content-radio">
                        <input type="radio" name="payment_method" value="0" checked id="cod">
                        <label for="cod" class="label-radio">Cash on delivery</label>
                        <p>Pay for the package when you recieve it.</p>
                    </div>


                    <div class="checkout-col-footer text-right col-md-9">
                        <a href="{{url('/shipping')}}" class="btn-step">Back</a>
                        <a class="btn-step btn-highligh" href="{{ url('/order') }}"> Continue </a>
                                        </div>
                    <div class="line-bottom"></div>
                </form>
            </div>
        </div><!--- .woocommerce-->
    </div><!--- .main-container -->
    @endsection
    @push('front-script')
    <script type="text/javascript">

    </script>
@endpush


