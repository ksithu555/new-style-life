<x-auth-layout>
    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>Shop</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 70px">No</th>
                                                <th style="min-width: 150px">Date</th>
                                                <th style="min-width: 150px">Shop Image</th>
                                                <th  style="min-width: 150px">Shop Name</th>
                                                <th  style="min-width: 150px">Commission(%)</th>
                                                <th  style="min-width: 150px">Commission</th>
                                                <th  style="min-width: 150px" >Coupon Code</th>
                                                <th  style="min-width: 100px">Coupon</th>
                                                <th style="min-width:  100px">Status</th>
                                                <th  style="min-width: 100px">Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach( $lists as $key => $list )

                                                <tr>
                                                    <td data-label="" class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                                                    <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                    <td data-label="{{ __('auth.image') }}"><img src="{{ asset('images/'.($list->shop_logo)   ) }}" alt="thumb"  style="width: 50px;"></td>
                                                    <td data-label="氏名"><a
                                                      href="{{ url('/shoptakeremote/'.rand ( 10000 , 99999 ).$list->user_id ) }}"
                                                      >{{ $list->shop_name }}</a></td>
                                                    <td data-label="" >{{ $list->commission }}%</td>
                                                    <td class="col-sm-9">

                                                        <button class="btn w-50 theme-bg-color" style = "margin-left: 50px;"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#commissionModal{{ $list->id }}"
                                                                onclick="">Commission
                                                        </button>

                                                    </td>
                                                    @if ($list->coupon_status == 1)
                                                    <td data-label="" ><a href='{{ url("/coupon/".$list->coupon_id ) }}'>{{ $list->coupon_code }}</a></td>
                                                    @else
                                                    <td data-label="" >-</td>
                                                    @endif
                                                    <td class="col-sm-9">
                                                        @if($list->coupon_status == 1)
                                                            <button class="btn w-50" style = "background-color: #ff6b6b;margin-left: 30px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#removeProfile{{ $list->id }}"
                                                                    onclick="showDeleteModal('{{ $list->id }}')"
                                                                    onclick="">Remove
                                                            </button>
                                                        @else
                                                            <button class="btn w-50 theme-bg-color" style = "margin-left: 30px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#couponModal{{ $list->id . $list->coupon_id }}"
                                                                    onclick="">Coupon
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td class="col-sm-9">
                                                        <label class="switch">
                                                            <input data-width="100" data-id="{{$list->id}}" class="toggle-class" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive"  {{ $list->status ? 'checked' : '' }}>
                                                        </label>
                                                    </td>


                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="{{ url("/shop/".$list->id ) }}">
                                                                    <i class="ri-eye-line"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
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
        <!-- Modal -->
    @foreach( $lists as $key => $list )

    <div class="modal fade theme-modal remove-coupon" id="couponModal{{ $list->id . $list->coupon_id }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Select Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Clost">
                            <i class="fas fa-times"></i>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <!-- Add class "js-example-basic-single" to select element to initialize Select2 -->
                        <select class="form-control js-example-basic-single" id="coupon-select">
                                @foreach($coupons as $coupon)

                                    <option value="{{ $coupon->id }}"  @if($coupon->id == $list->coupon_id ) selected @endif >{{ $coupon->coupon_code }} </option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <form id="coupon-form" method="POST" action="{{ route('updatecoupon') }}" style="display:flex;">
                        @csrf
                        <input type="hidden" id="coupon-id" name="couponid" value="">
                        <input type="hidden" name="id" value="{{ $list->id }}">
                        <button type="submit" class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                            data-bs-toggle="modal" data-bs-dismiss="modal" >Yes</button>
                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach($lists as $key => $list)
<div class="modal fade theme-modal remove-commission" id="commissionModal{{ $list->id }}" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Enter Commission(%)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="commission-form{{ $list->id }}" method="POST" action="{{ route('updatecommission') }}" style="display:flex;">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number" class="form-control" id="commission{{ $list->id }}"  value="{{ old('commission') ?? $list->commission ?? '' }}"
                        name="commission" placeholder="Enter commission">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="commission-id{{ $list->id }}" name="commissionid" value="{{ $list->id }}">
                    <input type="hidden" name="id" value="{{ $list->id }}">
                    <button type="submit" class="btn btn-animation btn-md fw-bold me-2">Save</button>
                    <button type="button" class="btn btn-animation btn-md fw-bold me-2"  data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


    <!-- Delete Modal Box Start -->
        @foreach( $lists as $key => $list )
            <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $list->id }}" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header d-block text-center">
                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fas fa-times"></i>
                                </button>
                        </div>
                        <div class="modal-body">
                            <div class="remove-box">
                                <p>This product will be deleted.</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <form method="POST" action="{{ route('deleteproduct') }}" style="display:flex;">
                                @csrf
                                    <input type="hidden" name="id" value="{{ $list->id }}">
                                        <button type="submit"class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                                            data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="remove-box text-center">
                            <div class="wrapper">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                </svg>
                            </div>
                            <h4 class="text-content">It's Removed.</h4>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- Delete Modal Box End -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(function() {
            $('.toggle-class').change(function() {

                var status = $(this).prop('checked') ? 1 : 0;
                var shop_id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('shopstatus') }}",
                    data: {
                        'status': status,
                        'shop_id': shop_id,
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


    @foreach($lists as $item)
       <div class="modal fade theme-modal remove-profile" id="removeProfile{{ $item->id }}" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                   <div class="modal-header d-block text-center">
                       <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal">
                           <i class="fa-solid fa-xmark"></i>
                       </button>
                   </div>
                   <div class="modal-body">
                       <div class="remove-box">
                           <p>Remove this coupon from Shop.</p>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <form action="{{ route('remove_from_shop', ['id' => $item->id]) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                       </form>
                       <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                       style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                   </div>
               </div>
           </div>
       </div>
   @endforeach


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){
    // When the "Yes" button is clicked within any modal
    $(document).on('click', '.remove-coupon .btn-animation', function(){
        // Find the closest modal to the clicked button
        var modal = $(this).closest('.remove-coupon');
        // Get the selected value from the coupon-select dropdown within the modal
        var selectedValue = modal.find('.js-example-basic-single').val();

        // Update the value of the hidden input field within the modal
        modal.find('#coupon-id').val(selectedValue);
    });
});
</script>
</x-auth-layout>