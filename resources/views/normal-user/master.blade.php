<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/logo.png">
    <title>@yield('title')</title>
    <meta name="description" content="Vogel - Social Network & Community HTML Template">
    <meta name="keywords" content="bootstrap5, e-learning, forum, games, online course, Social Community, social events, social feed, social media, social media template, social network html, social sharing, twitter">
    <!-- Bootstrap CSS -->
    <link href="{{asset('/')}}normal-user-assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Slich Slider -->
    <link href="{{asset('/')}}normal-user-assets/assets/vendor/slick/slick/slick.css" rel="stylesheet">
    <link href="{{asset('/')}}normal-user-assets/assets/vendor/slick/slick/slick-theme.css" rel="stylesheet">
    <!-- Icofont -->
    <link href="{{asset('/')}}normal-user-assets/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
    <!-- Font Icons -->
    <link href="{{asset('/')}}normal-user-assets/assets/vendor/icons/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Css -->
    <link href="{{asset('/')}}normal-user-assets/assets/css/style.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="{{asset('/')}}normal-user-assets/assets/fonts.googleapis.com/icone91f.css?family=Material+Icons" rel="stylesheet">




</head>
<body class="bg-light">
{{--<div class="theme-switch-wrapper ms-3">--}}
{{--    <label class="theme-switch" for="checkbox">--}}
{{--        <input type="checkbox" id="checkbox">--}}
{{--        <span class="slider round"></span>--}}
{{--        <i class="icofont-ui-brightness"></i>--}}
{{--    </label>--}}
{{--    <em>Enable Dark Mode!</em>--}}
{{--</div>--}}


<!-- Top Navbar -->
{{--<div class="web-none d-flex align-items-center px-3 pt-3">--}}
{{--    <a href="index.html" class="text-decoration-none">--}}
{{--        <a href="{{route('normal-user.dashboard')}}" class="nav-link"><span class="material-icons me-3">house</span> <span>Feed</span></a>--}}
{{--        <a href="profile.html" class="nav-link active"><span class="material-icons me-3">account_circle</span> <span>Profile</span></a>--}}
{{--        <a href="{{route('normal-user.admission.index')}}" class="nav-link"><span class="material-icons me-3">explore</span> <span>Admission</span></a>--}}
{{--        <a href="{{route('normal-user.research-project.index')}}" class="nav-link"><span class="material-icons me-3">explore</span> <span>Research Collaboration</span></a>--}}
{{--        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#notification"><span class="material-icons me-3">translate</span> <span>Notification</span></a>--}}
{{--    </a>--}}
{{--    <button class="ms-auto btn btn-primary ln-0" type="button" onclick="goBack()">--}}
{{--        <span class="material-icons me-2">arrow_back</span>--}}
{{--    </button>--}}
{{--</div>--}}

{{--<script>--}}
{{--    function goBack() {--}}
{{--        window.history.back();--}}
{{--    }--}}
{{--</script>--}}
<div class="web-none full-navb d-flex align-items-center px-3 pt-3 shadow-sm bg-white">
    <!-- Navigation Links -->
    <nav class="d-flex gap-4">
        <a href="{{route('normal-user.dashboard')}}" class="nav-linkr d-flex align-items-center text-dark">
            <img src="{{asset('/')}}normal-user-assets/research-project-assets/images/studyXchange.png" height="90" alt="">
        </a>
        <a href="{{route('normal-user.dashboard')}}" class="rct navex nav-linkr d-flex align-items-center text-dark">
            <span class="rcts material-icons me-3">house</span> <span>Feed</span>
        </a>
        <a href="{{ url('/chatify') }}" class="rct navex nav-linkr d-flex align-items-center text-dark">
            <span class="rcts material-icons me-3">chat</span> <span>Messages</span>
        </a>
        <a href="#" class="rct navex nav-linkr d-flex align-items-center text-dark" data-bs-toggle="modal" data-bs-target="#notification">
            <span class="rcts material-icons me-3">notifications</span> <span>Notification</span>
        </a>
        <a href="{{route('normal-user.research-project.index')}}" class="rct navex nav-linkr d-flex align-items-center text-dark">
            <span class="rcts material-icons me-3">science</span> <span>Research Collaboration</span>
        </a>
    </nav>


    <!-- Go Back Button -->
    <button class="btns ms-auto btn btn-primary d-flex align-items-center" type="button" onclick="goBack()">
        <span class="rcts material-icons me-2">arrow_back</span> Go Back
    </button>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<!-- Custom Styles -->
<style>
    .full-navb{
        height: 72px;
    }
    .navex{
        height: 45px;
        margin-top: 22px;
    }
    nav .rct{
        padding: 10px 15px;
        border-radius: 8px;
        font-weight: 500;
        transition: background-color 0.3s ease, color 0.3s ease;
        color: #333 !important;
        text-decoration: none;
    }

    nav .rct:hover {
        background-color: #0e6dfd;
        color: #fff !important;
    }

    nav .rct .rcts.material-icons {
        font-size: 24px;
    }

    .nav-linkr {
        font-size: 16px;
        display: flex;
        align-items: center;
        color: #333 !important;
    }

    .nav-linkr.active {
        background-color: #007bff;
        color: #fff !important;
        border-radius: 8px;
    }

    .btns {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 500;
        transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
    }

    /* Hover effects */
    .btns:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        color: white;
    }

    /* Icon styling */
    .rcts {
        font-size: 24px;
        line-height: 1;
    }
</style>




<!-- Top Navbar -->
<div class="py-4">
    <div class="container">
        <div class="row position-relative">

            @yield('body')

            @if (!View::hasSection('tb-site-sidebar'))
            <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-6 col-12">
                <div class="p-2 bg-light offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample">
                    <div class="sidebar-nav mb-3">
                        <div class="pb-4">
                            <a href="{{route('normal-user.dashboard')}}" class="text-decoration-none">
                                <img src="{{asset('/')}}normal-user-assets/assets/img/studyXchange.png" class="img-fluid logo" alt="brand-logo">
                            </a>
                        </div>
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item">
                                <a href="{{route('normal-user.dashboard')}}" class="nav-link"><span class="material-icons me-3">house</span> <span>Feed</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('normal-user.dashboard')}}" class="nav-link"><span class="material-icons me-3">house</span> <span>Ask Question</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="profile.html" class="nav-link active"><span class="material-icons me-3">account_circle</span> <span>Profile</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="explore.html" class="nav-link"><span class="material-icons me-3">explore</span> <span>Explore</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#notification"><span class="material-icons me-3">translate</span> <span>Notification</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="index.html" class="nav-link"><span class="material-icons me-3">logout</span> <span>Logout</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="material-icons me-3">web</span> Pages
                                </a>
                                <ul class="dropdown-menu px-2 py-1 mb-2">
                                    <li><a class="dropdown-item rounded-3 px-2 py-1 my-1" href="contact.html">Contact</a></li>
                                    <li><a class="dropdown-item rounded-3 px-2 py-1 my-1" href="faq.html">FAQ</a></li>
                                    <li><a class="dropdown-item rounded-3 px-2 py-1 my-1" href="404.html">404 Error</a></li>
                                    <li><a class="dropdown-item rounded-3 px-2 py-1 my-1" href="{{route('normal-user.edit-profile.index', ['id' => auth()->user()->id])}}">Edit Profile</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="tags.html" class="nav-link"><span class="material-icons me-3">local_fire_department</span> <span>Trending</span></a>
                            </li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-primary w-100 text-decoration-none rounded-4 py-3 fw-bold text-uppercase m-0" data-bs-toggle="modal" data-bs-target="#signModal">Sign In +</a>
                </div>
                <!-- Sidebar -->
                <div class="ps-0 m-none fix-sidebar">
                    <div class="sidebar-nav mb-3 scroll-hidden" style="max-height: 80vh; overflow-y: auto;">
                        <div class="pb-4 mb-4">
                            <a href="{{route('normal-user.dashboard')}}" class="text-decoration-none">
                                <img src="{{asset('/')}}normal-user-assets/assets/img/studyXchange.png" style="height: 85px; margin-top: -10px; margin-bottom: -33px" class="img-fluid" alt="brand-logo">
                            </a>
                        </div>
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item {{ Route::is('normal-user.dashboard') ? 'active' : '' }}">
                                <a href="{{ route('normal-user.dashboard') }}" class="nav-link">
                                    <span class="material-icons me-3">house</span> <span>Feed</span>
                                </a>
                            </li>
                            {{--                            <li class="nav-item {{ Route::is('normal-user.chat') ? 'active' : '' }}">--}}
                            {{--                                <a href="{{ route('normal-user.chat') }}" class="nav-link">--}}
                            {{--                                    <span class="material-icons me-3">chat</span> <span>Chat</span>--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li class="nav-item">
                                <a href="{{ url('/chatify') }}" class="nav-link">
                                    <span class="material-icons me-3">chat</span> <span>Chat</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('normal-user.question.index') ? 'active' : '' }}">
                                <a href="{{ route('normal-user.question.index') }}" class="nav-link">
                                    <span class="material-icons me-3">question_answer</span> <span>Ask Question</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('normal-user.edit-profile.index') ? 'active' : '' }}">
                                <a href="{{ route('normal-user.edit-profile.index', ['id' => auth()->user()->id]) }}" class="nav-link">
                                    <span class="material-icons me-3">account_circle</span> <span>Profile</span>
                                </a>
                            </li>
                            <li class="nav-item position-relative">
                                <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#notification">
                                    <span class="material-icons me-3">notifications</span>
                                    <span>Notification</span>
                                    <!-- Badge for unread notifications (example with a random number) -->
                                    @if($notificationCount > 0)
                                        <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle p-1" style="font-size: 10px; margin-left: -18px; margin-top: 24px;">
                                        {{ $notificationCount }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('normal-user.career_recommendations.index') ? 'active' : '' }}">
                                <a href="{{ route('normal-user.career_recommendations.index') }}" class="nav-link">
                                    <span class="material-icons me-3">star</span> <span>Recommendation</span>
                                </a>
                            </li>

                            <li class="nav-item {{ Route::is('normal-user.admission.index') ? 'active' : '' }}">
                                <a href="{{ route('normal-user.admission.index') }}" class="nav-link">
                                    <span class="material-icons me-3">explore</span> <span>Admission</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('normal-user.research-project.index') ? 'active' : '' }}">
                                <a href="{{ route('normal-user.research-project.index') }}" class="nav-link">
                                    <span class="material-icons me-3">explore</span> <span>Research Collaboration</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('normal-user.resource-space.index')}}" class="nav-link">
                                    <span class="material-icons me-3">library_books</span> <span>Resource Space</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('normal-user.job.index')}}" class="nav-link">
                                    <span class="material-icons me-3">work</span> <span>Jobs</span>
                                </a>
                            </li>
{{--                            <li class="nav-item">--}}
{{--                                <a href="" class="nav-link">--}}
{{--                                    <span class="material-icons me-3">description</span> <span>Resume Builder</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a href="{{route('normal-user.skill-assessment.index')}}" class="nav-link">
                                    <span class="material-icons me-3">assessment</span> <span>Skill Assessment</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Authentication -->
                    <form method="POST" class="btn btn-primary w-100 text-decoration-none rounded-4 py-3 fw-bold text-uppercase m-0" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" class="text-white text-decoration-none" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                    <!-- Authentication -->
                </div>

                <style>
                    .nav-item.active .nav-link {
                        background-color: #ffffff; /* Example background color */
                        color: #007bff; /* Example text color */
                    }

                    .scroll-hidden {
                        -ms-overflow-style: none; /* IE and Edge */
                        scrollbar-width: none;    /* Firefox */
                    }

                    .scroll-hidden::-webkit-scrollbar {
                        display: none;            /* Chrome, Safari and Opera */
                    }
                </style>





            </aside>


            <!-- Right Side -->
                @if (!View::hasSection('right-sidebar'))
                    <aside class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="fix-sidebar">
                            <div class="side-trend lg-none">
                                <!-- Search Tab -->
                                <div class="sticky-sidebar2 mb-3">
                                    <div class="input-group mb-4 shadow-sm rounded-4 overflow-hidden py-2 bg-white">
                                        <span class="input-group-text material-icons border-0 bg-white text-primary">search</span>
                                        <input type="text" class="form-control border-0 fw-light ps-1" placeholder="Search Vogel">
                                    </div>
                                    <div class="bg-white rounded-4 overflow-hidden shadow-sm mb-4">
                                        <h6 class="fw-bold text-body p-3 mb-0 border-bottom">What's happening</h6>
                                        <!-- Trending Item -->
                                        <a href="tags.html" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                                            <div>
                                                <div class="text-muted fw-light d-flex align-items-center">
                                                    <small>Celebrity</small><span class="mx-1 material-icons md-3">circle</span><small>Live</small>
                                                </div>
                                                <p class="fw-bold mb-0 pe-3">Happy birthday, Osahan 🎂</p>
                                                <small class="text-muted">Trending with</small><br>
                                                <span class="text-primary">#HappyBirthdayJohnSmith</span>
                                            </div>
                                            <img src="{{asset('/')}}normal-user-assets/assets/img/rmate4.jpg" class="img-fluid rounded-4 ms-auto" alt="profile-img">
                                        </a>
                                        <!-- Trending Item -->
                                        <a href="tags.html" class="p-3 border-bottom d-flex align-items-center text-dark text-decoration-none">
                                            <div>
                                                <div class="text-muted fw-light d-flex align-items-center">
                                                </div>
                                                <p class="fw-bold mb-0 pe-3">#SelectricsM12</p>
                                                <small class="text-muted">Buy now with exclusive offers</small><br>
                                                <small class="text-muted d-flex align-items-center"><span class="material-icons me-1 small">open_in_new</span>Promoted by Selectrics World</small>
                                            </div>
                                        </a>

                                        <!-- Show More -->
                                        <a href="explore.html" class="text-decoration-none">
                                            <div class="p-3">Show More</div>
                                        </a>
                                    </div>
                                    <div class="bg-white rounded-4 overflow-hidden shadow-sm account-follow mb-4">
                                        <h6 class="fw-bold text-body p-3 mb-0 border-bottom">Who to follow</h6>
                                        <!-- Account Item -->
                                        <div class="p-3 border-bottom d-flex text-dark text-decoration-none account-item">
                                            <a href="profile.html">
                                                <img src="{{asset('/')}}normal-user-assets/assets/img/rmate5.jpg" class="img-fluid rounded-circle me-3" alt="profile-img">
                                            </a>
                                            <div>
                                                <p class="fw-bold mb-0 pe-3 d-flex align-items-center"><a class="text-decoration-none text-dark" href="profile.html">Webartinfo</a><span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span></p>
                                                <div class="text-muted fw-light">
                                                    <p class="mb-1 small">@abcdsec</p>
                                                    <span class="text-muted d-flex align-items-center small"><span class="material-icons me-1 small">open_in_new</span>Promoted</span>
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                    <input type="checkbox" class="btn-check" id="btncheck7">
                                                    <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="btncheck7"><span class="follow">+ Follow</span><span class="following d-none">Following</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Account Item -->
                                        <div class="p-3 border-bottom d-flex text-dark text-decoration-none account-item">
                                            <a href="profile.html">
                                                <img src="{{asset('/')}}normal-user-assets/assets/img/rmate4.jpg" class="img-fluid rounded-circle me-3" alt="profile-img">
                                            </a>
                                            <div>
                                                <p class="fw-bold mb-0 pe-3 d-flex align-items-center"><a class="text-decoration-none text-dark" href="profile.html">John Smith</a><span class="ms-2 material-icons bg-primary p-0 md-16 fw-bold text-white rounded-circle ov-icon">done</span></p>
                                                <div class="text-muted fw-light">
                                                    <p class="mb-1 small">@johnsmith</p>
                                                    <span class="text-muted d-flex align-items-center small">Designer</span>
                                                </div>
                                            </div>
                                            <div class="ms-auto">
                                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                    <input type="checkbox" class="btn-check" id="btncheck8">
                                                    <label class="btn btn-outline-primary btn-sm px-3 rounded-pill" for="btncheck8"><span class="follow">+ Follow</span><span class="following d-none">Following</span></label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                @endif
            @endif



        </div>
    </div>
</div>

<div class="py-3 bg-white footer-copyright">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="me-3 small">©2024 <b class="text-primary">StudyXchange</b>. All rights reserved</span>
            </div>
            <div class="col-md-4 text-end">
                <a target="_blank" href="#" class="btn social-btn btn-sm text-decoration-none"><i class="icofont-facebook"></i></a>
                <a target="_blank" href="#" class="btn social-btn btn-sm text-decoration-none"><i class="icofont-twitter"></i></a>
                <a target="_blank" href="#" class="btn social-btn btn-sm text-decoration-none"><i class="icofont-linkedin"></i></a>
                <a target="_blank" href="#" class="btn social-btn btn-sm text-decoration-none"><i class="icofont-youtube-play"></i></a>
                <a target="_blank" href="#" class="btn social-btn btn-sm text-decoration-none"><i class="icofont-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Post Modal -->

<!-- Notification -->

@include('normal-user.notification.index')



<!-- Comment Modal -->

<!-- Jquery Js -->
<script src="{{asset('/')}}normal-user-assets/assets/vendor/jquery/jquery.min.js" type="2a2d6de4edcf16eb12cebb7a-text/javascript"></script>
<!-- Bootstrap Bundle Js -->
<script src="{{asset('/')}}normal-user-assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js" type="2a2d6de4edcf16eb12cebb7a-text/javascript"></script>
<!-- Custom Js -->
<script src="{{asset('/')}}normal-user-assets/assets/js/custom.js" type="2a2d6de4edcf16eb12cebb7a-text/javascript"></script>
<!-- Slick Js -->
<script src="{{asset('/')}}normal-user-assets/assets/vendor/slick/slick/slick.min.js" type="2a2d6de4edcf16eb12cebb7a-text/javascript"></script>
<script src="{{asset('/')}}normal-user-assets/assets/cloudflare-static/rocket-loader.min.js" data-cf-settings="2a2d6de4edcf16eb12cebb7a-|49" defer></script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"8e26b4ecff82786e","version":"2024.10.5","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"dd471ab1978346bbb991feaa79e6ce5c","b":1}' crossorigin="anonymous"></script>





</body>

</html>
