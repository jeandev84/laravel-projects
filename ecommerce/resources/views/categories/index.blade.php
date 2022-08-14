@extends('layouts.main')

@section('title', $category->title)

<!-- add own custom css -->
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
@endsection


@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url('/images/{{ $category->img }}')"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">
                                    {{ $category->title }}<span>.</span>
                                </div>
                                <div class="home_text">
                                    <p>{{ $category->desc }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Showing <span>( {{ $category->products->count() }} )</span> results</div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Sort by</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <!--
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "stars" }'><span>Name</span></li>
                                            -->

                                            <li class="product_sorting_btn" data-order="default"><span>Default</span></li>
                                            <li class="product_sorting_btn" data-order="price-low-high"><span>Price: Low-High</span></li>
                                            <li class="product_sorting_btn" data-order="price-high-low"><span>Price: High-Low</span></li>
                                            <li class="product_sorting_btn" data-order="name-a-z"><span>Name: A-Z</span></li>
                                            <li class="product_sorting_btn" data-order="name-z-a"><span>Name: Z-A</span></li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">


                        <!-- Products Category -->
{{--                    @foreach($category->products as $product)--}}
                        @foreach($products as $product)

                        @php
                            // вызываем название метод $product->images() как свойство
                            // dd($product->images);

                            $image = '';

                            // если у нас количество картинок продукта больше нуля
                            // то выберем первую картинку
                            if (count($product->images) > 0) {

                                $image = $product->images[0]['img'];

                            } else { // Иначе выводим просто картинку по умолчанию

                                $image = 'no_image.png';
                            }

                        @endphp

                        <div class="product">
                            <div class="product_image">
                                <img src="images/{{ $image }}" alt="{{ $product->title }}">
                            </div>
                            <div class="product_extra product_new">
                                <a href="{{ route('show.category', $product->category['alias']) }}">
                                    {{ $product->category['title'] }}
                                </a>
                            </div>
                            <div class="product_content">
                                <div class="product_title">
                                    <a href="{{ route('show.product', ['category', $product->id]) }}">{{ $product->title }}</a>
                                </div>

                                @if($product->new_price != null)
                                    <div style="text-decoration: line-through">${{ $product->price }}</div>
                                    <div class="product_price">${{ $product->new_price }}</div>
                                @else
                                    <div class="product_price">${{ $product->price }}</div>
                                @endif

                            </div>
                        </div>
                        @endforeach


                </div>
            </div>
        </div>
    </div>

    <!-- Icon Boxes -->

    <div class="icon_boxes">
        <div class="container">
            <div class="row icon_box_row">

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
                        <div class="icon_box_title">Free Shipping Worldwide</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
                        <div class="icon_box_title">Free Returns</div>
                        <div class="icon_box_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam a ultricies metus. Sed nec molestie.</p>
                        </div>
                    </div>
                </div>

                <!-- Icon Box -->
                <div class="col-lg-4 icon_box_col">
                    <div class="icon_box">
                        <div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
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


<!-- add own custom css -->
@section('custom_js')
    <script>

        $(document).ready(function () {
             $('.product_sorting_btn').click(function () {
                  // console.log('hello')

                  let orderBy = $(this).data('order') // получаем "data-order"
                  // console.log(orderBy)

                  $.ajax({
                      url: "{{ route('show.category', $category->alias) }}",
                      type: "GET",
                      data: {
                          orderBy: orderBy
                      },
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token').attr('content')
                      },
                      success: (data) => {
                            // console.log(data)
                            $('.product_grid').html(data)

                            // plugin isotope
                            $('.product_grid').isotope('destroy')
                            $('.product_grid').imagesLoaded(function () {

                                var grid = $('.product_grid').isotope({
                                    itemSelector: '.product',
                                    layoutMode: 'fitRows',
                                    fitRows: {
                                        gutter: 30
                                    }
                                })

                            })

                      }
                  })
             })
        })


    </script>
@endsection
