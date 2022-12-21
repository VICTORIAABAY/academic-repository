<?php
    session_start();
    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); 
    include '../config/connection.php';

    if(isset($_POST['save_item'])) {
        $commit = mysqli_real_escape_string($connection, $_POST['commit']);
        $repository_id = mysqli_real_escape_string($connection, $_POST['repository_id']);
        $repository_name = mysqli_real_escape_string($connection, $_POST['repository_name']);
        $category = mysqli_real_escape_string($connection, $_POST['category']);

        // file recieve
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];

        $file_extention = explode('.', $_FILES['file']['name']);//take extantion and take it in small letter
        $file_extention = end($file_extention);

        $allowed_extention = array("pdf", "docx", "odt", "ppt");// allowed extention

        if(!in_array($file_extention, $allowed_extention )) {
            $_SESSION['error'] = "Allowed extentions are ppt, odt, docx, pdf";
            header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
        }

        else if(empty($commit) || empty($category) || empty($repository_name)){
            $_SESSION['error'] = "All field are Required";
            header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
        }

        else if($file_size > 2097152){
            $_SESSION['error'] = 'File size must be excately 2 MB';
            header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
        }

        else {
            if(move_uploaded_file($file_tmp, "files/".$file_name)) {
                $save_item_sql = "INSERT 
                    INTO tbl_repository_item(commit, file, file_type, repository_item_category, repository)
                    VALUES ('$commit', '$file_name', '$file_extention', '$category', '$repository_id')";
                $excecute_item_query = mysqli_query($connection, $save_item_sql);
                if($excecute_item_query) {
                    $_SESSION['success'] = "New Repository Item saved on repository $repository_name with the commit $commit";
                    header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
                }
                else {
                    $_SESSION['error'] = "File uploaded but not saved";
                    header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
                }
            }
            else {
                $_SESSION['error'] = "File not uploaded try again";
                // echo "error ";
                header("location:repository-item.php?repository=$repository_id&&name=$repository_name");
            }
        }
    }

    else {
        header("location:../logout.php");
        echo "bad access";
    }

?>