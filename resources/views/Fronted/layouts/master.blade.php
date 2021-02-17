<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="/Fronted/images/favicon/1.png" type="image/x-icon">
    <link rel="shortcut icon" href="/Fronted/images/favicon/1.png" type="image/x-icon">
    <title>@yield('title')</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="/Fronted/css/fontawesome.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="/Fronted/css/slick.css">
    <link rel="stylesheet" type="text/css" href="/Fronted/css/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="/Fronted/css/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="/Fronted/css/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/Fronted/css/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="/Fronted/css/color1.css" media="screen" id="color">


</head>

<body>
@include('Fronted.layouts.load')

@include('Fronted.layouts.header')

@yield('content')
<!-- tap to top -->
<div class="tap-top top-cls">
    <div>
        <i class="fa fa-angle-double-up"></i>
    </div>
</div>
<!-- tap to top end -->


<!-- latest jquery-->
<script src="/Fronted/js/jquery-3.3.1.min.js"></script>

<!-- fly cart ui jquery-->
<script src="/Fronted/js/jquery-ui.min.js"></script>

<!-- exitintent jquery-->
<script src="/Fronted/js/jquery.exitintent.js"></script>
<script src="/Fronted/js/exit.js"></script>

<!-- popper js-->
<script src="/Fronted/js/popper.min.js"></script>

<!-- slick js-->
<script src="/Fronted/js/slick.js"></script>

<!-- menu js-->
<script src="/Fronted/js/menu.js"></script>

<!-- lazyload js-->
<script src="/Fronted/js/lazysizes.min.js"></script>

<!-- Bootstrap js-->
<script src="/Fronted/js/bootstrap.js"></script>

<!-- Bootstrap Notification js-->
<script src="/Fronted/js/bootstrap-notify.min.js"></script>

<!-- Fly cart js-->
<script src="/Fronted/js/fly-cart.js"></script>

<!-- Theme js-->
<script src="/Fronted/js/script.js"></script>

<script>
    $(window).on('load', function () {
        setTimeout(function () {
            $('#exampleModal').modal('show');
        }, 2500);
    });
    function openSearch() {
        document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("search-overlay").style.display = "none";
    }
</script>

</body>

</html>
