<?php 
session_start();
$page_title = "Sign In"
?>
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6    ">
                <div class="card shadow">
                    <div class="card-header">
                        <h1>Log In </h1>
                        <h5>Before you Set the stage for your shopping adventure </h5>
                        
                    </div>
                    <div class="card-body">
                    <form action="">                            
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="text" name="pw" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>