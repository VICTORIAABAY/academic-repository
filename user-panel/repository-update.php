<?php
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); 
    include '../config/connection.php';

    if(isset($_POST['update_repname'])) {
        $new_repository_name = mysqli_real_escape_string($connection, $_POST['repname']);
        $repository_id = mysqli_real_escape_string($connection, $_POST['repository']);
        $repository_name = mysqli_real_escape_string($connection, $_POST['old_repository']);

        if(empty($new_repository_name) || empty($repository_id) || empty($repository_name)) {
            $_SESSION['error'] = "All Field are required";
            header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
        }

        else {
            $update_rep_name = mysqli_query($connection, "UPDATE tbl_repository SET reposotory_name = '$new_repository_name'
                WHERE reposotory_name = '$repository_name' AND repository_id = $repository_id ");
            
            if($update_rep_name) {
                $_SESSION['success'] = "Repository name updated successfully from $repository_name to $new_repository_name";
                header("location:repository-item.php?repository=$repository_id&&name=$new_repository_name");
            }
            else {
                $_SESSION['error'] = "sorry repository name not saved may be you enter name that already exist";
                header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
            }
        }
    }


    else if(isset($_POST['change_visibility'])) {
        $visibility = mysqli_real_escape_string($connection, $_POST['visibility']);
        $repository_id = mysqli_real_escape_string($connection, $_POST['repository_id']);
        $repository_name = mysqli_real_escape_string($connection, $_POST['repository_name']);

        if(empty($visibility) || empty($repository_id) || empty($repository_name)) {
            $_SESSION['error'] = "All Field are required";
            header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
        }

        else {
            $update_visibility = mysqli_query($connection, "UPDATE tbl_repository SET visibility = '$visibility'
                WHERE reposotory_name = '$repository_name' AND repository_id = $repository_id ");

                echo $visibility;
            
            if($update_visibility) {
                $_SESSION['success'] = "Repository visibility updated successfully to $visibility";
                header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
            }
            else {
                $_SESSION['error'] = "sorry fail to update repository visibility plaase try again";
                header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
            }
        }
    }