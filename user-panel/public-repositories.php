<?php $title = "Trash"?>
<?php include ('navbar.php')?>
<?php 
    include '../config/connection.php';
    //get public repository
    $public_repository_query = mysqli_query($connection, "SELECT reposotory_name, repository_id, description, username 
        FROM tbl_repository, tbl_user WHERE tbl_user.user_id = tbl_repository.owner
        AND owner !=  $user_id AND visibility = 'public'");
    $count_public_repository = mysqli_num_rows($public_repository_query);
?>
<?php include('sidebar.php') ?>
    <div class="col-md-9 mt-3">
        <?php include '../config/message.php' ?>
        <div class="row">
            <?php if($count_public_repository > 0): ?>
                <?php while($public_repository_fetch = mysqli_fetch_array($public_repository_query)) { ?>
                    <div class="col-md-12">
                        <div class="card card-body shadow">
                            <p><strong>Repository name:</strong> <?php echo $public_repository_fetch['reposotory_name'] ?></p>
                            <p><strong>Description:</strong> <?php echo $public_repository_fetch['description'] ?></p>
                            <div>
                                <button type="button" class="btn btn-outline-dark"    
                                    data-target="#item<?php echo $public_repository_fetch['repository_id'] ?>" data-toggle="modal">
                                    View Reposotory Item
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php  
                        $repository_id = $public_repository_fetch['repository_id'];
                        $repository_item_sql = "SELECT category_name, tbl_repository_item.*, username, visibility, tbl_repository.description, tbl_repository.data_created 
                        FROM tbl_repository, tbl_repository_item, tbl_user, tbl_category 
                        WHERE tbl_repository.owner = tbl_user.user_id
                        AND tbl_repository_item.repository = tbl_repository.repository_id
                        AND tbl_category.category_id = tbl_repository_item.repository_item_category
                        AND tbl_repository.owner != $user_id
                        AND tbl_repository_item.repository = $repository_id
                        AND tbl_repository.is_deleted = 0";

                        // $repository = "SELECT is_deleted FROM tbl_repository WHERE is_deleted = 0 AND repository_id = $repository_id";

                        $repository_item_query = mysqli_query($connection, $repository_item_sql);//excecute sql  for repository item
                        $count_repository_item = mysqli_num_rows($repository_item_query);
                    ?>
                    <div class="modal fade" id="item<?php echo $repository_id ?>">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h4 class="text-light"><?php echo $public_repository_fetch['reposotory_name'] ?></h4>
                                </div>
                                <div class="modal-body">
                                    <?php if($count_repository_item > 0): ?>
                                        <table class="table">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Item Name</th>
                                                <th>Commit</th>
                                                <th>Category</th>
                                            </tr>
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
                                        Repository is empty
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="card card-body shadow">
                        <h5>Ooooops! No public repository yet..</h5>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </div>
<?php include("footer.php") ?>
