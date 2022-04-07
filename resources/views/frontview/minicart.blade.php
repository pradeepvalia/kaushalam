<p class="block-subtitle">Recently added item(s)</p>
@php $total = 0;  @endphp
@foreach ($cartitems->slice(0, 3) as $item)

<ol id="cart-sidebar" class="mini-products-list clearfix">
    {{--  --}}
    <li class="item clearfix">
        <div class="cart-content-top">
            <a href="{{ $item->product->name }}" title="{{ $item->product->name }}">
                <img src="{{ url('uploads/products/' . $item->product->image) }}" width="70" />
            </a> &nbsp;

            <div class="product-details">
                <p class="product-name">
                    <a href="{{ $item->product->name }}"
                        title="{{ $item->product->name }}">{{ $item->product->name }}</a>
                </p>
                <strong>{{ $item->qty }} * </strong> <span
                    class="price">₹{{ $item->product->price * $item->qty }}/-</span>
            </div>
        </div>
    </li>
</ol>
@php
    $total += $item->product->price * $item->qty;
@endphp
@endforeach
<p class="subtotal"> <span class="label">Subtotal:</span>
<span class="price">₹{{ $total }}/-</span>
</p>
<div class="actions"> <a href="{{ url('/mycart') }}" class="view-cart"> View cart </a>

</div>
