<?php session_start() ?>
<?php $title = "New Account" ?>
<?php include 'header.php' ?>
<body class="bg-dark">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card p-3">
                    <center>
                        <div class="registration-logo center">
                            <img src="img/logo.png" alt="logo">
                        </div>
                    </center>
                    <div class="login-header">
                        <h5 class="text-center text-success"> 
                            <small>
                                <strong class="text-danger">---</strong> 
                                Welcome To Academic Repositoty Fill the Form To Have Account and Enjoy Our Services
                                <strong class="text-danger">---</strong> 
                            </small>
                        </h5>
                    </div>
                    <form action="new-account-action.php" method="POST">
                        <?php include('config/message.php') ?>
                        <div class="form-row">
                            <div class="col-md-6 mt-4">
                                <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" >
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" >
                            </div>
                            <div class="col-md-6 mt-4">
                                <select name="sex" class="form-control" >
                                    <option value="">---select sex---</option>
                                    <option value="F">Female</option>
                                    <option value="M">Male</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="number" name="phone" id="phone" placeholder="Phone Number" class="form-control" >
                            </div>  
                            <div class="col-md-6 mt-4">
                                <input type="email" name="email" id="email" placeholder="example@gmail.com" class="form-control" >
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="text" name="username" id="username" placeholder="Username" class="form-control" >
                            </div> 
                            <div class="col-md-6 mt-4">
                                <input type="password" name="password" id="password" placeholder="Passoword" class="form-control" >
                            </div>
                            <div class="col-md-6 mt-4">
                                <input type="password" name="confirm_passowrd" id="confirm_passowrd" placeholder="Confirm Password" class="form-control" >
                            </div> 
                            <div class="col-md-12 mt-4">
                                <small class="text-secondary">By Registrering to this system you accept terms of aggrement. Your are not allowed to 
                                    upload anything that is not related to accademic issue, only pdf for now is allowed for any 
                                    trick of uploading video to this system after being detected you will pay for it.
                                </small>
                            </div>
                            <div class="col-md-12 mt-4">
                                <input type="checkbox" name="term" id="term" value="accepted" class="checkbpx" >&nbsp; Accept Terms and Aggrement
                            </div> 
                            <div class="col-md-12 mt-4">
                              <button type="submit" class="btn btn-dark btn-block" name="register" id="register-btn">Create Account</button>
                            </div> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php' ?>
<script>
    $("#register-btn").hide();
    $('#term').click(function(){
        $("#register-btn").toggle(); 
    })
</script>