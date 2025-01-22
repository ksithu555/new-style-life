<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2 class="mb-2">Compare</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Compare</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Compare Section Start -->
    <section class="compare-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table compare-table">
                            <tbody>
                                <tr>
                                    <th>Product</th>
                                    @foreach($comparelistProducts as $product)
                                        <td>
                                            <a class="text-title" href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}">
                                            {{ $product->product_name }}</a>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Images</th>
                                    @foreach($comparelistProducts as $product)
                                    <td>
                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}" class="compare-image">
                                            <img src="{{ asset('images/'.$product-> product_thambnail) }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                    </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Size</th>
                                    @foreach($comparelistProducts as $product)
                                        <td class="text-content">
                                            {{-- {{ $product->product_size }} --}}
                                            <ul class="brand-list">
                                                @php
                                                    $sizes = explode(',', $product->product_size);
                                                @endphp
                                                <li>
                                                    <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                                        @foreach($sizes as $key => $size)
                                                            <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                                <input class="form-check-input" type="radio" name="selected_size_{{ $product->id }}" 
                                                                    value="{{ $size }}" id="size_{{ $product->id }}_{{ $size }}" 
                                                                    {{ $key === 0 ? 'checked' : '' }}>
                                                                <label for="size_{{ $product->id }}_{{ $size }}">{{ $size }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Color</th>
                                    @foreach($comparelistProducts as $product)
                                        <td class="text-content">
                                            {{-- {{ $product->product_color }} --}}
                                            <ul class="brand-list">
                                                @php
                                                    $colors = explode(',', $product->product_color);
                                                @endphp
                                                <li>
                                                    <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                                        @foreach($colors as $key => $color)
                                                            <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                                <input class="form-check-input" type="radio" name="selected_color_{{ $product->id }}" 
                                                                    value="{{ $color }}" id="color_{{ $product->id }}_{{ $color }}" 
                                                                    {{ $key === 0 ? 'checked' : '' }}>
                                                                <label for="color_{{ $product->id }}_{{ $color }}">{{ $color }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Price</th>
                                    @foreach($comparelistProducts as $product)
                                        <td class="text-content">
                                        @if ($product->discount_percent != 0)
                                            <h4 class="price"><span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                            <del>¥{{ number_format($product->original_price, 0, '', ',') }}</del>
                                        @else
                                            <h4 class="price"><span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                        @endif
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Rating</th>
                                    @foreach($comparelistProducts as $key => $product)
                                    <td>
                                        <div class="compare-rating">
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $ratingWithProductCount[$key][0])
                                                        <li><i data-feather="star" class="fill"></i></li>
                                                    @else
                                                        <li><i data-feather="star"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                            <span class="text-content">({{ $ratingWithProductCount[$key][1] }} Reviews)</span>
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Purchase</th>
                                    @foreach($comparelistProducts as $product)
                                    <td>
                                        <button onclick="addToCart({{ $product->id }})"
                                            class="btn btn-animation btn-sm w-100">Add To Cart</button>
                                    </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th></th>
                                    @foreach($comparelistProducts as $product)
                                    <td>
                                        <a href="javascript:void(0)" class="text-content remove_column" data-comparelist-id="{{ $product->id }}">
                                            <i class="fa-solid fa-trash-can me-2"></i> Remove
                                        </a>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Compare Section End -->

    <!-- latest jquery-->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

    <!-- table column remove -->
    <script src="{{ asset('frontend/assets/js/table-column-remove.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.remove_column').click(function(e) {
                e.preventDefault();
                var comparelistId = $(this).data('comparelist-id');

                $.ajax({
                    url: '/delete-comparelist/' + comparelistId,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        // For example: $(this).closest('tr').remove();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting comparelist item:', error);
                    }
                });
            });
        });
    </script>
    <script>
        function addToCart(productId) {
            const selectedSize = document.querySelector(`input[name="selected_size_${productId}"]:checked`).value;
            const selectedColor = document.querySelector(`input[name="selected_color_${productId}"]:checked`).value;
            
            const url = new URL('{{ route('show_carts', ['id' => '__ID__']) }}'.replace('__ID__', productId));
            url.searchParams.append('size', selectedSize);
            url.searchParams.append('color', selectedColor);
            
            location.href = url.toString();
        }
    </script>

</x-guest-layout>