<x-auth-layout>
<!-- Settings Section Start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Details Start -->
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Profile</h5>
                                </div>
                                <form method="post" action="#" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Username</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="username" value="" required >
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name" value="" required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" name="email" value="" required>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" name="password" value=""  id="password" required>
                                            </div>
                                        </div>

                                        <div class="mb-1 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" id="confirm_password" required>
                                                <span id="confirm-password-error" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="form-label-title col-sm-2 mb-0">Photo</label>
                                            <div class="col-sm-10">
                                                <input class="form-control form-choose" type="file" id="image" name="photo">
                                                {{-- <img src="#" alt="profile" width="100" id="showImage"> --}}
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Phone
                                                Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" name="phone" value="">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Address</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="address" value="">
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-animation" type="submit">Update</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Settings Section End -->

    <script>
        let password = document.getElementById("password");
        let confirm_password = document.getElementById("confirm_password");
        let passwordError = document.getElementById("password-error");
        let confirmPasswordError = document.getElementById("confirm-password-error");
        function validatePassword() {
            if (password.value !== confirm_password.value) {
                confirmPasswordError.textContent = "Passwords Don't Match";
            } else {
                confirmPasswordError.textContent = "";
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        document.addEventListener("DOMContentLoaded", function() {
            $('#image').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
    </script>

</x-auth-layout>
