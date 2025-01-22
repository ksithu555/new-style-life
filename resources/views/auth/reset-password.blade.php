<x-guest-layout>

    @php $subtitle=__('auth.passwordreset'); @endphp

    <section class="ts-contact-form">
       <div class="container">
          <div class="row">
             <div class="col-lg-8 mx-auto">
                <h2 class="section-title text-center mb-5">
                   {{ __('auth.passwordresetting') }}
                </h2>
             </div><!-- col end-->
          </div>
          <div class="row">
             <div class="col-lg-8 mx-auto">

              @php $error = $errors->toArray(); @endphp


                <form id="contact-form" class="contact-form" method="POST" action="{{ route('password.update') }}">
                @csrf

                  <input type="hidden" name="token" value="{{ $request->route('token') }}">


                   <div class="error-container"></div>
                   <div class="row mb-3">
                      <div class="col-md-12 mx-auto">
                         <div class="form-group">
                            <label for="email"><b>{{ __('auth.mailaddress') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                            <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                               type="email" value="{{ old('email', $request->email) }}" readonly>
                              @if (!empty($error['email']))
                                  @foreach ($error['email'] as  $key => $value)
                                      <p class="error text-danger">{{ $value }}</p>
                                  @endforeach
                              @endif
                         </div>
                      </div>
                   </div>
                   <div class="row mb-3">
                      <div class="col-md-12 mx-auto">
                         <div class="form-group">
                            <label for="pwd"><b>{{ __('auth.password') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                            <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" name="password" id="password"
                               type="password"  autocomplete="new-password">
                              @if (!empty($error['password']))
                                  @foreach ($error['password'] as  $key => $value)
                                      <p class="error text-danger">{{ $value }}</p>
                                  @endforeach
                              @endif
                         </div>
                      </div>
                   </div>
                   <div class="row mb-3">
                      <div class="col-md-12 mx-auto">
                         <div class="form-group">
                            <label for="pwdagain"><b>{{ __('auth.confirmpassword') }}</b> <span class="badge badge-danger">{{ __('auth.required') }}</span></label>
                            <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" name="password_confirmation" id="password_confirmation"
                               type="password" >
                              @if (!empty($error['password_confirmation']))
                                  @foreach ($error['password_confirmation'] as  $key => $value)
                                      <p class="error text-danger">{{ $value }}</p>
                                  @endforeach
                              @endif
                         </div>
                      </div>
                   </div>
                   <div class="text-center mt-3" style="display: flex;justify-content:center">
                      <button class="btn btn-animation w-30 justify-content-center" type="submit"><i class="fa fa-user-plus" aria-hidden="true"></i>
                         {{ __('auth.dopasswordreset') }}</button>
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
