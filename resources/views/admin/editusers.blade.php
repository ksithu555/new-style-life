<x-auth-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

        <div class="page-body">
            <!-- New Product Add Start -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-8 m-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">

                                                @php
                                                  if($editmode) {
                                                    if (!$editother) {
                                                      $subtitle="Edit User Information";
                                                    }
                                                  } else {
                                                    $subtitle="Register SubAdmin";
                                                  }
                                                @endphp

                                                @include('components.subtitle')

                                            </div>
                                                @if (!$editmode)
                                                    @php $action= route('registersubadmin'); @endphp
                                                @else
                                                    @php $action= route('edituser') ; @endphp
                                                @endif

                                                <form id="registeradminform" lass="theme-form theme-form-2 mega-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                                @csrf

                                                    @if ($message = Session::get('success'))
                                                        <div class="alert alert-success alert-block" id="alert-success">
                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                            <strong>{{ $message }}</strong>
                                                        </div>
                                                    @endif

                                                <!-- Validation Errors -->

                                                @php $error = $errors->toArray(); @endphp
                                                    @if(!empty($error))
                                                        {{ json_decode($error) }}
                                                    @endif

                                                    @if ($editmode)
                                                        <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                                                    @endif

                                                    <div class="error-container"></div>

                         <div class="mb-4 row align-items-center">

                                <div class="col-sm-9">
                                    <input class="form-control form-control-email" placeholder="name" name="name" id="name"
                                        type="text" value="{{ old('name') ?? $edituser['name'] ?? '' }}" >
                                        <p style="display:none" class="name error text-danger"></p>

                                </div>
                        </div>

                         <div class="row ">
                            <div class="col-md-12 mx-auto">
                               <div class="form-group">
                                  <label for="picture"><b>プロフィール写真</b> <span class="badge badge-secondary">任意</span></label>
                                  <input type="file" name="image" id="image" class="form-control" >
                                  <img id="preview-image-before-upload" alt="プロフィール写真"
                                    @if(!empty($edituser['profileimg']))
                                          style="max-height: 200px;"
                                          src="{{ asset('images/avatar/'.$edituser['profileimg'] ) }}"
                                    @else
                                          style="max-height: 200px; display: none;"
                                    @endif
                                  />
                                    <p style="display:none" class="image error text-danger"></p>
                               </div>
                            </div>
                         </div>

                         <div class="row ">
                            <div class="col-md-12 mx-auto">
                               <div class="form-group">
                                  <label for="phonenumber"><b>電話番号</b> <span class="badge badge-danger">必須</span></label>
                                  <input class="form-control form-control-password" placeholder="電話番号" name="phone" id="phone"
                                     type="text" value="{{ old('phone') ?? $edituser['phone'] ?? '' }}">
                                    <p style="display:none" class="phone error text-danger"></p>
                               </div>
                            </div>
                         </div>

                         <div class="row">
                            <div class="col-md-12 mx-auto">
                               <div class="form-group">
                                  <label for="email"><b>メールアドレス</b> <span class="badge badge-danger">必須</span></label>
                                  <input class="form-control form-control-email" placeholder="メールアドレス" name="email" id="email"
                                     type="email" value="{{ old('email') ?? $edituser['email'] ?? '' }}" >
                                    <p style="display:none" class="email error text-danger"></p>
                               </div>
                            </div>
                         </div>
                         <div class="row ">
                            <div class="col-md-12 mx-auto">
                               <div class="form-group">
                                  <label for="pwd"><b>パスワード</b> <span class="badge badge-danger">必須</span></label>
                                  <input class="form-control form-control-password" placeholder="パスワード" name="password" id="password"
                                     type="password"  autocomplete="new-password" value="{{ $edituser['password'] ?? '' }}">
                                    <p style="display:none" class="password error text-danger"></p>
                               </div>
                            </div>
                         </div>
                         <div class="row ">
                            <div class="col-md-12 mx-auto">
                               <div class="form-group">
                                  <label for="pwdagain"><b>再確認のパスワード</b> <span class="badge badge-danger">必須</span></label>
                                  <input class="form-control form-control-password" placeholder="再確認のパスワード" name="password_confirmation" id="password_confirmation"
                                     type="password" value="{{ $edituser['password'] ?? '' }}">
                                    <p style="display:none" class="password_confirmation  error text-danger"></p>
                               </div>
                            </div>
                         </div>

                         <div class="row ">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label for="gender_select"><b>性別</b> <span class="badge badge-danger">必須</span></label>
                                  <select class="form-control" name="gender" id="gender"
                                        style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    @foreach (config('global.gender') as $key => $value)
                                      <option value="{{$key}}" {{ old('gender') == $key ? "selected" : "" }} @if(!empty($edituser['gender']) && ($edituser['gender'] == $key)) selected @endif >{{__($value)}}</option>
                                    @endforeach
                                  </select>
                                  <p style="display:none" class="gender error text-danger"></p>
                               </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label for="end"><b>年齢代</b></label> <span class="badge badge-danger">必須</span></label>
                                  <select class="form-control" name="agerange" id="agerange"
                                        style="padding-top: 10px;padding-bottom: 10px;height: 48px;">
                                    @foreach (config('global.agerange') as $key => $value)
                                      <option value="{{$key}}" {{ old('agerange') == $key ? "selected" : "" }} @if(!empty($edituser['agerange']) && ($edituser['agerange'] == $key)) selected @endif >{{__($value)}}</option>
                                    @endforeach
                                  </select>
                                  <p style="display:none" class="agerange error text-danger"></p>
                               </div>
                            </div>
                         </div>

                         <div class="text-center">
                            <button class="btn btn-submit mb-5" type="submit">
                          @if (!$editmode)
                              <i class="fa fa-user-plus" aria-hidden="true"></i>
                               登録する
                          @else
                              <i class="fa fa-edit" aria-hidden="true"></i>
                               情報を修正する
                          @endif
                            </button>
                         </div>

                   </div>
                </div>
             </div>

             <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                      <h4 class="modal-title" id="deleteConfirmModalLabel">
                          　@if (!$editmode)
                            登録しますか？
                          　@else
                            基本情報を修正
                          　@endif
                  　　</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                   </div>
              <!--      <div class="modal-body">
                      <p>選択したセミナーを削除してはよろしいですか。</p>
                   </div> -->
                   <div class="modal-footer">

                      <button type="submit" class="btn btn-primary">
                          　@if (!$editmode)
                            登録する
                          　@else
                            修正する
                          　@endif
                      </button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>

                   </div>
                </div>
                </div>
             </div>
            </form><!-- Contact form end -->

        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- New Product Add End -->
</div>

    <script type="text/javascript">

        $(document).ready(function() {

            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                  $('#preview-image-before-upload').attr('src', e.target.result);
                  $('#preview-image-before-upload').show();
                }
                reader.readAsDataURL(this.files[0]);
            });


            var pwdchnge = false;
            $("#password,#password_confirmation").on("input", function(){
                pwdchnge = true;
            });

            $("#registeradminform").submit(function() {
                // alert(pwdchnge);
                if (!pwdchnge) {
                // alert('remove');
                    $('#password').remove();
                    $('#password_confirmation').remove();
                }
            });

            $(".btn-submit").click(function(e){

                e.preventDefault();
                var _token = $("input[name='_token']").val();
                let formData = new FormData(registeradminform);

                $.ajax({
                    url: "{{ $action }}",
                    type:'POST',

                    data: formData,

                     contentType: false,
                     processData: false,

                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            // alert("success");
                            console.log(data.success);
                              $('.error').hide()
                            $('#detailModal').modal('show');
                        }else{
                            // alert("err");
                            console.log(data.error);
                              $('.error').hide()
                            $.each( data.error, function( key, value ) {
                              if (key == 'password') {
                                $.each( value, function( k, val ) {
                                  if (val == 'パスワードが一致しません') {
                                    $('.error.password_confirmation').text(val)
                                    $('.error.password_confirmation').show()
                                    // alert('unset')
                                  } else {
                                    $('.error.'+key).text(val)
                                    $('.error.'+key).show()
                                  }
                                });
                              } else {

                                $('.error.'+key).text(value[0])
                                $('.error.'+key).show()
                              }
                            });
                        }
                    },
                    fail: function(data) {
                            alert("エラー：ajax error");
                    }
                });

            });

        });


    </script>


    </x-auth-layout>
