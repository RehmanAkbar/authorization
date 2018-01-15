<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
   @include('layouts.partials.head-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    @yield('css')
<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <style>
        #sidebar nav > ul .sub-menu > li.active-item a
        {
            background-color: #acadacc7 !important;
        }
        .company_name h2{
            font-size: 20px;
            padding-top: 10px;
        }
    </style>
    <script>
        var JS_BASE_URL = "{{url('/')}}";
        function ajx(url, type, data, successCallback, dataType) {
            if (dataType == '' || dataType == undefined)
                dataType = 'json';
            $.ajax({
                url: url,
                type: type,
                data: data,
                processData: false,
                contentType: false,
                dataType: dataType,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
                .done(successCallback)
                .fail(function (res) {
                    //(res);
                });
        }
    </script>

</head>
<!-- end: HEAD -->
<body>
<div id="app">
    <!-- sidebar -->
    @if(auth()->check())
        @include('layouts.partials.sidebar')
    @endif
    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
            <header class="navbar navbar-default navbar-static-top">
                @include('layouts.partials.header-content')
            </header>
        <!-- end: TOP NAVBAR -->
        <div class="main-content" >
            <div class="wrap-content container" id="container">

                @include('flash::message')

                <!-- start: YOUR CONTENT HERE -->

                    @yield('content')

                <!-- end: YOUR CONTENT HERE -->

            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <footer>
        @include('layouts.partials.footer-content')
    </footer>
    <!-- end: FOOTER -->
    <!-- start: OFF-SIDEBAR -->
        @include('layouts.partials.off-sidebar')
    <!-- end: OFF-SIDEBAR -->
    <!-- start: SETTINGS -->

    {{--   @include('layouts.partials.settings') --}}

    <!-- end: SETTINGS -->
</div>

    <script src="{{asset('')}}js/all.js" ></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery(document).ready(function() {
        Main.init();
        UITreeview.init();
        FormElements.init();

    });
    $(document).ready(function() {
        //activate parent navigation items
        var activeItem = $('li[data-route="{{ explode('.',request()->route()->getName())[0] }}"]');
        activeItem.parents('li[data-is_parent="1"]').addClass('active open');
    });
    $(document).ready(function(e){
        $(".dropdown-menu").on('click','a',function(){
            $(".selected-page").text($(this).text());
            e.stopPropagation();
        });
    });
    
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);


</script>
<script>
    //This script will found any missing image and will place it with a missing image.
    $('img').on('error',function(){
        $(this).attr('src', '{{ url('images/default.jpg') }}');
    });
</script>
<!-- end: JavaScript Event Handlers for this page -->
<!-- end: CLIP-TWO JAVASCRIPTS -->

    @yield('page-plugins')
    @yield('page-scripts')

</body>
</html>
