<?php $title = "Password Reset" ?>
<?php include 'header.php' ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 text-center mt-5">
                <center>
                    <div class="login-logo center">
                        <img src="img/logo.png" alt="logo">
                    </div>
                </center>
                <div class="login-header">
                    <h6> Academic Repositoty Reset Password Page</h6>
                    <small class="text-danger">You are required to enter phone number that you regiatered with</small>
                </div>
                <!-- login form  -->
                <form action="" method="post">
                    <div class="mt-3">
                        <input type="text" name="username" id="username" placeholder="Enter phone number" class="form-control p-3"> 
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark btn-block">Request new Password <i class="bx bx-send"></i></button>
                    </div>
                    <div class="mt-2">
                        <a href="index.php"><small>Back to login page</small></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>