<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

<style>
    a{
         text-decoration: none !important;
    }
</style>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <button type="button" class="close">×</button>
    Please check the form below for errors
</div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.alert .close').click(function() {
            $(this).closest('.alert').hide();
        });
    });
</script>