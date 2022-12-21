<?php
    session_start();
    include ('config/connection.php');

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        //verify if it is empty
        if(empty($username) || empty($password)) {
            $_SESSION['error'] = "All field are required";
            header("location:index.php");
            echo "empty";
        }

        else {
            $login_query = mysqli_query($connection, "SELECT * FROM tbl_user WHERE username = '$username' OR email = '$username'");
            $count_username = mysqli_num_rows($login_query);
            $userdata = mysqli_fetch_array($login_query);

            if($count_username == 1) {
                $password_hash = $userdata['password'];
                $password = password_verify($password, $password_hash);
                if($password) {
                    $_SESSION['auth'] = true;
                    $_SESSION['userDetail'] = $userdata;
                    header("location:user-panel/");
                    echo "success";
                }
                else {
                    $_SESSION['error'] = "Invalid password";
                    header("location:index.php");
                    echo "error 2";
                }
            }

            else {
                $_SESSION['error'] = "Invalid Username or Email";
                header("location:index.php");
                echo "error3";
            }
        }
    }
?>