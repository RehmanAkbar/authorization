<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<!-- start: HEAD -->
<head>

    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    @yield('css')
            <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

    <script>
        var JS_BASE_URL = "{{url('/')}}";

    </script>
</head>
<!-- end: HEAD -->
<body>
<div id="app">

    <div class="app-content">
        <div class="main-content" >
            <div class="wrap-content container" id="container">
             

                <!-- start: YOUR CONTENT HERE -->

                  @yield('content')

                <!-- end: YOUR CONTENT HERE -->

            </div>
        </div>
    </div>

</div>
</body>
</html>
