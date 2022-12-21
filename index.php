<?php session_start() ?>
<?php $title = "User Login" ?>
<?php include 'header.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center mt-7 card pb-4 pt-md-4">
                <center>
                    <div class="login-logo center">
                        <img src="img/logo.png" alt="logo">
                    </div>
                </center>
                <div class="login-header">
                <h5> Academic Repositoty </h5>
                <?php include('config/message.php') ?>
                </div>
                <!-- login form  -->
                <form action="login.php" method="post">
                    <div class="form-group">
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                            </div>
                            <input type="text" name="username" id="username" placeholder="username or email" class="form-control p-3">
                        </div>
                        <div class="input-group mt-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="bx bx-lock-open-alt"></i></span>
                            </div>
                            <input type="password" name="password" id="password" placeholder="password" class="form-control p-3">
                        </div>
                        <div class="mt-4">
                            <button type="submit" name="login" class="btn btn-dark btn-block">sing-in <i class="bx bx-log-in"></i></button>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="new-account.php"><small>Don't Have Account?</small></a>
                            <a href="reset-password.php"><small>Forgot Password</small></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>