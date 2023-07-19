<?php
session_start();
if (isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include_once("../database/conection.php");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    //bắt lỗi khi người dùng không nhập đủ thông tin
    //lấy thông tin user từ database theo email
    $user = $dbConn->query("SELECT id, email, password FROM users where email='$email'");
    //kiểm tra email có tồn tại hay không
    if ($user->rowCount() > 0) {
        $row = $user->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];
        //kiểm tra mật khẩu có đúng hay không
        if ($password == $pswd) {
            $_SESSION['email'] = $email;
            //nếu đúng thì đăng nhập thành công
            header("Location: index.php");
        } else {
            echo "<font color ='red'>Dang nhap khong thanh cong.</font><br/>";
        }
    } else {
        echo "<font color ='red'>Email không tồn tại.</font><br/>";
    }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <form method="post" class="user" novalidate="" autocomplete="off" action="./login.php">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                                    <div class="invalid-feedback">
                                        Email is invalid
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                        <a href="forgot.html" class="float-end">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="pswd" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-primary ms-auto">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Don't have an account? <a href="register.html" class="text-dark">Create One</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>

</html>