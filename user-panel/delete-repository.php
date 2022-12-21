<?php
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); 
    include '../config/connection.php';

    if(isset($_POST['delete_repository'])) {
        $owner = mysqli_real_escape_string($connection, $_POST['owner']);
        $repository_id = mysqli_real_escape_string($connection, $_POST['repository_id']);
        $repository_name = mysqli_real_escape_string($connection, $_POST['repository_name']);
        

        if(empty($owner) || empty($repository_id)) {
            $_SESSION['error'] = "All Field are required";
            header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
        }

        else {
            $delete_repository = mysqli_query($connection, "UPDATE tbl_repository SET is_deleted = 1
                WHERE reposotory_name = '$repository_name' AND repository_id = $repository_id ");
            
            if($delete_repository) {
                $_SESSION['success'] = "$repository_name deleted successfully";
                header("location:index.php");
            }
            else {
                $_SESSION['error'] = "Fail to delete repository";
                header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
            }
        }
    }

    elseif(isset($_POST['restore_repository'])) {
        $owner = mysqli_real_escape_string($connection, $_POST['owner']);
        $repository_id = mysqli_real_escape_string($connection, $_POST['repository_id']);

        if(empty($owner) || empty($repository_id)) {
            $_SESSION['error'] = "All Field are required";
            header("location:trash.php");
        }

        else {
            $restore_repository = mysqli_query($connection, "UPDATE tbl_repository SET is_deleted = 0
                WHERE owner = $owner AND repository_id = $repository_id ");
            
            if($restore_repository) {
                $_SESSION['success'] = "$repository_name Rostored successfully";
                header("location:trash.php");
            }
            else {
                $_SESSION['error'] = "Fail to restore repository";
                header("location:trash.php");
            }
        }
    }

