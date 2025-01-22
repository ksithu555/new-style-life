
<x-auth-layout>
    <!-- bootstrap  css -->
    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <!-- All User Table Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>All Category</h5>
                                    <form class="d-inline-flex">
                                        <a href="{{ route('admin.all.addsubtitle') }}"
                                            class="align-items-center btn btn-theme d-flex">
                                            <i data-feather="plus-square"></i>Add New
                                        </a>
                                    </form>
                                </div>
                                @include('components.messagebox')
                                <div class="table-responsive category-table">
                                    <div>
                                        <table class="table all-package theme-table" id="table_id">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Date</th>
                                                    <th>Category Name</th>
                                                    <th>SubCategory Title</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach( $lists as $key => $list )
                                            <tr>
                                              <th data-label="登録日" >{{ ($ttl+1) - ($lists->firstItem() + $key) }}</th>
                                              <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                              <td data-label="タイトル">{{ $list->category }}</td>
                                              <td data-label="タイトル">{{ $list->sub_category_titlename }}</td>

                                              <td>
                                                <ul>
                                                    <li>
                                                        <a href='{{ url("/editsubtitle/".$list->id ) }}'>
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
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
                    <div style="bottom:28px">
                        <nav class="custom-pagination">
                            <ul class="pagination justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)" tabindex="-1">
                                        <i class="fa-solid fa-angles-left"></i>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0)">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        <!-- All User Table Ends-->

    </div>

</x-auth-layout>
