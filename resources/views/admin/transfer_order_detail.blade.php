<x-auth-layout>


    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <style>
        .theme-table {
            border-collapse: collapse; /* Ensure borders don't double up */
        }

        .theme-table tr {
            border: 1px solid #ccc; /* Thin border for table rows */
        }

        .theme-table td {
            border: 1px solid #ccc; /* Thin border for table cells */
        }

        .theme-table tr:nth-child(odd) {
            background-color: #f9f9f9; /* Gray */
        }

        .theme-table tr:nth-child(even) {
            background-color: #ffffff; /* White */
        }

        .theme-table td[rowspan] {
            background-color: inherit; /* Inherit background color from parent row */
        }

    </style>
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th  style="min-width: 70px">No</th>
                                                <th  style="min-width: 70px">Order Code</th>
                                                <th style="min-width: 150px">Ordered Date</th>
                                                <th style="min-width: 50px">Buyer Name</th>
                                                <th style="min-width: 50px">Product Name</th>
                                                <th style="min-width: 50px">Quantity</th>
                                                <th style="min-width: 50px">Amount<br>(Tax Inc)</th>
                                                <th style="min-width: 50px">Delivery Price<br>(Tax Inc)</th>
                                                <th style="min-width: 50px">Coupon Discount<br>(Tax Inc)</th>
                                                <th style="min-width: 50px">Commission(%)</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $currentOrderCode = null;
                                                $orderCodeCount = 0;
                                            @endphp
                                            @foreach($lists as $key => $list)
                                                @php
                                                    if ($currentOrderCode !== $list->order->order_code) {
                                                        // Update the current order code and reset the counter
                                                        $currentOrderCode = $list->order->order_code;
                                                        // Count the number of rows with the same order code
                                                        $orderCodeCount = $lists->where('order.order_code', $list->order->order_code)->count();
                                                    } else {
                                                        $orderCodeCount--;
                                                    }
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                                                    @if ($orderCodeCount == $lists->where('order.order_code', $list->order->order_code)->count())
                                                        <td style="border: 1px solid #ccc;" rowspan="{{ $lists->where('order.order_code', $list->order->order_code)->count() }}">
                                                            {{ $list->order->order_code }}</td>
                                                        <td style="border: 1px solid #ccc;" rowspan="{{ $lists->where('order.order_code', $list->order->order_code)->count() }}">
                                                            {{ date('Y/m/d H:i', strtotime($list->created_at)) }}</td>
                                                    @endif
                                                    <td>{{ $list->buyer->name }}</td>
                                                    <td>{{ $list->product->product_name }}</td>
                                                    <td>{{ $list->qty }}</td>
                                                    <td>¥{{ number_format($list->amount, 0, '', ',') }}</td>
                                                    @if ($list->used_delivery_price == 1)
                                                        <td>¥{{ $list->delivery_price }}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    <td>¥{{ $list->order->coupon_discount_amount }}</td>
                                                    <td>{{ $list->product->commission }}%</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--pagination -->
                    @include('components.pagination')
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('#table_id tbody tr');
            rows.forEach((row, index) => {
                const rowspanCell = row.querySelector('td[rowspan]');
                if (rowspanCell) {
                    const rowspan = parseInt(rowspanCell.getAttribute('rowspan'));
                    const color = getComputedStyle(row).backgroundColor;
                    for (let i = 1; i < rowspan; i++) {
                        if (rows[index + i]) {
                            rows[index + i].style.backgroundColor = color;
                        }
                    }
                }
            });
        });
    </script>
</x-auth-layout>
