<!DOCTYPE html>

<!-- beautify ignore:start -->
<html
  lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Lara HR</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('admin-backend/assets/img/favicon/favicon.ico') }}" />

    {{-- custom css --}}
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('admin-backend/assets/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ URL::asset('admin-backend/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ URL::asset('admin-backend/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="d-flex justify-content-center">
                <img class="img-fluid" src="{{URL::asset('admin-backend/assets/img/icons') }}/{{ getSiteSetting() !== null ? getSiteSetting()->logo : ''  }}" alt="" style="width:130px;height:130px;">
            </div>
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <h4 class="mb-2">Welcome to {{ getSiteSetting() !== null ? getSiteSetting()->name : '' }} 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>
              <form id="formAuthentic ation" class="mb-3 needs-validation" action="{{ route('postLogin') }}" method="POST" novalidate>
                @csrf
                <div class="mb-3 has-validation">
                  <label for="email" class="form-label" required>Email or Username</label>
                  <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Enter your email or username" autofocus required />
                  <div class="invalid-feedback">
                    @if ($errors->has('email'))
                    <p style="color:red">Invalid email</p>
                    @endif
                    Invalid email
                  </div>
                </div>

                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input type="password" id="password"  class="form-control" name="password" placeholder="password" aria-describedby="password" required />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    <div class="invalid-feedback">
                      @if($errors->has('password'))
                      <p style="color:red">Invalid password</p>
                      @endif
                        Please write a password
                    </div>
                  </div>
                </div>

                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" value="1" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>

                <div class="mb-3">
                  <input class="btn btn-primary d-grid w-100" type="submit">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ URL::asset('admin-backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ URL::asset('admin-backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ URL::asset('admin-backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('admin-backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('admin-backend/assets/vendor/js/menu.js') }}"></script>
    <script src="{{ URL::asset('admin-backend/assets/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ URL::asset('admin-backend/js/sweetalert2@11.js') }}"></script>
    @if ($errors->has('loginErrors'))
      <script>
        Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Wrong Email or Password!",
        footer: '<a href="#">Do not remember password?</a>'
        });
      </script>
    @endif
    <script>
        (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
  </body>
</html>
