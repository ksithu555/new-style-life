
<x-auth-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>

<div class="page-body">
<!-- New Product Add Start -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="log-in-box">
                    <div class="log-in-title" style="margin-bottom: 10px;">
                        <h3>Bank Information</h3>
                    </div>

                    <div class="input-box">
                        <form method="POST" action="{{ route('admin.edit_bank_account') }}" class="row g-4" id="editBankAccount">
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{ $bankAcc->id }}">
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Bank Name" value="{{ $bankAcc->bank_name }}">
                                    <label>Bank Name</label>
                                    <span class="error" style="color:red" id="error-bank_name"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" id="bank_branch" name="bank_branch" class="form-control" placeholder="Branch Name" value="{{ $bankAcc->branch_name }}">
                                    <label>Branch Name</label>
                                    <span class="error" style="color:red" id="error-bank_branch"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <select class="form-control" name="bank_acc_type">
                                        <option value="">Choose Bank Account Type</option>
                                        <option value="普通" {{ $bankAcc->account_type == '普通' ? 'selected' : '' }}>普通</option>
                                        <option value="当座" {{ $bankAcc->account_type == '当座' ? 'selected' : '' }}>当座</option>
                                        <option value="貯蓄" {{ $bankAcc->account_type == '貯蓄' ? 'selected' : '' }}>貯蓄</option>
                                    </select>
                                    <span class="error" style="color:red" id="error-bank_acc_type"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" id="bank_acc_no" name="bank_acc_no" class="form-control" placeholder="Bank Account Number" value="{{ $bankAcc->account_number }}">
                                    <label>Bank Account Number</label>
                                    <span class="error" style="color:red" id="error-bank_acc_no"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" id="bank_acc_name" name="bank_acc_name" class="form-control" placeholder="Bank Account Name" value="{{ $bankAcc->account_name }}">
                                    <label>Bank Account Name</label>
                                    <span class="error" style="color:red" id="error-bank_acc_name"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-animation theme-bg-color w-100" type="button" onclick="validateEditForm()">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Product Add End -->
    <!-- Confirm Add Address Modal Start -->
    <div class="modal fade theme-modal remove-profile" id="confirmToAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content" style="background-color: #f5f5f5;">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>This changes will be updated.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light" id="confirmYes">Yes</button>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirm Add Address Modal End -->
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    function validateEditForm() {
        let isValid = true;

        const bank_name = document.getElementById('bank_name').value.trim();
        const bank_branch = document.getElementById('bank_branch').value.trim();
        const bank_acc_type = document.querySelector('select[name="bank_acc_type"]').value;
        const bank_acc_no = document.getElementById('bank_acc_no').value.trim();
        const bank_acc_name = document.getElementById('bank_acc_name').value.trim();

        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        if (!bank_name) {
            isValid = false;
            document.getElementById('error-bank_name').textContent = 'Please provide your bank name.';
        } else if (bank_name.length > 255) {
            isValid = false;
            document.getElementById('error-bank_name').textContent = 'Your bank name must not exceed 255 characters.';
        }

        if (!bank_branch) {
            isValid = false;
            document.getElementById('error-bank_branch').textContent = 'Please provide your bank branch name.';
        } else if (bank_branch.length > 255) {
            isValid = false;
            document.getElementById('error-bank_branch').textContent = 'Your bank branch name must not exceed 255 characters.';
        }

        if (!bank_acc_type || bank_acc_type === 'Choose bank account type') {
            isValid = false;
            document.getElementById('error-bank_acc_type').textContent = 'Please select a valid bank account type.';
        }

        if (!bank_acc_no) {
            isValid = false;
            document.getElementById('error-bank_acc_no').textContent = 'Please provide your bank account number.';
        } else if (!/^\d+$/.test(bank_acc_no)) {
            isValid = false;
            document.getElementById('error-bank_acc_no').textContent = 'Please provide a valid your bank account number.';
        }

        if (!bank_acc_name) {
            isValid = false;
            document.getElementById('error-bank_acc_name').textContent = 'Please provide your bank account name.';
        } else if (bank_acc_name.length > 255) {
            isValid = false;
            document.getElementById('error-bank_acc_name').textContent = 'Your bank account name must not exceed 255 characters.';
        }

        if (isValid) {
            // document.getElementById('editBankAccount').submit();
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmToAdd'));
            confirmModal.show();
            document.getElementById('confirmYes').addEventListener('click', function() {
                document.getElementById('editBankAccount').submit();
            });
        }
    }

    document.getElementById('editBankAccount').addEventListener('submit', function(event) {
        event.preventDefault();
        validateUserForm();
    });
</script>
</x-auth-layout>