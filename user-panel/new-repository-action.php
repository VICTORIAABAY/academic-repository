<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);  

    include ('../config/connection.php');
    include ('../config/session.php');

    if(isset($_POST['create_repository'])) {
        $repository_name = $_POST['repository_name'];
        $description = $_POST['description'];
        $availability = $_POST['availability'];

        if(empty($availability)) {
            $_SESSION['warning'] = "Availability must be selected";
            header("location:new-repository.php");
        }

        else {
            // check if reposotory_name already exist in the database
            $check_repository_name_query = mysqli_query($connection, "SELECT reposotory_name 
                FROM tbl_repository WHERE reposotory_name = '$repository_name'");
            $count_repository_name = mysqli_num_rows($check_repository_name_query);

            if($count_repository_name > 0) {
                $_SESSION['warning'] = "Reposotory Name already Exist try another one";
                header("location:new-repository.php");
            }

            else {
                $save_reposotory_query = mysqli_query($connection, "INSERT INTO 
                    tbl_repository(reposotory_name, visibility, description, owner)
                    VALUE ('$repository_name', '$availability', '$description', '$user_id')"); 

                if($save_reposotory_query) {
                    $_SESSION['success'] = "Reposotory $repository_name Save successfully";
                    header("location:new-repository.php");
                }
                else {
                    $_SESSION['error'] = "Reposotory $repository_name not Save successfully";
                    header("location:new-repository.php");
                }
            }
        }
    }

?>