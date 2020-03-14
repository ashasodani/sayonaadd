<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       
        <link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/style_m.css" rel="stylesheet" type="text/css"/>
        <link href="css/style_a.css" rel="stylesheet" type="text/css"/>
        <link href="css/style_s.css" rel="stylesheet" type="text/css"/>
        <link href="css/style_k.css" rel="stylesheet" type="text/css"/>
        <link href="css/responsive.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico">
        
        <!--</head>-->
        <!-- end::Head -->
        <!-- end::Body -->
    </head>
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default login_page">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page login_sec">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">

                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1  m-login__content left_s">
                    <div class="m-grid__item m-grid__item--middle">
                        <div class="side_logo img">
                            <img src="images/scs_logo.png">
                        </div>
                    </div>
                </div>


                <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside right_s">
                    <div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-stack__item m-stack__item--fluid">
                            <div class="m-login__wrapper">
                                <div class="m-login__signin">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Login to Your Account 
                                        </h3>
                                    </div>
                
                                    <form class="m-login__form m-form" action="postlogin" method="post">
                                        @csrf
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="text" placeholder="Email*" name="email" id="email" autocomplete="off">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input m-login__form-input--last" type="password" id="password" placeholder="Password*" name="password">
                                        </div>
                                        <div class="row m-login__form-sub">
                                            <div class="col m--align-left">
                                                <label class="m-checkbox m-checkbox--focus">
                                                    <input type="checkbox" name="remember">
                                                    Remember me
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col m--align-right">
                                                <a href="{{url('/forgot_password')}}" id="m_login_forget_password" class="m-link">
                                                    Forget Password ?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-login__form-action">
                                            <!-- <a href="{{url('/login')}}"  id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Login
                                            </a> -->
                                            <input type="submit" name="login" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air" value="Login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end:: Body -->

        <!-- end:: Page -->             
        <!--begin::Base Scripts -->
        <script src="assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->   
        <!--begin::Page Vendors -->
        <script src="assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
        <!--end::Page Vendors -->  
        <!--begin::Page Snippets -->
        <script src="js/bootstrap-select.js" type="text/javascript"></script>
        <script src="assets/app/js/dashboard.js" type="text/javascript"></script>
        <script src="js/custom.js" type="text/javascript"></script>
        <script src="js/scrollable.js" type="text/javascript"></script>
        <script src="assets/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
</html>
