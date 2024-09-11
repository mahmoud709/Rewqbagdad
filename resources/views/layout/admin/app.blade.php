<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', $SiteData->name)</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Author" content="Abdelrhman https://facebook.com/alnefelys">
    <!-- Favicon -->
    <link rel="icon" href="{{ url($SiteData->icon) }}" type="image/x-icon" />

    <!-- Icons css -->
    <link href="{{ url('/admin') }}/assets/css/icons.css" rel="stylesheet">

    <!--  Right-sidemenu css -->
    <link href="{{ url('/admin') }}/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ url('/admin') }}/assets/css-rtl/sidemenu.css">
        <link href="{{ url('/admin') }}/assets/css-rtl/style.css" rel="stylesheet">
    @else
        <link rel="stylesheet" href="{{ url('/admin') }}/assets/css/sidemenu.css">
        <link href="{{ url('/admin') }}/assets/css/style.css" rel="stylesheet">
    @endif


    @if (app()->getLocale() == 'ar')
        <link href="{{ url('/admin') }}/assets/css-rtl/custom.css" rel="stylesheet">
    @else
        <link href="{{ url('/admin') }}/assets/css/custom.css" rel="stylesheet">
    @endif
    @yield('datatable-css')
    <style>
        .dataTables_processing {
            z-index: 999999;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            margin: unset !important;
            padding: 25% 0 1em 0 !important;
            background: rgb(0 0 0 / 81%) !important;
            color: #FFF;
        }

        .tox-notifications-container {
            display: none !important;
        }

        .swal2-container {
            z-index: 999999999999999 !important;
        }
    </style>

    @yield('style')
</head>

<body class="main-body app sidebar-mini">
    {{-- Start Loader --}}
    <div id="global-loader">
        <img src="{{ url('/admin') }}/assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    {{-- End Loader --}}

    {{-- Start Page --}}
    <div class="page">
        @include('layout.admin.aside')

        {{-- Start Content --}}
        <div class="main-content app-content">
            @include('layout.admin.nav-top')

            <div class="container-fluid app-data">

                <!-- breadcrumb -->
                <nav aria-label="breadcrumb mt-5">
                    <ol class="breadcrumb mb-2" style="background-color:#FFF">
                        <li class="breadcrumb-item"><a
                                href="{{ url('/admin/home') }}">{{ __('global.dashboard') }}</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
                <!-- breadcrumb -->

                <div class="p-2 rounded mb-3" style="background-color:#FFF">
                    @include('layout.admin.alert')
                    @yield('content')
                </div>
            </div>
        </div>
        {{-- End Content --}}
    </div>
    {{-- End Page --}}

    <!-- Footer opened -->
    <div class="main-footer ht-40">
        <div class="container-fluid pd-t-0-f ht-100p">
            <span>Copyright © {{ date('Y') }}. Designed by <a target="_blank"
                    href="https://www.iraqtechno.com/">iraqtechno</a></span>
        </div>
    </div>
    <!-- Footer closed -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fa-solid fa-chevron-up"></i></a>

    <!-- JQuery min js -->
    <script src="{{ url('/admin') }}/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Bundle js -->
    <script src="{{ url('/admin') }}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Left-menu js-->
    <script src="{{ url('/admin') }}/assets/plugins/side-menu/sidemenu.js"></script>

    <!-- custom js -->
    <script src="{{ url('/admin') }}/assets/js/custom.js"></script>
    <script src="{{ url('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script>
        function getElementAfterDelay() {
            setTimeout(() => {
                $('.tox-notifications-container').css('display', 'none');
            }, 2000);
        }
        window.onload = getElementAfterDelay;
    </script>




    <script>
        $('#img1,#img2,#img3,#img4,#img5,#img6,#img7,#img8,#img9').filemanager('file');

        document.getElementById('basic-url').addEventListener('input', function() {
            this.value = this.value.toLowerCase().split(" ").join("-").replace(/[^-a-z-0-9]+/ig, '');
        });

        var timeDisplay = document.getElementById("time");

        function refreshTime() {
            var dateString = new Date().toLocaleString("en-US", {
                timeZone: "{{ config('app.timezone') }}"
            });
            var formattedString = dateString.replace(", ", " - ");
            timeDisplay.innerHTML = formattedString;
        }
        setInterval(refreshTime, 1000);
    </script>
    {{-- old tinymce  --}}
    {{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script> --}}

        {{-- new tinmce --}}
    <script src="https://cdn.tiny.cloud/1/rlfinifj5dt2guset72s6i43q74vkro3h4yw7xcqmes7u9wj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{ url('/admin/editor/config.js') }}"></script>
    @yield('datatable-js')
    @yield('script')
</body>

</html>
