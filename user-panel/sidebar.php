<div class="row container-fluid">
    <div class="col-md-3 bg-white height border-left-primary border-right-primary">
        <div class="header p-3">
            <h6>Welcome <strong><?php echo $_SESSION['userDetail']['username'] ?></strong></h6>
            <hr>
        </div>
        <div class="pl-2">
            <div class="d-flex justify-content-between">
                <div>
                    <h6><strong>Current Repository</strong></h6>
                </div>
               <div class="mt-n-1">
                    <a href="new-repository.php" class="btn btn-dark-c btn-sm">New <i class="bx bx-book-add"></i></a>
               </div>
            </div>
            <div class="search mt-2">
                <input type="text" name="search" placeholder="Search Repository" class="form-control input-transparent">
            </div>
            <div class="mt-3">
                <ul class="list-unstyled">
                    <?php while($repo_item = mysqli_fetch_array($repository_list)) { ?>
                    <li class="text-secondary">
                        <div class="d-flex">
                            <div class="repository-img">
                                <img src="../img/logo.png" alt="">
                            </div>
                            <a href="repository-item.php?repository=<?php  echo $repo_item['repository_id'] ?>&&name=<?php  echo $repo_item['reposotory_name'] ?>">
                                <small>
                                    <?php echo $username ?>/<?php echo $repo_item['reposotory_name'] ?>
                                </small>
                            </a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>