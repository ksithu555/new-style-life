<x-auth-layout>
    <style>
        .custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: #f5f5f5;
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.5;
    color: #495057;
}

.custom-select:focus {
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

    </style>
    <!-- index body start -->
     <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <!-- chart card section start -->
                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 border-0  card-hover card o-hidden">
                        <div class="custome-1-bg b-r-4 card-body">
                            <div class="media align-items-center static-top-widget">
                                <div class="media-body p-0">
                                    <h7>This month</h7><br>
                                    <span class="m-0">Total Revenue</span>
                                    @php
                                    function formatCurrency($revenue) {
                                        if ($revenue >= 1000000) {
                                            return '¥' . round($revenue / 1000000) . 'M';
                                        }
                                        return '¥' . number_format($revenue);
                                    }
                                    @endphp
                                    <h4 class="mb-0 counter">{{ formatCurrency($revenue) }} </h4>
                                </div>
                                <div class="align-self-center text-center">
                                    <i class="ri-database-2-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                        <div class="custome-2-bg b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <h7>This month</h7><br>
                                    <span class="m-0">Total Orders</span>
                                    <h4 class="mb-0 counter">{{ $orderCount }}</h4>
                                </div>
                                <div class="align-self-center text-center">
                                    <i class="ri-shopping-bag-3-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 card-hover border-0  card o-hidden">
                        <div class="custome-3-bg b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <h7>All</h7><br>
                                    <span class="m-0">All Products</span>
                                    <h4 class="mb-0 counter">{{ $product }}
                                        <a href="{{ route('add.product') }}" class="badge badge-light-secondary grow">
                                            ADD NEW</a>
                                    </h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-store-3-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xxl-3 col-lg-6">
                    <div class="main-tiles border-5 card-hover border-0 card o-hidden">
                        <div class="custome-4-bg b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="media-body p-0">
                                    <h7>All</h7><br>
                                    <span class="m-0">Pending Orders</span>
                                    <h4 class="mb-0 counter">{{ $pending }}</h4>
                                </div>

                                <div class="align-self-center text-center">
                                    <i class="ri-shopping-bag-3-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- chart card section End -->

                <!-- Sales / Purchase Return star-->
                <div class="col-12">
                    <div class="card o-hidden">
                        <div class="card-header border-0 pb-1">
                            <div class="card-header-title">
                                <h4>Sales Graph&nbsp;<span>(2024Year）</span></h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <canvas id="myChart" height="100px"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Sales / Purchase Return end-->

                <!-- Booking history start-->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 pb-1">
                            <div class="card-header-title">
                                <h4>Transfer History</h4>
                            </div>
                        </div>

                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table class="user-table ticket-table review-table theme-table table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Transfer Code</th>
                                                <th>Shop</th>
                                                <th>Order details</th>
                                                <th>Pay Type</th>
                                                <th>Commission<br>(%)</th>
                                                <th>Amount</th>
                                                <th>Adjustment</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($transfer_history->isEmpty())
                                            <tr>
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($transfer_history as $key => $item )
                                                <tr>
                                                    <td>{{ ($ttl+1) - ($transfer_history->firstItem() + $key) }}</td>

                                                    <td>{{ \Carbon\Carbon::parse($item->start_date)->format('Y/m/d') }} ~ {{ \Carbon\Carbon::parse($item->end_date)->format('Y/m/d') }}
                                                      </td>
                                                    <td>{{$item->transfer_code}}</td>
                                                    <td>{{$item->shop_name}}</td>
                                                    <td>
                                                        <ul>
                                                            <li class="btn-icon">
                                                                <a href="{{ route('transfer_order_detail', ['transferId' => $item->id]) }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <td >
                                                        @if($item->status==0)
                                                        <select class="js-example-basic-single w-100 custom-select" name="payment" id="payment">
                                                            <option  value="0">Select PayType</option>
                                                            <option  value="PayPal" >PayPal</option>
                                                            <option  value="Bank">Bank</option>

                                                        </select>
                                                        @else
                                                        {{ $item->payment }}
                                                        @endif
                                                    </td>
                                                    <td>{{$item->commission}}</td>
                                                    <td>¥{{number_format($item->seller_amount) }}</td>
                                                    <td>
                                                        <div class="row d-flex mx-auto">
                                                            <div class="col-md-2 d-flex align-items-center justify-content-center">
                                                                @if($item->adjust_amount)<span style="margin-left: 100px;font-weight:300px">¥{{$item->adjust_amount}} @endif</span>
                                                            </div>
                                                            <div class="col-md-10 d-flex align-items-center justify-content-start">
                                                                <button class="btn w-50 theme-bg-color" style="margin-left: 50px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#adjustModal{{ $item->id }}"
                                                                    onclick="">Adjust
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td class="col-sm-9">
                                                        @if($item->status==0)
                                                        <label class="switch">
                                                            <input data-width="100" data-id="{{$item->id}}" class="toggle-class" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle"
                                                            data-on="Paid" data-off="Unpaid"  {{ $item->status ? 'checked' : '' }}>
                                                        </label>
                                                        @else
                                                        <label class="switch">
                                                            <input data-width="100" data-id="{{$item->id}}" class="toggle-class" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle"
                                                            data-on="Paid" data-off="Unpaid"  {{ $item->status ? 'checked' : '' }} disabled>
                                                        </label>
                                                        @endif
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
                    @include('components.pagination')
                </div>
                <!-- Booking history  end-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <!-- index body end -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') ? 1 : 0;
                var transfer_id = $(this).data('id');
                var payment = $('#payment').val();
                alert(payment);
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('transferstatus') }}",
                    data: {
                        'status': status,
                        'transfer_id': transfer_id,
                        'payment': payment,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        alert('2');
                        console.log(data.success);
                    }
                });
            });
        });
    </script>


@foreach ($transfer_history as $key => $item )
<div class="modal fade theme-modal remove-commission" id="adjustModal{{ $item->id }}" aria-hidden="true" tabindex="-1">{{ $item->id }}
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Enter Adjustment Amount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="commission-form{{ $item->id }}" method="POST" action="{{ route('updateadjust') }}" style="display:flex;">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number" class="form-control" id="adjust{{ $item->id }}"  value="{{ old('adjust') ?? $item->adjust_amount ?? '' }}"
                        name="adjust" placeholder="Enter Adjustment Amount">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="adjustId{{ $item->id }}" name="adjustId" value="{{ $item->id }}">

                    <button type="submit" class="btn btn-animation btn-md fw-bold me-2">Save</button>
                    <button type="button" class="btn btn-animation btn-md fw-bold me-2"  data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Define labels and data passed from the backend
            const labels = @json($labels);
            const data = @json($data);

            // Render the chart
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Sales',
                        data: data,
                        backgroundColor: 'rgba(13, 164, 135, 0.2)',
                        borderColor: '#417394',
                        borderWidth: 1,
                        borderDash: [5, 5] // Display dashed line for each data point
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    </x-auth-layout>