<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Shop List</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Grid Section Start -->
    <section class="section-b-space seller-grid-section">
        @php
        function formatZipCode($zipCode)
        {
        if (preg_match('/^\d{3}-\d{4}$/', $zipCode)) {
        return $zipCode;
        }
        if (preg_match('/^\d{7}$/', $zipCode)) {
        return substr($zipCode, 0, 3) . '-' . substr($zipCode, 3, 4);
        }
        return $zipCode; // return as-is if not a standard 7 digit zip code
        }
        @endphp
        <div class="container-fluid-lg">
            <div class="row g-4">
                @if ($lists->count() < 1) <h1 class="text-center">No Shop Available</h1>
                    @endif
                    @foreach ($lists as $shop => $seller)
                    <div class="col-xxl-4 col-md-6">
                        <a href="{{ url('/shopleftsidebar/' . $seller->user_id) }}" class="seller-grid-box">
                            <div class="grid-contain">
                                <div class="seller-contact-details">
                                    <div class="seller-contact">
                                        <div class="seller-icon">
                                            <i class="fa-solid fa-map-pin"></i>
                                        </div>

                                        <div class="contact-detail">
                                            <h5>Address: <span> 〒{{ $seller->zip_code }}</span>
                                                <span>{{ $seller->country->name }} {{ $seller->prefecture }}
                                                    {{ $seller->city }} {{ $seller->chome }} {{ $seller->building }}
                                                    {{ $seller->room }}</span>
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="seller-contact">
                                        <div class="seller-icon">
                                            <i class="fa-solid fa-phone"></i>
                                        </div>

                                        <div class="contact-detail">

                                            <h5>Contact Us: <span>{{ $seller->phone }}</span></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="contain-name">
                                    <div>
                                        <h6>Since {{ \Carbon\Carbon::parse($seller->shop_establish)->format('Y') }}
                                        </h6>
                                        <h3>{{ $seller->shop_name }}</h3>
                                        <div class="product-rating">
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++) @if ($i <=$ratingWithProductCount[$shop][0]) <li><i data-feather="star" class="fill"></i></li>
                                                    @else
                                                    <li><i data-feather="star"></i></li>
                                                    @endif
                                                    @endfor
                                            </ul>
                                            <span>({{ $ratingWithProductCount[$shop][1] }}
                                                <?php echo $ratingWithProductCount[$shop][1] > 1 ? 'Reviews' : 'Review'; ?>)</span>
                                        </div>
                                        @php $shopProductCount = 0; @endphp
                                        @foreach ($seller->user->products as $product)
                                        @if ($product->status == 1)
                                        @php $shopProductCount++; @endphp
                                        @endif
                                        @endforeach
                                        @if ($shopProductCount > 1)
                                        <span class="product-label">{{ $shopProductCount }} Products</span>
                                        @else
                                        <span class="product-label">{{ $shopProductCount }} Product</span>
                                        @endif
                                    </div>

                                    <div class="grid-image">
                                        <img src="{{ asset('images/' . $seller->shop_logo) }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach

            </div>

            @include('components.pagination')
        </div>
    </section>
    <!-- Grid Section End -->
</x-guest-layout>