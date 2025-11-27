<!DOCTYPE html>



<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="/user_assets/assets/" data-template="vertical-menu-template"
    data-style="light">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        User Dashboard
    </title>

    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Canonical SEO -->
    <link rel="canonical" href="" />



    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/images/new-logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/fonts/remixicon/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('user_assets/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('user_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('user_assets/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('user_assets/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('user_assets/assets/vendor/css/pages/cards-statistics.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('user_assets/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('user_assets/assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('user_assets/assets/js/config.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
            #template-customizer .template-customizer-open-btn{
                display: none;
            }
        </style>
</head>

<body>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <x-user.side-bar />
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <x-user.top-bar />
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    {{ $slot }}
                    <x-user.footer />

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js')}} -->
    <script src="{{ asset('user_assets/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('user_assets/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('user_assets/assets/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('user_assets/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('user_assets/assets/js/app-ecommerce-dashboard.js') }}"></script>
    @if (Session::has('success'))
        <script>
            iziToast.success({
                position: 'topRight',
                message: "{{ Session::get('success') }}"
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            iziToast.error({
                position: 'topRight',
                message: "{{ Session::get('error') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            iziToast.error({
                position: 'topRight',
                message: "Validation Error: {{ $errors->first() }}" // Displaying the first error message
            });
        </script>
    @endif
</body>

</html>

<!-- beautify ignore:end -->
