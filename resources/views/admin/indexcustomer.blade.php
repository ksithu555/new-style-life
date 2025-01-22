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
                                <h5>All Customer</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 50px">No</th>
                                                <th style="min-width: 50px">Image</th>
                                                <th>Title</th>
                                                <th style="min-width: 200px">Sub Title</th>
                                                <th style="min-width: 300px">Content</th>
                                                <th style="min-width: 200px">Name</th>
                                                <th style="min-width: 200px">Position</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach( $lists as $key => $list )

                                            <tr>
                                              <td style="text-align:center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                                              <td data-label="{{ __('auth.image') }}"><img src="{{ asset('images/'.($list->image)   ) }}" alt="thumb" style="width: 50px;"></td>
                                              <td data-label="タイトル">{{ $list->title }}</td>
                                              <td data-label="タイトル">{{ $list->subtitle }}</td>
                                              <td data-label="タイトル"> {!! strlen($list->content) > 50 ? substr($list->content, 0, 50) . '...' : $list->content !!}</td>
                                              <td data-label="タイトル">{{ $list->name }}</td>
                                              <td data-label="タイトル">{{ $list->position }}</td>

                                              <td>
                                                <ul>
                                                    <li>
                                                        <a href='{{ url("/editcustomer/".$list->id ) }}'>
                                                            <i class="ri-pencil-line"></i>
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

</x-auth-layout>
