<!doctype html>
<html lang="en">
<head>
    <title>Masuk Akun</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/login-style.css">
    <link rel="stylesheet" href="/assets/css/base-style.css">
</head>
<body class="login">
    <div class="login-overlay"></div>
    <div class="container-fluid container-full">
        <div class="row">
            <div class="col-4 offset-4 form-wrapper rounded">
                <div class="row montserrat-font">
                    <div class="col-12 text-center sign-nav text-light pt-2 pb-2 rounded-left sign-nav-active">
                        Masuk Akun
                    </div>
                </div>
                <form action="{{ route('login.auth') }}" method="post">
                    @csrf
                    <div class="row poppins-font" id="sign-in-form">
                        <div class="col-10 offset-1 mt-5">
                            <div class="input-group">
                                <span class="input-group-text input-title text-dark">
                                    Pengguna
                                </span>
                                <input type="text" class="form-control form-input" name="username" id="name" placeholder="Masukan nama pengguna" aria-label="">
                            </div>
                        </div>
                        <div class="col-10 offset-1 mt-3">
                            <div class="input-group">
                                <span class="input-group-text input-title text-dark">
                                    Kata Sandi
                                </span>
                                <input type="password" class="form-control form-input password" name="password" id="password" placeholder="Masukan kata sandi" aria-label="">
                                <span class="input-group-text pwstatus bg-light">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-10 offset-1 mt-4 mb-5">
                            <button class="btn btn-sign text-light">
                                Masuk akun
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    @if(Session::has('alert'))
    <div class="float-alert bg-{{ Session::get('type') }} rounded text-center pl-3 pr-3">
        <p>{{ Session::get('alert') }}</p>
    </div>
    @endif

    <script>
        $('.pwstatus').click(function () { 
            $('.pwstatus .fa').toggleClass('fa-eye-slash');
            $('.pwstatus .fa').toggleClass('fa-eye');

            if ($('.pwstatus .fa').hasClass('fa-eye-slash')) {
                $('.password').attr('type', 'password');
            }else{
                $('.password').attr('type', 'text');
            }
        });
    </script>
</body>
</html>