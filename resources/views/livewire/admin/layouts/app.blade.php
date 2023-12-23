<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png">
    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <title>{{ env('APP_NAME') }}</title>
    @livewireStyles

    <style type="text/css">
        .sorticon {
            visibility: hidden;
            color: darkgray;
        }

        .sort:hover .sorticon {
            visibility: visible;
        }

        .sort:hover {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <!--start header -->
        @include('livewire.admin.includes.header')
        <!--end header -->

        <!--navigation-->
        @include('livewire.admin.includes.navber')
        <!--end navigation-->


        {{ $slot }}

        <!--start overlay-->
        @include('livewire.admin.includes.footer')
    </div>

    <!--end wrapper-->


    @livewireScripts

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <!--app JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <!--Morris JavaScript -->
    <script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morris/js/morris.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

    {{-- <script src="{{ asset('assets/js/index2.js') }}"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>



    <script>
        let isToastActive = false;
    
        window.addEventListener('toastSuccess', event => {
            if (!isToastActive) {
                isToastActive = true;
    
                let message = event.detail;
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "onHidden": function () {
                        isToastActive = false; 
                    }
                };
                toastr.success(message);
            }
        });
    
        window.addEventListener('toastError', event => {
            if (!isToastActive) {
                isToastActive = true;
    
                let message = event.detail;
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "onHidden": function () {
                        isToastActive = false; 
                    }
                };
                toastr.error(message);
            }
        });
    </script>
    


</body>

</html>
