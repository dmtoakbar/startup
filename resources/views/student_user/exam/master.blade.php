<!DOCTYPE html>
<html lang="en">

<head>
    <title>Equa Study</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/fontawesome/css/all.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
</head>

<body>
    <!--preloader-->
    <div class="preloader-container">
        <div class="spinner-grow" style="color: blue" role="status"></div>
        <div class="spinner-grow" style="color: green" role="status"></div>
        <div class="spinner-grow" style="color: red" role="status"></div>
        <div class="spinner-grow" style="color: yellow" role="status"></div>
    </div>
    <!--end preloader-->
   
    <!-- body -->
    @yield('body')
    <!-- end body -->
    
    <script src="/assets/js/jquery-1.11.0.min.js"></script>
    <script src="/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.js"></script>
    
    @yield('script-and-files')
</body>

</html>
