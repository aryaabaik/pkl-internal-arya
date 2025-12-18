


    <!DOCTYPE html>

    <!-- =========================================================
    * Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
    ==============================================================

    * Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
    * Created by: ThemeSelection
    * License: You must have a valid license purchased in order to legally use the theme for your project.
    * Copyright ThemeSelection (https://themeselection.com)

    =========================================================
    -->
    <!-- beautify ignore:start -->
    <html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="assets/"
    data-template="vertical-menu-template-free"
    >
    <head>
        <meta charset="utf-8" />
        <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        />

        <title>Login Basic - Pages | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

        <meta name="description" content="" />

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{('assets/img/favicon/favicon.ico') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
        />

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{('assets/vendor/fonts/boxicons.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{('assets/css/demo.css') }}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

        <!-- Page CSS -->
        <!-- Page -->
        <link rel="stylesheet" href="{{('assets/vendor/css/pages/page-auth.css') }}" />
        <!-- Helpers -->
        <script src="{{('assets/vendor/js/helpers.js') }}"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js') }} in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{('assets/js/config.js') }}"></script>
    </head>

    <body>
        <!-- Content -->

        <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                   
                    <span class="app-brand-text demo text-body fw-bolder">Toko Peralatan Sekolah</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Silahkan Login Terlebih Dahulu</h4>

                <form  class="mb-3" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="email" class="form-label">Email or Username</label>
                    <input
                        type="text"
                        class="form-control @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        placeholder="Enter your email or username"
                        autofocus
                    />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        <a href="auth-forgot-password-basic.html">
                        <small>Forgot Password?</small>
                        </a>
                    </div>
                    <div class="input-group input-group-merge">
                        <input
                        type="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    </div>
                    <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember-me" />
                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                    </div>
                    </div>
                    <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                    </div>
                      <div class="mt-3 text-center">
              @if (Route::has('password.request'))
              <a
                class="text-decoration-none"
                href="{{ route('password.request') }}"
              >
                Lupa Password?
              </a>
              @endif
            </div>

            <hr />
            {{-- ↑ Garis pemisah --}} {{-- ================== SOCIAL LOGIN
            ================== --}} {{-- Tombol ini akan diaktifkan di Hari 4
            --}}
            <div class="d-grid gap-2">
              <a href="{{ route('auth.google') }}" class="btn btn-outline-primary">
                <img
                  src="https://www.svgrepo.com/show/475656/google-color.svg"
                  width="20"
                  class="me-2"
                />
                Login dengan Google
              </a>
            </div>

            {{-- ================== LINK REGISTER ================== --}}
            <p class="mt-4 text-center mb-0">
              Belum punya akun?
              <a
                href="{{ route('register') }}"
                class="text-decoration-none fw-bold"
              >
                Daftar Sekarang
              </a>
            </p>
                </form>
                </div>
            </div>
            <!-- /Register -->
            </div>
        </div>
        </div>

        <!-- / Content -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js') }} -->
        <script src="{{('assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{('assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{('assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

        <script src="{{('assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="{{('assets/js/main.js') }}"></script>

        <!-- Page JS -->

        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js') }}"></script>
        <style>
body {
    background: linear-gradient(to right, #e0f7fa, #ffffff);
    font-family: 'Public Sans', sans-serif;
}
.card {
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}
.form-control:focus {
    border-color: #1E88E5;
    box-shadow: 0 0 0 0.2rem rgba(30, 136, 229, 0.25);
}
.btn-primary {
    background-color: #1E88E5;
    border: none;
}
.btn-primary:hover {
    background-color: #1565C0;
}
.app-brand-text {
    color: #1E88E5 !important;
    font-weight: 700;
}
.card-body h4 {
    color: #1565C0;
}
.card-body p {
    color: #555;
}
</style>

    </body>
    </html>
