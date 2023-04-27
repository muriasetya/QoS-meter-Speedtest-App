<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styleInput.css">
    <style>
        /* tambahkan CSS untuk menampilkan button SpeedTest di bawah button UJI !! */
        .container-login100-form-btn .login100-form-btn {
            display: block;
            margin: 0 auto;
            margin-bottom: 10px;
        }
    </style>
    <title>Landing page</title>
</head>
<body>
<div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="speedy.png" alt="IMG">
                </div>
                <form class="login100-form validate-form" action="hasil.php" method="POST">
                    <span class="login100-form-title">
                        Masukkan link
                    </span>
                    <div class="wrap-input100 validate-input">
                        <input class="input100" type="text" name="url" placeholder="Paste link anda disini">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-link" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Uji !!
                        </button>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="button" onclick="location.href='tes.php'">
                            SpeedTest
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
