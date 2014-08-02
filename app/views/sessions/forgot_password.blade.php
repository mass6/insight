<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Insight Management Portal" />
    <meta name="author" content="" />

    <title>Insight | Forgot Password</title>


    <link rel="stylesheet" href="{{ URL::asset('js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/neon-forms.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/skins/blue.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">

    <script src="{{ URL::asset('js/jquery-1.11.0.min.js') }}"></script>

    <!--[if lt IE 9]><script src="{{ URL::asset('js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = '';
</script>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="index.html" class="logo">
                <img src="{{ URL::asset('images/insight-100.png') }}" alt="36S Insight" />
            </a>

            <p class="description">Enter your email, and we will send you a reset link.</p>

            <!-- progress bar indicator -->
            <div class="login-progressbar-indicator">
                <h3>43%</h3>
                <span>processing your request...</span>
            </div>
        </div>

    </div>

    <div class="login-progressbar">
        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">

            <form method="post" role="form" id="form_forgot_password">

                <div class="form-forgotpassword-success">
                    <i class="entypo-check"></i>
                    <h3>Reset email has been sent.</h3>
                    <p>Please check your email for the reset link.</p>
                </div>

                <div class="form-steps">

                    <div class="step current" id="step-1">

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="entypo-mail"></i>
                                </div>

                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" data-mask="email" autocomplete="off" />
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-login">
                                Request reset code
                                <i class="entypo-right-open-mini"></i>
                            </button>
                        </div>

                    </div>

                </div>

            </form>


            <div class="login-bottom-links">

                <a href="{{ route('login_path') }}" class="link">
                    <i class="entypo-lock"></i>
                    Return to Login Page
                </a>

                <br />



            </div>

        </div>

    </div>

</div>


<!-- Bottom Scripts -->
<script src="{{ URL::asset('js/gsap/main-gsap.js') }}"></script>
<script src="{{ URL::asset('js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.js') }}"></script>
<script src="{{ URL::asset('js/joinable.js') }}"></script>
<script src="{{ URL::asset('js/resizeable.js') }}"></script>
<script src="{{ URL::asset('js/neon-api.js') }}"></script>
<script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('js/neon-forgotpassword.js') }}"></script>
<script src="{{ URL::asset('js/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ URL::asset('js/neon-custom.js') }}"></script>
<script src="{{ URL::asset('js/neon-demo.js') }}"></script>


</body>
</html>