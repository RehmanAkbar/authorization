<!DOCTYPE html>
<!-- Template Name: Clip-Two - Responsive Admin Template build with Twitter Bootstrap 3.x | Author: ClipTheme -->
<!--[if IE 8]><html class="ie8" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- start: HEAD -->
<!-- start: HEAD -->
<head>
    <title>@yield('title')</title>
    <!-- start: META -->
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- end: META -->
    <!-- start: GOOGLE FONTS -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <!-- end: GOOGLE FONTS -->
    <!-- start: MAIN CSS -->

    <link rel="stylesheet" href="{{asset('')}}css/all.css">

    <link rel="stylesheet" href="{{asset('')}}assets/css/themes/theme-1.css" id="skin_color" />
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body class="login">
<!-- start: LOGIN -->
<div class="row">

    @yield('content')

</div>
<!-- end: LOGIN -->
<!-- start: MAIN JAVASCRIPTS -->
<script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
<script src="{{asset('')}}vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('')}}vendor/modernizr/modernizr.js"></script>
<script src="{{asset('')}}vendor/jquery-cookie/jquery.cookie.js"></script>
<script src="{{asset('')}}vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('')}}vendor/switchery/switchery.min.js"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="{{asset('')}}vendor/jquery-validation/jquery.validate.min.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<!-- start: CLIP-TWO JAVASCRIPTS -->
<script src="assets/js/main.js"></script>
<!-- start: JavaScript Event Handlers for this page -->
<script src="{{asset('')}}assets/js/login.js"></script>

<script>
    var JS_BASE_URL = "{{url('/')}}";
    jQuery(document).ready(function() {
        Main.init();
        Login.init();
    });
</script>
<!-- end: JavaScript Event Handlers for this page -->
<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>
<!-- end: BODY -->
</html>