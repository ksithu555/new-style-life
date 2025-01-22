@extends('sub_seller.subseller_dashboard')
@section('sub_seller')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title d-sm-flex d-block">
                            <h5>Products List</h5>
                            <div class="right-options">
                                <ul>
                                    <li>
                                        <a class="btn btn-solid" href="{{ route('sub_seller.add.product') }}">Add Product</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package theme-table table-product" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Product Image</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Current Qty</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>10</td>
                                            <td>2022-12-26 12:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/1.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Aata Buscuit</td>

                                            <td>Buscuit</td>

                                            <td>12</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-danger">
                                                <span>Pending</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('seller.detail.product') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('seller.edit.product') }}">
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

                                        <tr>
                                            <td>9</td>
                                            <td>2022-12-25 10:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/2.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Cold Brew Coffee</td>

                                            <td>Drinks</td>

                                            <td>10</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>8</td>
                                            <td>2022-12-25 12:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/3.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Peanut Butter Cookies</td>

                                            <td>Cookies</td>

                                            <td>9</td>

                                            <td class="td-price">$86.35</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>7</td>
                                            <td>2022-12-24 23:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/4.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Wheet Flakes</td>

                                            <td>Flakes</td>

                                            <td>8</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-danger">
                                                <span>Pending</span>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>6</td>
                                            <td>2022-12-22 12:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/5.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Potato Chips</td>

                                            <td>Chips</td>

                                            <td>23</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>5</td>
                                            <td>2022-12-23 11:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/6.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Tuwer Dal</td>

                                            <td>Dals</td>

                                            <td>50</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>4</td>
                                            <td>2022-12-22 12:20</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/7.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Almond Milk</td>

                                            <td>Milk</td>

                                            <td>25</td>

                                            <td class="td-price">$121.43</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>3</td>
                                            <td>2022-12-20 12:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/11.png"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </td>

                                            <td>Wheat Bread</td>

                                            <td>Breads</td>

                                            <td>6</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-danger">
                                                <span>Pending</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>2</td>
                                            <td>2022-12-20 10:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/8.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Dog Food</td>

                                            <td>Pet Food</td>

                                            <td>11</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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

                                        <tr>
                                            <td>1</td>
                                            <td>2022-12-20 05:24</td>
                                            <td>
                                                <div class="table-image">
                                                    <img src="assets/images/product/9.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </td>

                                            <td>Fresh Meat</td>

                                            <td>Meats</td>

                                            <td>18</td>

                                            <td class="td-price">$95.97</td>

                                            <td class="status-close">
                                                <span>Approved</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)">
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
                                <i class="ri-arrow-left-s-line"></i>
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
                                <i class="ri-arrow-right-s-line"></i>
                             </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

<!-- Delete Modal Box Start -->
 <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="remove-box">
                    <p>The permission for the use/group, preview is inherited from the object, object will create a
                        new permission for this object</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-target="#exampleModalToggle2"
                    data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>

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
@endsection
