<!DOCTYPE html>
<html lang="en">
<head>
    <title>Study &#9998; Learn</title>
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
    <!--cart offcanvas cart-->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart"
        aria-labelledby="My Cart">
        <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary fw-bold">Your cart</span>
                    <span class="badge bg-primary rounded-circle pt-2">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Grey Hoodie</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Dog Food</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Soft Toy</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="fw-bold">Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                </ul>

                <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
            </div>
        </div>
    </div>
    <!-- end offcanvas cart-->
    <!-- offcanvas search on mobile screen-->
    <div class="offcanvas offcanvas-end offcanvas-center" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch"
        aria-labelledby="Search">
        <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <div class="order-md-last">
                <h4 class="text-primary fw-bold mb-3">
                    Search
                </h4>
                <div class="search-bar border rounded-2 border-dark-subtle">
                    <form id="search-form" class="text-center d-flex align-items-center" action="" method="">
                        <input type="text" class="form-control border-0 bg-transparent" placeholder="Search Here" />
                        <i class="fa fa-search fs-4 me-3"></i>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end offcanvas search on mobile screen-->
    <!--header-->
    <header class="sticky-top">
        <!-- menu bar -->
        <div class="container-fluid px-lg-4 menu-bar-border-style">
            <nav class="main-menu d-flex navbar navbar-expand-lg py-2">
                <!-- mobile menu bar icon -->
                <div class="d-flex d-lg-none align-items-end mt-1">
                    <ul class="d-flex justify-content-end list-unstyled m-0">
                        <li>
                            <div class="main-logo" style="margin-right: 10px;">
                                <img src="/image/web-logo/logo.png" alt="" height="28">
                            </div>
                        </li>
                        <li>
                            <a href="#" class="mobile-menu-icon-margin tap-bar-icon-color">
                                <i class="fa fa-user fs-10"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="mobile-menu-icon-margin tap-bar-icon-color"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                                aria-controls="offcanvasCart">
                                <i class="fa fa-cart-shopping fs-10 position-relative"></i>
                                <span class="position-absolute translate-middle badge m-badge rounded-circle bg-primary pt-2">
                                    03
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="mobile-menu-icon-margin small-screen-search-icon"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch"
                                aria-controls="offcanvasSearch">
                                <i class="fa fa-search fs-10"></i>
                                </span>
                            </a>
                        </li>
                    </ul>

                </div>
                <!-- end mobile menu bar icon -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">

                    <div class="offcanvas-header justify-content-center justify-content-between">
                       <span class="text-danger fw-bold"><?php $master_date_time = Carbon\Carbon::now();?> {{ $master_date_time->format('l, d-M-Y, h:i A')}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <!-- sort page -->
                    <div class="offcanvas-body align-items-center justify-content-between">
                        <div class="main-logo" style="margin-right: 10px;" id="lg-screeen-setup">
                            <img src="/image/web-logo/logo.png" alt="">
                        </div>
                        <!-- end sort page -->
                        <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
                            <li class="nav-item">
                                <a href="/" class="nav-link active">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" id="pages"
                                    data-bs-toggle="dropdown" aria-expanded="false">Test</a>
                                <ul class="dropdown-menu" aria-labelledby="pages">
                                    @php
                                        $test = DB::table('tests')->where('status', 'Approved')->get();
                                    @endphp
                                    @foreach ($test as $item)
                                    <li><a href="{{route('site-test-collection', $item->id)}}" class="dropdown-item d-flex justify-content-between"><span>{{$item->name}}</span> <span><i class="fa-solid fa-arrow-right" style="color: grey;"></i></span></a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Course</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Job</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contact</a>
                            </li>
                            <li class="nav-item d-none d-lg-flex">
                                <a href="#" class="nav-link text-dark big-screen-search-icon"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch"
                                    aria-controls="offcanvasSearch"><i class="fa fa-search fs-4"></i></a>
                            </li>
                        </ul>

                        <div class="d-none d-lg-flex align-items-end">
                            <ul class="d-flex justify-content-end list-unstyled m-0">
                                <li>
                                    <a href="#" class="mx-3 tap-bar-icon-color">
                                        <i class="fa fa-user fs-4"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="mx-3 tap-bar-icon-color">
                                        <i class="fa fa-heart fs-4"></i>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#" class="mx-3 tap-bar-icon-color" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                        <i class="fa fa-cart-shopping fs-4 position-relative"></i>
                                        <span
                                            class="position-absolute translate-middle badge l-badge rounded-circle bg-primary pt-2">
                                            03
                                        </span>
                                    </a>
                                </li>
                            </ul>

                        </div>

                    </div>

                </div>

            </nav>



        </div>
        <!-- end menu bar -->
    </header>
    <!--end header-->
    <!-- body -->
    @yield('body')
    <!-- end body -->

    <!-- footer -->

    <footer class="my-2">
        <div class="container-fluid px-lg-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="bottom-menu">
                        {{-- <a href=""
                            class="main-logo-text d-flex justify-content-center align-items-center">Equa&nbsp;<i
                                class="fa fa-pencil"></i>&nbsp;Study</a> --}}
                                <div class="d-flex justify-content-center">
                                    <img src="/image/web-logo/logo.png" alt="" class="">
                                </div>
                        <p class="blog-paragraph fs-6 mt-3 d-flex justify-content-center text-center">Subscribe to our
                            newsletter to get updates about our grand offers.</p>
                        <div class="social-links d-flex justify-content-center">
                            <ul class="d-flex list-unstyled gap-2">
                                <li class="social-youtube">
                                    <a href="#">
                                        <i class="fa-brands fa-youtube social-icon"></i>
                                    </a>
                                </li>
                                <li class="social-facebook">
                                    <a href="#">
                                        <i class="fa-brands fa-facebook social-icon"></i>
                                    </a>
                                </li>
                                <li class="social-instagram">
                                    <a href="#">
                                        <i class="fa-brands fa-instagram social-icon"></i>
                                    </a>
                                </li>
                                <li class="social-twitter">
                                    <a href="#">
                                        <i class="fa-brands fa-twitter social-icon"></i>
                                    </a>
                                </li>
                                <li class="social-pinterest">
                                    <a href="#">
                                        <i class="fa-brands fa-pinterest social-icon"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bottom-menu">
                        <h3 class="d-flex justify-content-center">Quick Links</h3>
                        <ul class="bottom-menu-list list-unstyled">
                            <li class="bottom-menu-item d-flex justify-content-center">
                                <a href="#" class="nav-link"><span>&#8227;&nbsp;</span>Home</a>
                            </li>
                            <li class="bottom-menu-item d-flex justify-content-center">
                                <a href="#" class="nav-link"><span>&#8227;&nbsp;</span>About us</a>
                            </li>
                            <li class="bottom-menu-item d-flex justify-content-center">
                                <a href="#" class="nav-link"><span>&#8227;&nbsp;</span>Offer </a>
                            </li>
                            <li class="bottom-menu-item d-flex justify-content-center">
                                <a href="#" class="nav-link"><span>&#8227;&nbsp;</span>Services</a>
                            </li>
                            <li class="bottom-menu-item d-flex justify-content-center">
                                <a href="#" class="nav-link"><span>&#8227;&nbsp;</span>Conatct Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- footer credit -->
    <div class="container-fluid px-lg-4 credit-border">
        <div class="row mt-2">
            <div class="col-md-6 text-xl-start text-lg-start text-md-start text-center">
                <p class="secondary-font">© {{date('Y')}}. All rights reserved</p>
            </div>
            <div class="col-md-6 text-xl-end text-lg-end text-md-end text-center">
                <p class="secondary-font"><a href="">Privacy Policy</a>&nbsp;|&nbsp;<a href="">Terms &
                        Conditions</a></p>
            </div>
        </div>
    </div>
    <!-- end footer credit -->
    <script src="/assets/js/jquery-1.11.0.min.js"></script>
    <script src="/assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/script.js"></script>

    @yield('script-and-files')
</body>

</html>
