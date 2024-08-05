<!DOCTYPE html>
<html lang="en">
<?php require('config.php') ?>

<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<link rel="stylesheet" href="../../GUI/css/reset.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css" type="text/css" media="all" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../image/logo-fascon.png" type="image/x-icon">
    <style>
        <?php 
        
        require('css/Login.css');
        ?>
    </style>
</head>

<body>
    <section class="w3l-form-36">
        <div class="form-36-mian section-gap">
            <div class="wrapper">
                <div class="form-inner-cont">
                    <h3>ĐĂNG NHẬP</h3>
                    <form action="/login" method="post" class="signin-form" id="loginForm">
                        <div class="form-input">
                            <span class="fa fa-envelope" aria-hidden="true"></span> 
                            <input id="userNameInput" type="text" name="email" placeholder="Tên tài khoản" required />
                        </div>
                        <div class="form-input">
                            <span class="fa fa-key" aria-hidden="true"></span> 
                            <input id="passWordInput" type="password" name="password" placeholder="Mật khẩu" required />
                        </div>
                        <div class="login-remember d-grid">
                            <label class="check-remaind">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                                <p class="remember">Nhớ mật khẩu</p>
                            </label>
                            <button class="btn theme-button" id="loginbutton" type="submit" >Đăng Nhập</button>
                        </div>
                        <div class="new-signup">
                            <!-- <a href="./forgot-password.php" class="signuplink">Forgot password?</a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../../Js/login.js?v=<?php echo $version ?>"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>