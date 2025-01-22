<x-guest-layout>

    <section class="ts-contact-form">
       <div class="container">
          <div class="row">
             <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center mb-5">
                   {{ __('auth.mailverification') }}
                </h2>
             </div><!-- col end-->
          </div>

      <div class="mb-4 text-sm text-gray-600" style="margin-left:200px">
          {{ __('auth.thankforregister') }}
          <br>{{ __('auth.alreadysendemail') }}
          <br>{{ __('auth.pleaseclicklink') }}
          <br>{{ __('auth.ifyouneedresend') }}
      </div>

          @if (!empty($msg))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $msg }}</strong>
          </div>
          @endif

          <div class="row mb-3">
             <div class="col-lg-8 mx-auto">
                   <div class="text-center">
                      <form method="POST" action="{{ route('verification.send') }}">
                      @csrf
                          <input type="hidden" name="email" value="{{ $email ?? ''}}">
                          <button class="btn btn-animation theme-bg-color mx-auto" type="submit"><i class="fa fa-sign-in" aria-hidden="true"></i> {{ __('auth.doresend') }}
                          </button>
                      </form>

                   </div>
             </div>
          </div>
       </div>

      </section>
</x-guest-layout>


