@extends('sub_seller.subseller_dashboard')
@section('sub_seller')
<!-- Order section Start -->
<div class="page-body">
    <!-- Table Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Order List</h5>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package order-table theme-table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Order Image</th>
                                            <th>Order Code</th>
                                            <th>Date</th>
                                            <th>Payment Method</th>
                                            <th>Delivery Status</th>
                                            <th>Amount</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>10</td>
                                            <td>2022-12-26 12:24</td>
                                            <td>
                                                <a class="d-block">
                                                    <span class="order-image">
                                                        <img src="assets/images/product/1.png"
                                                            class="img-fluid" alt="users">
                                                    </span>
                                                </a>
                                            </td>
                                            <td> 406-4883635</td>
                                            <td>Paypal</td>
                                            <td class="order-success">
                                                <span>Success</span>
                                            </td>
                                            <td>￥15</td>
                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('seller.detail.order') }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#order-details">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="{{ route('seller.order-tracking') }}">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>9</td>
                                            <td>2022-12-26 11:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/2.png" alt="users">
                                                </span>
                                            </td>
                                            <td> 573-685572</td>
                                            <td>Paypal</td>
                                            <td class="order-success">
                                                <span>Success</span>
                                            </td>
                                            <td>￥15</td>
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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>8</td>
                                            <td>2022-12-26 10:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/3.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 759-4568734</td>

                                            <td>Stripe</td>

                                            <td class="order-pending">
                                                <span>Pending</span>
                                            </td>

                                            <td>￥15</td>

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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>7</td>
                                            <td>2022-12-5 11:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/4.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 546-7664537</td>

                                            <td>Paypal</td>

                                            <td class="order-success">
                                                <span>Success</span>
                                            </td>

                                            <td>￥15</td>

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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>6</td>
                                            <td>2022-12-25 10:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/5.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 479-7533144</td>

                                            <td>Stripe</td>

                                            <td class="order-success">
                                                <span>Success</span>
                                            </td>

                                            <td>￥15</td>

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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>5</td>
                                            <td>2022-12-24 12:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/6.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 456-1245789</td>

                                            <td>Stripe</td>

                                            <td class="order-cancle">
                                                <span>Cancel</span>
                                            </td>

                                            <td>￥15</td>

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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>4</td>
                                            <td>2022-12-24 12:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/7.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 057-3657895</td>

                                            <td>Paypal</td>

                                            <td class="order-cancle">
                                                <span>Cancel</span>
                                            </td>

                                            <td>￥15</td>

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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>3</td>
                                            <td>2022-12-24 16:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/8.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 123-1234567</td>

                                            <td>Paypla</td>

                                            <td class="order-success">
                                                <span>Success</span>
                                            </td>

                                            <td>￥15</td>

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
                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr data-bs-toggle="offcanvas" href="#order-details">
                                            <td>2</td>
                                            <td>2022-12-26 12:24</td>
                                            <td>
                                                <span class="order-image">
                                                    <img src="assets/images/product/9.png" alt="users">
                                                </span>
                                            </td>

                                            <td> 987-9876543</td>

                                            <td>Paypal</td>

                                            <td class="order-success">
                                                <span>Success</span>
                                            </td>

                                            <td>￥15</td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="order-detail.html">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalToggle">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalToggle">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" >
                                                            <i class="icon-cloud-down"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="btn btn-sm btn-solid text-white"
                                                            href="order-tracking.html">
                                                            Tracking
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
    <!-- Table End -->
<!-- Order section End -->

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

<!-- Offcanvas Box Start -->
    <div class="offcanvas offcanvas-end order-offcanvas" tabindex="-1" id="order-details"
        aria-labelledby="offcanvasExampleLabel" aria-hidden="false">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasExampleLabel">#573-685572</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <div class="order-date">
                <h6>September 17, 2022 <span class="ms-3">8:12 PM</span></h6>
                <a href="javascript:void(0)" class="d-block mt-1">Cancel Order</a>
            </div>

            <div class="accordion accordion-flush custome-accordion" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Status
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <ul class="status-list">
                                <li>
                                    <a href="javascript:void(0)">Shipped</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">Pending</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion
                            body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                            aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to
                            demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion
                            body. Nothing more exciting happening here in terms of content, but just filling up the
                            space to make it look, at least at first glance, a bit more representative of how this would
                            look in a real-world application.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Offcanvas Box End -->
@endsection
