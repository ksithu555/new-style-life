<x-auth-layout>

    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>
<!-- product review section start -->
<div class="page-body">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <!-- Table Start -->
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Product Reviews</h5>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="user-table ticket-table review-table theme-table table"
                                    id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Product Name</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($lists->isEmpty())
                                            <tr>
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @else
                                            @foreach( $lists as $key => $list )
                                            <tr>
                                                <th data-label="登録日" class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                                <td data-label="登録日">{{ date('Y/m/d', strtotime($list->reviewdate)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                <td>{{ $list->name }}</td>
                                                <td>{{ $list->product_name }}</td>
                                                @if ($list->stars_rated == NULL)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                No Rating
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 1)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 2)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 3)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @elseif($list->stars_rated == 4)
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @else
                                                    <td>
                                                        <ul class="rating">
                                                            <li>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                                <i class="fas fa-star theme-color"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                @endif
                                                <td>{{ $list->comment }}</td>
                                                <td>
                                                    <label class="switch">
                                                        <input data-width="80" data-id="{{$list->id}}" class="toggle-review" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle" data-on="Active" data-off="InActive"  {{ $list->status =='1' ? 'checked' : '' }}>
                                                    </label>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Table End -->
                </div>
            </div>
              <!--pagination -->
              @include('components.pagination')
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- product review section End -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function() {
        $('.toggle-review').change(function() {
            var status = $(this).prop('checked') ? 1 : 0;
            var review_id = $(this).data('id');

            $.ajax({
                type: "POST",
                url: '{{ route('statusreview') }}',
                data: {
                    'status': status,
                    'review_id': review_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    location.reload();
                }
            });
        });
    });
    </script>
</x-auth-layout>
