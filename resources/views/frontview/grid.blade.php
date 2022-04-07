<div>
    <ul class="products-grid row products-grid--max-3-col last odd">
        @foreach ($products as $product)
            <li class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-mobile-12 item">
                <div class="category-products-grid">
                    <div class="images-container">
                        <div class="product-hover">
                            {{-- <span class="sticker top-left"><span class="labelnew">New</span></span> --}}
                            <a href="{{ url($product->url)}}" title="{{ $product->name }}"
                                class="product-image">
                                <img id="product-collection-image-8"  class="img-responsive"
                                    src="{{ url('uploads/products/' . $product->image) }}" alt="" height="355"
                                    width="278">
                                <span class="product-img-back"> <img class="img-responsive"
                                        src="{{ url('uploads/products/' . $product->image) }}" alt="" height="355"
                                        width="278"> </span>
                            </a>
                        </div>
                        {{-- <div class="actions-no hover-box">
                            <div class="actions">
                                <button type="button" title="Add to Cart" id="btncart" class="button btn-cart pull-left"><span><i
                                            class="icon-handbag icons"></i><span>Add to Cart</span></span></button>
                            </div>
                        </div> --}}
                    </div>
                    <div class="product-info products-textlink clearfix">
                        <h2 class="product-name"><a href="{{ url($product->url)}}" title="Configurable Product">{{ $product->name }}</a>
                        </h2>

                        <div class="price-box"> <span class="regular-price"> <span
                                    class="price">₹{{ $product->price }}
                                    <br>{{ $product->category->name }}({{ $product->colour->name }})</span> </span>
                        </div>
                        <div class="ratings">
                            <div class="discription-box">
                                <p> {{ $product->discription }}</p>
                            </div>

                            <span class="amount"><a href="#">1 Review(s)</a></span>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <!--- .products-grid-->
</div>
<!--- .category-products-->
