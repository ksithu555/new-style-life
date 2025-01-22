@extends('sub_seller.subseller_dashboard')
@section('sub_seller')
<!-- Container-fluid starts-->
<div class="page-body">
    <!-- All User Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Get in Touch</h5>
                            <form class="d-inline-flex">
                                <a href="{{ route('sub_seller.help.add') }}" class="align-items-center btn btn-theme d-flex">
                                    <i data-feather="plus-square"></i>Contact
                                </a>
                            </form>
                        </div>

                        <div class="table-responsive category-table">
                            <table class="table all-package theme-table" id="table_id">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>3</td>
                                        <td>2024/02/29</td>
                                        <td>Error</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="ri-eye-line"></i>
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

                                    <tr>
                                        <td>2</td>
                                        <td>2024/01/20</td>
                                        <td>Message</td>
                                        <td>officiis nesciunt qui nostrum quod voluptatem corrupti.<br>amet consectetur adipisicing elit</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="ri-eye-line"></i>
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

                                    <tr>
                                        <td>1</td>
                                        <td>2024/02/29</td>
                                        <td>Error</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <i class="ri-eye-line"></i>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All User Table Ends-->
<!-- Container-fluid end -->
@endsection
