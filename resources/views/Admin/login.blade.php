<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>FisheerLog - Login Page</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

    <!-- Begin page -->
    <<div class="container">
        <div class="left-section">
            <img src="{{ asset('assets/images/Ilutrasi Login.png') }}" alt="Illustration">
        </div>
        <div class="right-section">
            <div class="login-box">
                <p>Welcome back,</p>
                <h2>Please, Log in.</h2>
                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="input-box">
                        <span class="icon ti-user"></span>
                        <input type="username" name="username" placeholder="Username" required>
                    </div>
                    <div class="input-box">
                        <span class="icon ti-lock"></span>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit">Log in</button>
                </form>
            </div>
        </div>
        </div>


        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>