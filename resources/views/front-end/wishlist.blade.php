<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2">
            @foreach($wishlistProducts as $wishlistProduct)
                <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                    <div class="product-box-3 h-100">
                        <div class="product-header">
                            <div class="product-image">
                                <a href="{{ route('show-product-left-thumbnail', ['id' => $wishlistProduct->id]) }}">
                                    <img src="{{ asset('images/'.$wishlistProduct-> product_thambnail) }}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="product-header-top">
                                    <button class="btn wishlist-button close_button" data-wishlist-id="{{ $wishlistProduct->id }}">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="product-footer">
                            <div class="product-detail">
                                <span class="span-name">{{ $wishlistProduct->category_name }}</span>
                                <a href="{{ route('show-product-left-thumbnail', ['id' => $wishlistProduct->id]) }}">
                                    <h5 class="name">{{ $wishlistProduct->product_name }}</h5>
                                </a>
                                <h6 class="unit mt-1">{{ $wishlistProduct->product_size }}</h6>
                                <h5 class="price">
                                    <span class="theme-color">¥{{ number_format($wishlistProduct->selling_price, 0, '', ',') }}</span>
                                    @if ($wishlistProduct->discount_percent != 0)
                                    <del>¥{{ number_format($wishlistProduct->selling_price, 0, '', ',') }}</del>
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->

    <!-- latest jquery-->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.close_button').click(function() {
            var wishlistId = $(this).data('wishlist-id');

            $.ajax({
                url: '/delete-wishlist/' + wishlistId,
                method: 'get',
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting wishlist item:', error);
                }
            });
        });
    });
    </script>

</x-guest-layout>