<?php $title = "Repository Item"?>
<?php include ('navbar.php')?>
<?php 
    
    if(!isset($_GET['repository']) && !isset($_GET['name'])) {
        header("location:bad-access.php");
    }

    else {

        $repository_name = $_GET['name'];
        $repository_id = $_GET['repository'];

        $repository_item_sql = "SELECT category_name, tbl_repository_item.*, username, visibility, tbl_repository.description, tbl_repository.data_created 
        FROM tbl_repository, tbl_repository_item, tbl_user, tbl_category 
        WHERE tbl_repository.owner = tbl_user.user_id
        AND tbl_repository_item.repository = tbl_repository.repository_id
        AND tbl_category.category_id = tbl_repository_item.repository_item_category
        AND tbl_repository.owner = $user_id
        AND tbl_repository_item.repository = $repository_id
        AND tbl_repository.is_deleted = 0";

        // $repository = "SELECT is_deleted FROM tbl_repository WHERE is_deleted = 0 AND repository_id = $repository_id";

        $repository_item_query = mysqli_query($connection, $repository_item_sql);//excecute sql  for repository item
        $count_repository_item = mysqli_num_rows($repository_item_query);

        $repository_query = mysqli_query($connection, $repository_item_sql);//excecute sql for repository
        $count_repository = mysqli_num_rows($repository_item_query);

        if($count_repository < 0) {
            $_SESSION['error'] = "this repository is already deleted";
            header("location:index.php");
        }

        $category_query = mysqli_query($connection, "SELECT * FROM tbl_category");
        $count_category = mysqli_num_rows($category_query);
    }
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-3 border pt-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <a href="" class="btn btn-success btn-sm mr-3">Home</a>
                    <a href="" class="btn btn-dark btn-sm mr-3" data-target="#changeRepName" data-toggle="modal">
                        Change Repository Name</a>
                    <a href="" class="btn btn-warning btn-sm mr-3" data-target="#changeRepVisibility" data-toggle="modal">
                        Change Repository Visibility</a>
                    <a href="" class="btn btn-danger btn-sm mr-3" data-target="#DeleteRepository" data-toggle="modal">
                        Delete Repository</a>    
                </div>
                <div>
                    <a href="" class="btn btn-dark-c btn-sm" data-target="#new_item" data-toggle="modal">New Item</a>
                </div>
            </div>
            <hr>
            <?php include '../config/message.php' ?>
            <h5 class="text-muted">You are now in <strong><?php echo $username ?> / <?php echo $repository_name ?></strong> Repository</h5>
            <span><i class="bx bx-file bx-sm text-primary"></i> 3</span>
            <span class="ml-3"><i class="bx bx-file bx-sm text-danger"></i> 3</span>
            <span class="ml-3"><i class="bx bx-file bx-sm text-warning"></i> 3</span>
            <?php if($count_repository_item > 0): ?>
                <table class="table">
                    <?php $i = 1; while($repository_item_row = mysqli_fetch_array($repository_item_query)){ ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td class="text-muted">
                                <a href="files/<?php echo $repository_item_row['file'] ?>">
                                    <?php echo $repository_item_row['file'] ?>
                                </a>
                            </td>
                            <td class="text-muted"><?php echo $repository_item_row['commit'] ?></td>
                            <td class="text-muted"><?php echo $repository_item_row['category_name'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php else: ?>
                <h6 class="text-danger">You Don't Have any item to this repository</h6>
            <?php endif ?>
        </div>
    </div>
    <!-- NEW ITEM MODAL  -->
    <div class="modal fade" id="new_item" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5>New Repository Item</h5>
                </div>
                <div class="modal-body">
                    <form action="repository-item-action.php" method="post" enctype="multipart/form-data">
                        <div class="mt-3">
                            <input type="text" name="repository_id" value="<?php echo $repository_id ?>" hidden required>
                            <input type="text" name="repository_name" value="<?php echo $repository_name ?>" hidden required>
                        </div>
                        <div class="mt-3">
                            <input type="text" name="commit" placeholder="Write your Commit" class="form-control" required>
                        </div>
                        <div class="mt-3">
                            <select name="category" class="form-control">
                                <?php if($count_category < 1): ?>
                                    <option value="">No category right now</option>
                                <?php else: ?>
                                    <option value="">----Select category----</option>
                                    <?php while($category_item = mysqli_fetch_array($category_query)){ ?>
                                        <option value="<?php echo $category_item['category_id'] ?>">
                                            <?php echo $category_item['category_name'] ?>
                                        </option>
                                    <?php } ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="mt-3">
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="mt-3">
                            <button type="submit" name="save_item" class="btn btn-dark-c btn-block">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- change repository name modal -->
<div class="modal fade" id="changeRepName">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Change Repository Name</h4>
            </div>
            <div class="modal-body">
                <p>You are about to update <b class="text-danger"><?php echo $_GET['name'] ?></b></p>
                <form action="repository-update.php" method="post">
                    <input hidden type="number" name="repository" value="<?php echo $_GET['repository'] ?>">
                    <input hidden type="text" name="old_repository" value="<?php echo $_GET['name'] ?>">
                    <input type="text" name="repname" placeholder="Enter New Repository Name" class="form-control" required>
                    <div class="mt-3">
                        <button type="submit" name="update_repname" class="btn btn-dark-c btn-block">Change Repository Name</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- change repository modal -->
<div class="modal fade" id="changeRepVisibility">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Change visibility</h4>
            </div>
            <div class="modal-body">
                <p>You are about to change <b class="text-danger"><?php echo $_GET['name'] ?></b> visibility</p>
                <form action="repository-update.php" method="post">
                    <input hidden type="number" name="repository_id" value="<?php echo $_GET['repository'] ?>">
                    <input hidden type="text" name="repository_name" value="<?php echo $_GET['name'] ?>">
                    <div class="d-flex">
                        <input type="radio" value="public" name="visibility" id="" class="mt-3" checked>
                        <div>
                            <p class="ml-2 text-muted"><b>Public</b><br>
                            Anyone on the internet can see this repository. You choose who can commit.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <input type="radio" value="private" name="visibility" id="" class="mt-3">
                        <div>
                            <p class="ml-2 text-muted"><b>Private</b><br>
                            You allow all other user to see and download it to this repository.</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="change_visibility" class="btn btn-dark-c btn-block">Change Visibility</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- change repository modal -->
<div class="modal fade" id="DeleteRepository">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Delete repository</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete <b class="text-danger"><?php echo $_GET['name'] ?></b>.Are you sure you want to delete 
                    this repository</p>
                <form action="delete-repository.php" method="post">
                    <input hidden type="number" name="repository_id" value="<?php echo $_GET['repository'] ?>">
                    <input hidden type="number" name="owner" value="<?php echo $user_id ?>">
                    <input hidden type="text" name="repository_name" value="<?php echo $_GET['name'] ?>">
                    <div class="mt-3">
                        <button type="submit" name="delete_repository" class="btn btn-dark-c btn-block">Yes Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>