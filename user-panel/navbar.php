<?php 
    session_start();
    ini_set('display_errors', 1);//display error
	ini_set('display_startup_errors', 1);//display error
	error_reporting(E_ALL);//display error

    include ('../config/session.php');
    include ('../config/connection.php');
    if(!isset($_SESSION['auth'])) { header("location:../logout.php"); };//check if user loged in

    $repository_list = mysqli_query($connection, "SELECT reposotory_name, repository_id 
    FROM tbl_repository, tbl_user
    WHERE tbl_repository.owner = tbl_user.user_id
    AND tbl_repository.owner = $user_id
    AND tbl_repository.is_deleted = 0");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <!-- logo  -->
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">

    <!-- bxicon -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- bootstrap javascript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <script src="../js/bootstrap.min.js"></script>

</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-dark sticky-top">
    <a class="navbar-brand" href="index.php"> 
        <img src="../img/logo.png" alt="" srcset="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" id="search" type="search" placeholder="Search Repository" aria-label="Search">
        </form>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-light" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link text-light" href="#">Repositories</a>
            </li> -->
            <li class="nav-item">
                <a href="public-repositories.php" class="nav-link text-light" href="#">Others Repository</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>