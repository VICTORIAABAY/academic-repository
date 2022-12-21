<?php $title = "New Repository"?>
<?php  include ('navbar.php')?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <?php include '../config/message.php' ?>
            <h3>Create a new repository</h3>
            <p class="text-secondary">A repository contains all accademic files, including the pastpaper, bookes, links, novels </p>
            <p class="text-secondary">All field with red star(<span class="text-danger">*</span>) are required</p>
            <hr>

            <form action="new-repository-action.php" class="mt-3" method="post">
                <div class="form-row">
                    <div class="col-md-3">
                        <label for="username"><small> Username <strong class="text-danger">*</strong> </small></label>
                        <input required type="text" readonly value="<?php echo $username ?>" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <label for="repository_name"><small> Repository <strong class="text-danger">*</strong> </small></label>
                        <input type="text" name="repository_name" class="form-control" placeholder="Repository Name">
                    </div>
                </div>
                <p class="mt-3 text-muted">
                    <small>Great repository names are short and memorable</small>
                </p>
                <div class="mt-3">
                    <label for=""><small> Description</small> <strong class="text-danger">*</strong></label>
                    <input required type="text" name="description" placeholder="Repository Description" class="form-control">
                </div>
                <hr>
                <div class="mt-3">
                    <div class="d-flex">
                        <input type="radio" value="public" name="availability" id="" class="mt-3" checked>
                        <div>
                            <p class="ml-2 text-muted"><b>Public</b><br>
                            Anyone on the internet can see this repository. You choose who can commit.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <input type="radio" value="private" name="availability" id="" class="mt-3">
                        <div>
                            <p class="ml-2 text-muted"><b>Private</b><br>
                            You allow all other user to see and download it to this repository.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pb-3">
                    <button type="submit" name="create_repository" class="btn btn-dark">Create Repository</button>
                </div>
            </form>
        </div>
    </div>
</div>