<?php $title = "Dashboard"?>
<?php include ('navbar.php')?>
<?php 
    include '../config/connection.php';
    //get public repository
    $public_query = mysqli_query($connection, "SELECT count(repository_id) AS total 
        FROM tbl_repository WHERE owner =  $user_id AND visibility = 'public' AND is_deleted = 0");
    $public_fetch = mysqli_fetch_array($public_query);
    $public_repository = $public_fetch['total'];

    //get private repository
    $private_query = mysqli_query($connection, "SELECT count(repository_id) AS total 
    FROM tbl_repository WHERE owner =  $user_id AND visibility = 'private' AND is_deleted = 0");
    $private_fetch = mysqli_fetch_array($private_query);
    $private_repository = $private_fetch['total'];

    //get public repository
    $trash_query = mysqli_query($connection, "SELECT count(repository_id) AS total 
    FROM tbl_repository WHERE owner =  $user_id AND is_deleted = 1");
    $trash_fetch = mysqli_fetch_array($trash_query);
    $trash_repository = $trash_fetch['total'];

?>
<?php include('sidebar.php') ?>
    <div class="col-md-9 mt-3">
        <?php include '../config/message.php' ?>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body border-right-primary-3">
                        <h6>Public Repository</h6>
                        <div class="d-flex justify-content-between">
                            <i class='bx bx-share-alt bx-lg text-success'></i>
                            <span class="h3 text-yellow"><strong><?php echo $public_repository ?></strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body border-right-primary-3">
                        <h6>Private Repository</h6>
                        <div class="d-flex justify-content-between">
                            <i class='bx bxs-lock-alt bx-lg text-success'></i>
                            <span class="h3 text-yellow"><strong><?php echo $private_repository ?></strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <a href="trash.php" style="text-decoration: none;">
                    <div class="card">
                        <div class="card-body border-right-primary-3">
                            <h6>Trash Repository</h6>
                            <div class="d-flex justify-content-between">
                                <i class='bx bx-trash-alt bx-lg text-success'></i>
                                <span class="h3 text-yellow"><strong><?php echo $trash_repository ?></strong></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php include("footer.php") ?>
