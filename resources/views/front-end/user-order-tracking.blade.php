<x-guest-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <div class="page-body">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>Orders</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Orders</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->
    
        <!-- User Dashboard Section Start -->
        <section class="user-dashboard-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 col-lg-4">
                        <div class="dashboard-left-sidebar">
                            <div class="close-button d-flex d-lg-none">
                                <button class="close-sidebar">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="profile-box">
                                <div class="cover-image">
                                    <img src="{{ asset('frontend/assets/images/inner-page/cover-img.jpg') }}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
    
                                <div class="profile-contain">
                                    <div class="profile-image">
                                        <div class="position-relative">
                                            @if ($user->user_photo)
                                            <img src="{{ asset('upload/profile/' . $user->user_photo) }}"
                                                class="blur-up lazyload update_img" alt=""  id="uploaded_image">
                                            @else
                                            <img src="{{ asset('frontend/assets/images/profile.png') }}"
                                                class="blur-up lazyload update_img" alt=""  id="uploaded_image">
                                            @endif
                                                <div class="cover-icon">
                                                    <label for="user_profile_upload_input">
                                                        <i class="fa-solid fa-pen">
                                                        <input type="file" id="user_profile_upload_input" name="user_profile" class="form-control" onchange="uploadUserProfile()">
                                                        </i>
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
    
                                    <div class="profile-name">
                                        <h3>{{ $user->name }}</h3>
                                        <h6 class="text-content">{{ $user->email }}</h6>
                                    </div>
                                </div>
                            </div>
    
                            <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-dashboard-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-dashboard" type="button" style="font-size: 14px; text-align: center;" ><i data-feather="home"></i>
                                        DashBoard</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-order-tab" 
                                        style="font-size: 14px; text-align: center;" href="{{route ('user_order')}}"><i
                                            data-feather="shopping-bag"></i>Orders</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="delivery-detail" 
                                        type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_deivery_status')}}"><i data-feather="box"></i>
                                        Delivered Status</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-address-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_addresses')}}"><i
                                            data-feather="map-pin"></i>Addresses</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-card-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i
                                            data-feather="credit-card"></i>Payment Methods</a>
                                </li> --}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                        Profile</a>
                                </li>
                            </ul>
                        </div>
                    </div>
    
                    <!-- User Dashboard Section End -->
                   
                    <div class="col-xxl-9 col-lg-8">
                        <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                            My Menu</button>
                            <div class="dashboard-right-sidebar">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-order" role="tabpanel">
                                            <!-- Order Tracking Section Start -->
                                            @foreach($orderDetails as $orderdata)
                                            <section class="order-detail">
                                                <div class="container-fluid-lg">
                                                    <div class="row g-sm-4 g-3">
                                                        <div class="col-xl-4 col-sm-6">
                                                            <div class="order-details-contain">
                                                                <div class="order-tracking-icon">
                                                                    <i class="text-content" data-feather="crosshair"></i>
                                                                </div>
    
                                                                <div class="order-details-name">
                                                                    <h5 class="text-content">From</h5>
                                                                    <h4>{{ $orderdata->zip_code}},{{ $orderdata->city}},{{ $orderdata->chome}},{{ $orderdata->building}},{{ $orderdata->room}}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-xl-4 col-sm-6">
                                                            <div class="order-details-contain">
                                                                <div class="order-tracking-icon">
                                                                    <i class="text-content" data-feather="map-pin"></i>
                                                                </div>
    
                                                                <div class="order-details-name">
                                                                    <h5 class="text-content">Destination</h5>
                                                                    <h4>{{ $orderdata->code}},{{ $orderdata->buyercity}},{{ $orderdata->buyerchome}},{{ $orderdata->buyerbuilding}},{{ $orderdata->buyerroom}}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-xl-4 col-sm-6">
                                                            <div class="order-details-contain">
                                                                <div class="order-tracking-icon">
                                                                    <i class="text-content" data-feather="calendar"></i>
                                                                </div>
    
                                                                <div class="order-details-name">
                                                                    <h5 class="text-content">Estimated Time</h5>
                                                                    <h4>{{ $orderdata->expected_from}}~{{ $orderdata->expected_to}}</h4>
                                                                </div>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-12 overflow-hidden">
                                                        <ol class="progtrckr">
                                                            <li class="{{ !empty($order->confirmed_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                                <h5>Order Confirmed</h5>
                                                            </li>
                                                            <li class="{{ !empty($order->processing_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                                <h5>Processing</h5>
                                                            </li>
                                                            <li class="{{ !empty($order->picked_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                                <h5>Pick-up</h5>
                                                            </li>
                                                            <li class="{{ !empty($order->shipped_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                                <h5>Shipped</h5>
                                                            </li>
                                                            <li class="{{ !empty($order->delivered_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                                <h5>Delivered</h5>
                                                            </li>
                                                        </ol>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            @endforeach
                                             <!-- Order Detail Section End -->
    
                                            <!-- Order Table Section Start -->
                                            <section class="order-table-section section-b-space">
                                            <div class="table-responsive dashboard-bg-box">
                                <table class="table product-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Location</th>
    
                                        </tr>
                                     </thead>
                                     <tbody>
                                    @php $counter = 1; @endphp
                                    @if ($process->isEmpty())
                                        <tr>
                                            <td colspan="4" style="text-align: center">No data available</td>
                                        </tr>
                                    @else
                                        @foreach ($process as $key => $item)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                @if (!empty($item->confirmed_date))
                                                    <td><p class="fw-bold">Confirmed</p></td>
                                                    <td><p class="fw-bold">{{ $item->confirmed_date }}</p></td>
                                                @elseif (!empty($item->processing_date))
                                                    <td><p class="fw-bold">Processing</p></td>
                                                    <td><p class="fw-bold">{{ $item->processing_date }}</p></td>
                                                @elseif (!empty($item->picked_date))
                                                    <td><p class="fw-bold">Picked</p></td>
                                                    <td><p class="fw-bold">{{ $item->picked_date }}</p></td>
                                                @elseif (!empty($item->shipped_date))
                                                    <td><p class="fw-bold">Shipped</p></td>
                                                    <td><p class="fw-bold">{{ $item->shipped_date }}</p></td>
                                                @else
                                                    <td><p class="fw-bold">Delivered</p></td>
                                                    <td><p class="fw-bold">{{ $item->delivered_date }}</p></td>
                                                @endif
                                                <td>
                                                    <h6>{{ $locationcity }}, {{ $locationchome }}</h6>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    @endif
    
                                       
                                    </tbody>
                                    </table>
                                        </div>
                  
                                    </div>
                                </div>  
                            </div>
                                            </section>
                                            <!-- Order Table Section End -->
                                            <!-- Order Tracking Section End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- User Dashboard Section End -->
    
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function mainThamUrl(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src', e.target.result).width(70).height(70);
                };
                reader.readAsDataURL(input.files[0]); // Corrected method name
            }
        }
    </script>
    <script>
        document.getElementById('multiImg').addEventListener('change', function(event) {
            const preview = document.getElementById('preview_img');
            preview.innerHTML = '';
    
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.maxHeight = '100px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    
    </x-guest-layout>