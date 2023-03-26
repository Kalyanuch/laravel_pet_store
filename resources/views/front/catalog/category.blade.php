@extends('front.layout.layout')

@section('content')
    <!-- Home -->

    <div class="home home-notmain">
        <div class="home_container">
            <div class="home_background" style="background-image:url({{ asset('assets/front/images/categories.jpg') }})"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{ $category->title }}<span>.</span></div>
                                <div class="home_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros. Sed viverra velit venenatis fermentum luctus.</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($child))
    <div class="categories">
        <div class="container">
            <h3>Sub categories</h3>
            <div class="row">
                @foreach($child as $item)
                    <div class="col-lg-2"><a href="{{ route('front.category', ['slug' => $item->slug]) }}">{{ $item->title }}</a></div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Showing <span>12</span> results</div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Sort by</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "title" }'><span>Name</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($products))
            <div class="row">
                <div class="col">
                    <div class="product_grid">
                        @foreach($products as $item)
                            <!-- Product -->
                            <div class="product">
                                <div class="product_image"><img src="{{ asset('assets/front/images/product_1.jpg') }}" alt=""></div>
                                <div class="product_extra product_new"><a href="categories.html">New</a></div>
                                <div class="product_content">
                                    <div class="product_title"><a href="{{ route('front.product', ['slug' => $item->slug]) }}">{{$item->title}}</a></div>
                                    <div class="product_price">${{ $item->price }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @include('front.common.pagination_component', ['items' => $products])
                </div>
            </div>
            @else
                <h4>{{ __('front.text_empty') }}</h4>
            @endif
        </div>
    </div>

    <!-- Icon Boxes -->

    <div class="icon_boxes">
        <div class="container">
            <div class="row icon_box_row">

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="{{ asset('assets/front/images/icon_1.svg') }}" alt=""></div>
                        <div class="icon_box_title">Free Shipping Worldwide</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="{{ asset('assets/front/images/icon_2.svg') }}" alt=""></div>
                        <div class="icon_box_title">Free Returns</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="{{ asset('assets/front/images/icon_3.svg') }}" alt=""></div>
                        <div class="icon_box_title">24h Fast Support</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Newsletter -->

    <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="newsletter_border"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="newsletter_content text-center">
                        <div class="newsletter_title">Subscribe to our newsletter</div>
                        <div class="newsletter_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie eros</p></div>
                        <div class="newsletter_form_container">
                            <form action="#" id="newsletter_form" class="newsletter_form">
                                <input type="email" class="newsletter_input" required="required">
                                <button class="newsletter_button trans_200"><span>Subscribe</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
