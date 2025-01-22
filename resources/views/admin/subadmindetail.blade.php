<x-auth-layout>
    <div class="page-body">
        <!-- Product Detail Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-8 m-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header-2">
                                            <h5>SubAdmin Information</h5>
                                        </div>

                                        <form class="theme-form theme-form-2 mega-form">
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Roles</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $subadmin->role }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">User Name</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $subadmin->name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Phone</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $subadmin->phone }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Email</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $subadmin->email }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Address</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $subadmin->address }}</p>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Detail End -->
    </div>
</x-auth-layout>






