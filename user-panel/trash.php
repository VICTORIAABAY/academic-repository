<?php $title = "Trash"?>
<?php include ('navbar.php')?>
<?php 
    include '../config/connection.php';
    //get public repository
    $trash_query = mysqli_query($connection, "SELECT * FROM tbl_repository WHERE owner =  $user_id AND is_deleted = 1");
    $count_trash = mysqli_num_rows($trash_query);
?>
<?php include('sidebar.php') ?>
    <div class="col-md-9 mt-3">
        <?php include '../config/message.php' ?>
        <div class="row">
            <?php if($count_trash > 0): ?>
                <?php while($trash_fetch = mysqli_fetch_array($trash_query)) { ?>
                    <div class="col-md-12 mt-3">
                        <div class="card card-body shadow">
                            <p><strong>Repository name:</strong> <?php echo $trash_fetch['reposotory_name'] ?></p>
                            <p><strong>Description:</strong> <?php echo $trash_fetch['description'] ?></p>
                            <p><strong>Visibility:</strong> <span class="badge bg-success text-white"><?php echo $trash_fetch['visibility'] ?></span></p>
                            <form action="delete-repository.php" method="post">
                                <input type="number" name="owner" value="<?php echo $user_id ?>" hidden>
                                <input hidden type="number" name="repository_id" value="<?php echo $trash_fetch['repository_id'] ?>">
                                <button type="submit" class="btn btn-danger" name="restore_repository">
                                    Restore this Repository</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="card card-body shadow">
                        <h5>Ooooops! Nothing on trash..</h5>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php include("footer.php") ?>
