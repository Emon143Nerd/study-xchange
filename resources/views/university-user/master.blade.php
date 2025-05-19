<!DOCTYPE html>
<html lang="en">


<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <!--Title-->
    <title>@yield('title')</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="keywords" content="PHP payment admin template, Bootstrap admin dashboard, payment system template, payment management UI, responsive admin template, PHP SaaS Admin Dashboard, Saas Dashboard Template, DexignZone, SSL Encryption, Mobile Optimization, e-commerce, UX/UI, Bootstrap 5, Admin Panel, HTML5, CSS3, Responsive Web App, User Interface Design, mobile commerce, dark layout, PWA (Progressive Web App), App Development, Product Showcase, Customizable, Modern Design, UI/UX Design">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
    <meta name="description" content="Discover Mophy, an advanced PHP payment admin dashboard crafted with Bootstrap for seamless payment management. This responsive and feature-rich admin panel simplifies payment processing, offering intuitive controls and insightful analytics. Empower your business with Mophy comprehensive tools and responsive design">
    <meta name="og:title" content="Mophy - PHP Payment Admin Dashboard Bootstrap Template | DexignZone">
    <meta name="og:description" content="Discover Mophy, an advanced PHP payment admin dashboard crafted with Bootstrap for seamless payment management. This responsive and feature-rich admin panel simplifies payment processing, offering intuitive controls and insightful analytics. Empower your business with Mophy comprehensive tools and responsive design">
    <meta name="og:image" content="../social-image.png">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:title" content="Mophy - PHP Payment Admin Dashboard Bootstrap Template | DexignZone">
    <meta name="twitter:description" content="Discover Mophy, an advanced PHP payment admin dashboard crafted with Bootstrap for seamless payment management. This responsive and feature-rich admin panel simplifies payment processing, offering intuitive controls and insightful analytics. Empower your business with Mophy comprehensive tools and responsive design">
    <meta name="twitter:image" content="../social-image.png">
    <meta name="twitter:card" content="summary_large_image">

    <!-- MOBILE SPECIFIC -->


    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('/')}}super-admin-assets/assets/images/favicon.png">
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/chartist/css/chartist.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="../../../fonts.googleapis.com/css2e91f.css?family=Material+Icons" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/css/style.css" rel="stylesheet" type="text/css"/>

    <!-- Date Picker -->
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://mophy.dexignzone.com/xhtml/page-error-404.html" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/pickadate/themes/default.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('/')}}super-admin-assets/assets/vendor/pickadate/themes/default.date.css" rel="stylesheet" type="text/css"/>
    <!-- Date Picker -->

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>	<!--*******************
        Preloader end
    ********************-->

<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <a href="{{route('university-user.dashboard')}}" class="brand-logo">
            <img class="logo-compact" src="{{asset('/')}}normal-user-assets/research-project-assets/images/studyXchange.png" height="90" width="auto" alt="">
            <img class="brand-title" src="{{asset('/')}}normal-user-assets/research-project-assets/images/studyXchange.png" height="90" width="auto" alt="">
        </a>

        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
            </div>
        </div>
    </div>		<!--**********************************
            Nav header end
        ***********************************-->

    <!--**********************************
        Chat box start
    ***********************************-->
    <div class="chatbox">
        <div class="chatbox-close"></div>
        <div class="custom-tab-1">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#notes">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#alerts">Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#chat">Chat</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="chat" role="tabpanel">
                    <div class="card mb-sm-3 mb-md-0 contacts_card dz-chat-user-box">
                        <div class="card-header chat-list-header text-center">
                            <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
                                    </g>
                                </svg></a>
                            <div>
                                <h6 class="mb-1">Chat List</h6>
                                <p class="mb-0">Show All</p>
                            </div>
                            <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="5" cy="12" r="2" />
                                        <circle fill="#000000" cx="12" cy="12" r="2" />
                                        <circle fill="#000000" cx="19" cy="12" r="2" />
                                    </g>
                                </svg></a>
                        </div>
                        <div class="card-body contacts_body p-0 dz-scroll  " id="DZ_W_Contacts_Body">
                            <ul class="contacts">
                                <li class="name-first-letter">A</li>
                                <li class="active dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Archie Parker</span>
                                            <p>Kalid is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Alfie Mason</span>
                                            <p>Taherah left 7 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/3.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>AharlieKane</span>
                                            <p>Sami is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/4.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Athan Jacoby</span>
                                            <p>Nargis left 30 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="name-first-letter">B</li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/5.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Bashid Samim</span>
                                            <p>Rashid left 50 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Breddie Ronan</span>
                                            <p>Kalid is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Ceorge Carson</span>
                                            <p>Taherah left 7 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="name-first-letter">D</li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/3.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Darry Parker</span>
                                            <p>Sami is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/4.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Denry Hunter</span>
                                            <p>Nargis left 30 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="name-first-letter">J</li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/5.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Jack Ronan</span>
                                            <p>Rashid left 50 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Jacob Tucker</span>
                                            <p>Kalid is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>James Logan</span>
                                            <p>Taherah left 7 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/3.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Joshua Weston</span>
                                            <p>Sami is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="name-first-letter">O</li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/4.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Oliver Acker</span>
                                            <p>Nargis left 30 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="dz-chat-user">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont">
                                            <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/5.jpg" class="rounded-circle user_img" alt="">
                                            <span class="online_icon offline"></span>
                                        </div>
                                        <div class="user_info">
                                            <span>Oscar Weston</span>
                                            <p>Rashid left 50 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card chat dz-chat-history-box d-none">
                        <div class="card-header chat-list-header text-center">
                            <a href="javascript:void(0)" class="dz-chat-history-back">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(15.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-15.000000, -12.000000) " x="14" y="7" width="2" height="10" rx="1" />
                                        <path d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997) " />
                                    </g>
                                </svg>
                            </a>
                            <div>
                                <h6 class="mb-1">Chat with Khelesh</h6>
                                <p class="mb-0 text-success">Online</p>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" cx="5" cy="12" r="2" />
                                            <circle fill="#000000" cx="12" cy="12" r="2" />
                                            <circle fill="#000000" cx="19" cy="12" r="2" />
                                        </g>
                                    </svg></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
                                    <li class="dropdown-item"><i class="fa fa-users text-primary me-2"></i> Add to close friends</li>
                                    <li class="dropdown-item"><i class="fa fa-plus text-primary me-2"></i> Add to group</li>
                                    <li class="dropdown-item"><i class="fa fa-ban text-primary me-2"></i> Block</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body msg_card_body dz-scroll" id="DZ_W_Contacts_Body3">
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    Hi, how are you samim?
                                    <span class="msg_time">8:40 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    Hi Khalid i am good tnx how about you?
                                    <span class="msg_time_send">8:55 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    I am good too, thank you for your chat template
                                    <span class="msg_time">9:00 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    You are welcome
                                    <span class="msg_time_send">9:05 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    I am looking for your next templates
                                    <span class="msg_time">9:07 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    Ok, thank you have a good day
                                    <span class="msg_time_send">9:10 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    Bye, see you
                                    <span class="msg_time">9:12 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    Hi, how are you samim?
                                    <span class="msg_time">8:40 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    Hi Khalid i am good tnx how about you?
                                    <span class="msg_time_send">8:55 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    I am good too, thank you for your chat template
                                    <span class="msg_time">9:00 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    You are welcome
                                    <span class="msg_time_send">9:05 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    I am looking for your next templates
                                    <span class="msg_time">9:07 AM, Today</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="msg_cotainer_send">
                                    Ok, thank you have a good day
                                    <span class="msg_time_send">9:10 AM, Today</span>
                                </div>
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/2.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-start mb-4">
                                <div class="img_cont_msg">
                                    <img src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg" class="rounded-circle user_img_msg" alt="">
                                </div>
                                <div class="msg_cotainer">
                                    Bye, see you
                                    <span class="msg_time">9:12 AM, Today</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer type_msg">
                            <div class="input-group">
                                <textarea class="form-control" placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-location-arrow"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="alerts" role="tabpanel">
                    <div class="card mb-sm-3 mb-md-0 contacts_card">
                        <div class="card-header chat-list-header text-center">
                            <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="5" cy="12" r="2" />
                                        <circle fill="#000000" cx="12" cy="12" r="2" />
                                        <circle fill="#000000" cx="19" cy="12" r="2" />
                                    </g>
                                </svg></a>
                            <div>
                                <h6 class="mb-1">Notications</h6>
                                <p class="mb-0">Show All</p>
                            </div>
                            <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg></a>
                        </div>
                        <div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body1">
                            <ul class="contacts">
                                <li class="name-first-letter">SEVER STATUS</li>
                                <li class="active">
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont primary">KK</div>
                                        <div class="user_info">
                                            <span>David Nester Birthday</span>
                                            <p class="text-primary">Today</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="name-first-letter">SOCIAL</li>
                                <li>
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont success">RU<i class="icon fa-birthday-cake"></i></div>
                                        <div class="user_info">
                                            <span>Perfection Simplified</span>
                                            <p>Jame Smith commented on your status</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="name-first-letter">SEVER STATUS</li>
                                <li>
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont primary">AU<i class="icon fa fa-user-plus"></i></div>
                                        <div class="user_info">
                                            <span>AharlieKane</span>
                                            <p>Sami is online</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex bd-highlight">
                                        <div class="img_cont info">MO<i class="icon fa fa-user-plus"></i></div>
                                        <div class="user_info">
                                            <span>Athan Jacoby</span>
                                            <p>Nargis left 30 mins ago</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="notes">
                    <div class="card mb-sm-3 mb-md-0 note_card">
                        <div class="card-header chat-list-header text-center">
                            <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) " x="4" y="11" width="16" height="2" rx="1" />
                                    </g>
                                </svg></a>
                            <div>
                                <h6 class="mb-1">Notes</h6>
                                <p class="mb-0">Add New Nots</p>
                            </div>
                            <a href="javascript:void(0)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg></a>
                        </div>
                        <div class="card-body contacts_body p-0 dz-scroll" id="DZ_W_Contacts_Body2">
                            <ul class="contacts">
                                <li class="active">
                                    <div class="d-flex bd-highlight">
                                        <div class="user_info">
                                            <span>New order placed..</span>
                                            <p>10 Aug 2020</p>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex bd-highlight">
                                        <div class="user_info">
                                            <span>Youtube, a video-sharing website..</span>
                                            <p>10 Aug 2020</p>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex bd-highlight">
                                        <div class="user_info">
                                            <span>john just buy your product..</span>
                                            <p>10 Aug 2020</p>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex bd-highlight">
                                        <div class="user_info">
                                            <span>Athan Jacoby</span>
                                            <p>10 Aug 2020</p>
                                        </div>
                                        <div class="ms-auto">
                                            <a href="javascript:void(0)" class="btn btn-primary btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>		<!--**********************************
            Chat box End
        ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            <div class="input-group search-area d-lg-inline-flex d-none">
                                <div class="input-group-append">
                                    <button class="input-group-text search_icon search_icon"><i class="flaticon-381-search-2"></i></button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search here...">
                            </div>
                        </div>
                    </div>
                    <ul class="navbar-nav header-right">
{{--                        <li class="nav-item">--}}
{{--                            <div class="d-flex weather-detail">--}}
{{--                                <span><i class="las la-cloud"></i>21</span>--}}
{{--                                Medan, IDN--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown notification_dropdown">--}}
{{--                            <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">--}}
{{--                                <i id="icon-light" class="fas fa-sun"></i>--}}
{{--                                <i id="icon-dark" class="fas fa-moon"></i>--}}

{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown notification_dropdown">--}}
{{--                            <a class="nav-link  ai-icon" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">--}}
{{--                                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6001 4.3008V1.4C12.6001 0.627199 13.2273 0 14.0001 0C14.7715 0 15.4001 0.627199 15.4001 1.4V4.3008C17.4805 4.6004 19.4251 5.56639 20.9287 7.06999C22.7669 8.90819 23.8001 11.4016 23.8001 14V19.2696L24.9327 21.5348C25.4745 22.6198 25.4171 23.9078 24.7787 24.9396C24.1417 25.9714 23.0147 26.6 21.8023 26.6H15.4001C15.4001 27.3728 14.7715 28 14.0001 28C13.2273 28 12.6001 27.3728 12.6001 26.6H6.19791C4.98411 26.6 3.85714 25.9714 3.22014 24.9396C2.58174 23.9078 2.52433 22.6198 3.06753 21.5348L4.20011 19.2696V14C4.20011 11.4016 5.23194 8.90819 7.07013 7.06999C8.57513 5.56639 10.5183 4.6004 12.6001 4.3008ZM14.0001 6.99998C12.1423 6.99998 10.3629 7.73779 9.04973 9.05099C7.73653 10.3628 7.00011 12.1436 7.00011 14V19.6C7.00011 19.817 6.94833 20.0312 6.85173 20.2258C6.85173 20.2258 6.22871 21.4718 5.57072 22.7864C5.46292 23.0034 5.47412 23.2624 5.60152 23.4682C5.72892 23.674 5.95431 23.8 6.19791 23.8H21.8023C22.0445 23.8 22.2699 23.674 22.3973 23.4682C22.5247 23.2624 22.5359 23.0034 22.4281 22.7864C21.7701 21.4718 21.1471 20.2258 21.1471 20.2258C21.0505 20.0312 21.0001 19.817 21.0001 19.6V14C21.0001 12.1436 20.2623 10.3628 18.9491 9.05099C17.6359 7.73779 15.8565 6.99998 14.0001 6.99998Z" fill="#3E4954" />--}}
{{--                                </svg>--}}
{{--                                <span class="badge light text-white bg-primary rounded-circle">12</span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">--}}
{{--                                    <ul class="timeline">--}}
{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media me-2">--}}
{{--                                                    <img alt="image" width="50" src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Dr sultads Send you Photo</h6>--}}
{{--                                                    <small class="d-block">29 July 2023 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media me-2 media-info">--}}
{{--                                                    KG--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Resport created successfully</h6>--}}
{{--                                                    <small class="d-block">29 July 2023 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media me-2 media-success">--}}
{{--                                                    <i class="fa fa-home"></i>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Reminder : Treatment Time!</h6>--}}
{{--                                                    <small class="d-block">29 July 2023 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media me-2">--}}
{{--                                                    <img alt="image" width="50" src="{{asset('/')}}super-admin-assets/assets/images/avatar/1.jpg">--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Dr sultads Send you Photo</h6>--}}
{{--                                                    <small class="d-block">29 July 2023 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media me-2 media-danger">--}}
{{--                                                    KG--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Resport created successfully</h6>--}}
{{--                                                    <small class="d-block">29 July 2023 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li>--}}
{{--                                            <div class="timeline-panel">--}}
{{--                                                <div class="media me-2 media-primary">--}}
{{--                                                    <i class="fa fa-home"></i>--}}
{{--                                                </div>--}}
{{--                                                <div class="media-body">--}}
{{--                                                    <h6 class="mb-1">Reminder : Treatment Time!</h6>--}}
{{--                                                    <small class="d-block">29 July 2023 - 02:26 PM</small>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <a class="all-notification" href="javascript:void(0)">See all notifications <i class="ti-arrow-right"></i></a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item dropdown notification_dropdown">--}}
{{--                            <a class="nav-link bell bell-link" href="javascript:void(0)">--}}
{{--                                <svg width="20" height="20" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.6666 8.16666C25.6666 5.5895 23.5771 3.5 21 3.5C17.1161 3.5 10.8838 3.5 6.99998 3.5C4.42281 3.5 2.33331 5.5895 2.33331 8.16666V23.3333C2.33331 23.8058 2.61798 24.2305 3.05315 24.4113C3.48948 24.5922 3.99115 24.4918 4.32481 24.1582C4.32481 24.1582 6.59281 21.8902 7.96714 20.517C8.40464 20.0795 8.99733 19.8333 9.61683 19.8333H21C23.5771 19.8333 25.6666 17.7438 25.6666 15.1667V8.16666ZM23.3333 8.16666C23.3333 6.87866 22.2891 5.83333 21 5.83333C17.1161 5.83333 10.8838 5.83333 6.99998 5.83333C5.71198 5.83333 4.66665 6.87866 4.66665 8.16666V20.517L6.31631 18.8673C7.19132 17.9923 8.37899 17.5 9.61683 17.5H21C22.2891 17.5 23.3333 16.4558 23.3333 15.1667V8.16666ZM8.16665 15.1667H17.5C18.144 15.1667 18.6666 14.644 18.6666 14C18.6666 13.356 18.144 12.8333 17.5 12.8333H8.16665C7.52265 12.8333 6.99998 13.356 6.99998 14C6.99998 14.644 7.52265 15.1667 8.16665 15.1667ZM8.16665 10.5H19.8333C20.4773 10.5 21 9.97733 21 9.33333C21 8.68933 20.4773 8.16666 19.8333 8.16666H8.16665C7.52265 8.16666 6.99998 8.68933 6.99998 9.33333C6.99998 9.97733 7.52265 10.5 8.16665 10.5Z" fill="#3E4954" />--}}
{{--                                </svg>--}}
{{--                                <span class="badge light text-white bg-primary rounded-circle">5</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nav-item dropdown header-profile">
                            <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">

                                <button class="setting-btn">Settings</button>
                                <style>
                                    .setting-btn {
                                        background: linear-gradient(135deg, #4c7eaf, #8197c7);
                                        color: white;
                                        font-size: 16px;
                                        font-weight: bold;
                                        padding: 10px 20px;
                                        border: none;
                                        border-radius: 8px;
                                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                        cursor: pointer;
                                        transition: all 0.3s ease-in-out;
                                    }

                                    .setting-btn:hover {
                                        background: linear-gradient(135deg, #388e3c, #66bb6a);
                                        transform: scale(1.05);
                                        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
                                    }

                                    .setting-btn:active {
                                        transform: scale(0.98);
                                        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
                                    }
                                </style>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                <!-- Authentication -->
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>		<!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
        Sidebar start
    ***********************************-->
    <div class="deznav">
        <div class="deznav-scroll">
            <ul class="metismenu" id="menu">
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">University</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.university.create')}}">Add University</a></li>
                        <li><a href="{{route('university-user.university.index')}}">Manage University</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">Subject Category</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.subject-category.create')}}">Add Category</a></li>
                        <li><a href="{{route('university-user.subject-category.index')}}">Manage Category</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">Admission Circular</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.admission-circular.create')}}">Add Circular</a></li>
                        <li><a href="{{route('university-user.admission-circular.index')}}">Manage Circular</a></li>
                        <li><a href="{{route('university-user.applicants.index')}}">Manage Applicants</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">University FAQ's</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.FAQ.create')}}">Add FAQ's</a></li>
                        <li><a href="{{route('university-user.FAQ.index')}}">Manage FAQ's</a></li>
                    </ul>
                </li>

                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">Course Category</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.course.create')}}">Add Course</a></li>
                        <li><a href="{{route('university-user.course.index')}}">Manage Course</a></li>
                    </ul>
                </li>

                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">Quiz Question</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.course-quiz-question.create')}}">Add Quiz Question</a></li>
                        <li><a href="{{route('university-user.course-quiz-question.index')}}">Manage Quiz Question</a></li>
                        <li><a href="{{route('university-user.quizResponse')}}">Manage Student Responses</a></li>
                    </ul>
                </li>

                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa-regular fa-gear fw-bold"></i>
                        <span class="nav-text">Descriptive Ques</span>

                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('university-user.course-descriptive-question.create')}}">Add Descriptive Question</a></li>
                        <li><a href="{{route('university-user.course-descriptive-question.index')}}">Manage Descriptive Question</a></li>
                        <li><a href="{{route('university-user.descriptiveResponse')}}">Manage Student Responses</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>

    <!--**********************************
            Sidebar end
        ***********************************-->

    @yield('body')

    <!--**********************************
        Footer start
    ***********************************-->
    <div class="footer">
        <div class="copyright">
            <p>©2024 StudyXchange. All rights reserved</p>
        </div>
    </div>		<!--**********************************
            Footer end
        ***********************************-->

    <!--**********************************
       Support ticket button start
    ***********************************-->

    <!--**********************************
       Support ticket button end
    ***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->


<script> var enableSupportButton = '1'</script>

<script src="{{asset('/')}}super-admin-assets/assets/vendor/global/global.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/chart-js/chart.bundle.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/owl-carousel/owl.carousel.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/peity/jquery.peity.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/apexchart/apexchart.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/dashboard/dashboard-1.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/custom.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/deznav-init.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/demo.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/styleSwitcher.js" type="text/javascript"></script>

<script> var enableSupportButton = '1'</script>

<script src="{{asset('/')}}super-admin-assets/assets/vendor/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/plugins-init/datatables.init.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/datatables/responsive/responsive.js" type="text/javascript"></script>

<script>
    function carouselReview() {
        /*  testimonial one function by = owl.carousel.js */
        /*  testimonial one function by = owl.carousel.js */
        jQuery('.testimonial-one').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            nav: false,
            center: true,
            rtl:true,
            dots: false,
            navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'],
            responsive: {
                0: {
                    items: 2
                },
                400: {
                    items: 3
                },
                700: {
                    items: 5
                },
                991: {
                    items: 6
                },

                1200: {
                    items: 4
                },
                1600: {
                    items: 5
                }
            }
        })
    }

    jQuery(window).on('load', function () {
        setTimeout(function () {
            carouselReview();

        }, 1000);
    });

    jQuery(document).ready(function(){
        setTimeout(function(){
            dezSettingsOptions.version = 'light';
            new dezSettings(dezSettingsOptions);

            setCookie('version','light');
        },1500)
    });
</script>


<!-- Category Page -->
<script> var enableSupportButton = '1'</script>
<script src="{{asset('/')}}super-admin-assets/assets/js/dashboard/cms.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/plugins-init/select2-init.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").on('change', function () {

        readURL(this);
    });
    $('.remove-img').on('click', function () {
        var imageUrl = "https://mophy.dexignzone.com/xhtml/page-error-404.html";
        $('.avatar-preview, #imagePreview').removeAttr('style');
        $('#imagePreview').css('background-image', 'url(' + imageUrl + ')');
    });
</script>

<!-- Date Picker -->
<script src="{{asset('/')}}super-admin-assets/assets/vendor/moment/moment.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/https://mophy.dexignzone.com/xhtml/page-error-404.html" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/pickadate/picker.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/pickadate/picker.time.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/vendor/pickadate/picker.date.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/plugins-init/bs-daterange-picker-init.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/plugins-init/clock-picker-init.js" type="text/javascript"></script>
<script src="https://mophy.dexignzone.com/xhtml/page-error-404.html" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/plugins-init/material-date-picker-init.js" type="text/javascript"></script>
<script src="{{asset('/')}}super-admin-assets/assets/js/plugins-init/pickadate-init.js" type="text/javascript"></script>
<!-- Date Picker -->

</body>


</html>
