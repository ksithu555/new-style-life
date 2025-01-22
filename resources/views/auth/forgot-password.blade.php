<x-guest-layout>
   @php $subtitle=__('auth.passwordreset'); @endphp


   <section class="ts-contact-form">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 mx-auto">
               <h2 class="section-title text-center mb-5">
                  {{ __('auth.passwordreset') }}
               </h2>
            </div><!-- col end-->
         </div>
         <div class="row">
            <div class="col-lg-8 mx-auto">


             <!-- Session Status -->
              @if ($message = Session::get('success'))
              @include('components.messagebox')
              @endif

              @php $error = $errors->toArray(); @endphp

               <form id="contact-form" class="contact-form" method="POST" action="{{ route('password.email') }}">
                  @csrf

                  <div class="error-container"></div>
                  <div class="row">
                     <div class="col-md-8 mx-auto">
                        <div class="form-group">
                           <label for="email"><b>{{ __('auth.mailaddress') }}</b></label>
                           <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                              type="text" :value="old('email')" autofocus >
                             @if (!empty($error['email']))
                                 @foreach ($error['email'] as  $key => $value)
                                     <p class="email error text-danger">{{ $value }}</p>
                                 @endforeach
                             @endif
                        </div>
                     </div>
                  </div>
                  <div class="text-center mt-3" style="justify-content: center;display: flex;">
                     <button class="btn btn-animation w-20 justify-content-center" type="submit">{{ __('auth.dorequest') }}</button>
                  </div>
               </form><!-- Contact form end -->
            </div>
         </div>
      </div>
      <div class="speaker-shap">
         <img class="shap1" src="{{ asset('images/shap/home_schedule_memphis2.png') }}" alt="">
      </div>
     </section>
</x-guest-layout>