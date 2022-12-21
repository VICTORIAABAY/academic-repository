<?php 
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);  

    include ('config/connection.php');

    if(isset($_POST['register'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $sex = $_POST['sex'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $term = $_POST['term'];
        $password = $_POST['password'];
        $confirm_passowrd = $_POST['confirm_passowrd'];

        // check if terms is accepted
        if(empty($term)) {
            $_SESSION['warning'] = "Accept term and aggrement first";
            header("location:new-account.php");
        }
        else {
            // check if username already exist in the database
            $check_username_query = mysqli_query($connection, "SELECT username FROM tbl_user WHERE username = '$username'");
            $count_username = mysqli_num_rows($check_username_query);

            if($count_username > 0) {
                $_SESSION['warning'] = "Username already Exist try another one";
                header("location:new-account.php");
            }

            else {
                // check if phone already exist in the database
                $check_phone_query = mysqli_query($connection, "SELECT phone FROM tbl_user WHERE phone = '$phone'");
                $count_phone = mysqli_num_rows($check_phone_query);

                if($count_phone > 0) {
                    $_SESSION['warning'] = "Phone already Exist try another one";
                    header("location:new-account.php");
                }

                else {
                    // check if phone already exist in the database
                    $check_email_query = mysqli_query($connection, "SELECT email FROM tbl_user WHERE email = '$email'");
                    $count_email = mysqli_num_rows($check_email_query);

                    if($count_email > 0) {
                        $_SESSION['warning'] = "Email already Exist try another one";
                        header("location:new-account.php");
                    }

                    else {
                        if(strlen($password) < 8) {
                            $_SESSION['error'] = "Password must have atleast 8 character";
                            header("location:new-account.php");
                        }
                        else if($password != $confirm_passowrd) {
                            $_SESSION['error'] = "Password And Confirm Password must metch";
                            header("location:new-account.php");
                        }
                        
                        else {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $token = rand(11233445, 9909484938);

                            $save_user_sql = "INSERT 
                                INTO tbl_user(first_name, last_name, sex, email, phone, username, password, token)
                                VALUES ('$first_name','$last_name', '$sex', '$email',' $phone', '$username', '$password', '$token')";
                            $save_user_query = mysqli_query($connection, $save_user_sql);

                            if($save_user_query) {
                                $user_login_query =  mysqli_query($connection, "SELECT * FROM tbl_user WHERE username = '$username'");
                                $count_user_row = mysqli_num_rows($user_login_query);
                                if($count_user_row == 1) {
                                    $_SESSION['auth'] = true;
                                    $_SESSION['userDetail'] = mysqli_fetch_assoc($user_login_query);
                                    header("location:user-panel/");
                                }
                                else {
                                    $_SESSION['error'] = "registration fail due to server error try again";
                                    header("location:new-account.php");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
?>