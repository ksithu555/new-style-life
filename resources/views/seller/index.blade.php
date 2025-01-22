@extends('seller.seller_dashboard')
@section('seller')

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
                                <h4 class="mb-0 counter">{{ count($order) }}</h4>
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
                                <span class="m-0">Products</span>
                                <h4 class="mb-0 counter">{{ count($product) }}
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
                                <h4 class="mb-0 counter">{{ count($pending) }}</h4>
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
                                            <th>Order details</th>
                                            <th>Pay Type</th>
                                            <th>Commission<br>(%)</th>
                                            <th>Amount<br>(Tax Inc)</th>
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
                                                   {{ $item->payment }}
                                                </td>
                                                <td>{{$item->commission}}</td>
                                                <td>¥{{number_format($item->seller_amount) }}</td>

                                                <td class="col-sm-9">
                                                    @if($item->status == 1)
                                                     Paid
                                                    @else
                                                    <span style="color:red">Unpaid</span>
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
                <!--pagination -->
                @include('components.pagination')
            </div>
            <!-- Booking history  end-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- index body end -->

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
@endsection