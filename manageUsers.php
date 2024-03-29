<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Manage Users</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
</head>

<body style="background-color: #74EBD5; background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%); min-height: 100vh;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 bg-light text-center">
                <h2 class="text-primary fw-bold">Manage All Users</h2>
            </div>

            <div class="col-12 mt-3">
                <div class="row">
                    <div class="offset-0 offset-lg-3 col-12 col-lg-6">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning text-black fw-bold">Search User</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 mt-3 mb-3">
                <div class="row">

                    <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                        <span class="fs-4 fw-bold text-white">#</span>
                    </div>

                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>

                    <div class="col-4 col-lg-2 bg-primary py-2">
                        <span class="fs-4 fw-bold text-white">User Name</span>
                    </div>

                    <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                        <span class="fs-4 fw-bold">Email</span>
                    </div>

                    <div class="col-2 bg-primary py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold text-white">Mobile</span>
                    </div>

                    <div class="col-2 bg-light py-2 d-none d-lg-block">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>

                    <div class="col-2 col-lg-1 bg-white"></div>

                </div>
            </div>

            <?php
            $page_no = 1;

            $user_rs = Database::search("SELECT * FROM `users`");
            $user_num = $user_rs->num_rows;

            $result_per_page = 10;
            $number_of_page = ceil($user_num / $result_per_page);
            $page_first_result = ((int)$page_no - 1) * $result_per_page;

            for ($x = 1; $x <= $user_num; $x++) {
                $user_data = $user_rs->fetch_assoc();
            ?>
                <div class="col-12 mb-3">
                    <div class="row">

                        <div class="col-2 col-lg-1 bg-primary py-2 text-end">
                            <span class="fs-4 fw-bold text-white"><?php echo $x; ?></span>
                        </div>
                        <?php
                        $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='".$user_data["email"]."'");
                        $image_data = $image_rs->fetch_assoc();
                        ?>

                        <div class="col-2 bg-light py-2 d-none d-lg-block" onclick="viewmsgmodel();">
                            <img src="<?php echo $image_data["path"]; ?>" style="height: 40px; margin-left: 80px;" />
                        </div>

                        <div class="col-4 col-lg-2 bg-primary py-2">
                            <span class="fs-4 fw-bold text-white"><?php echo $user_data["lname"]; ?></span>
                        </div>

                        <div class="col-4 col-lg-2 bg-light py-2 d-lg-block">
                            <span class="fs-4 fw-bold"><?php echo $user_data["email"]; ?></span>
                        </div>

                        <div class="col-2 bg-primary py-2 d-none d-lg-block">
                            <span class="fs-4 fw-bold text-white"><?php echo $user_data["mobile"]; ?></span>
                        </div>

                        <div class="col-2 bg-light py-2 d-none d-lg-block">
                            <span class="fs-6 fw-bold"><?php echo $user_data["joined_date"]; ?></span>
                        </div>

                        <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                            <button class="btn btn-danger" onclick="blockProcess();">Block</button>
                        </div>

                    </div>
                </div>
            <?php
            }
            ?>

            <!-- paginations -->
            <div class="col-12 text-center">
                <div class="pagination">
                    <a href="<?php if ($page_no <= 1) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no - 1);
                                } ?>">&laquo;</a>

                    <?php
                    for ($page = 1; $page <= $number_of_page; $page++) {
                        if ($page == $page_no) {
                    ?>
                            <a href="<?php echo "?page" . ($page); ?>" class="active"><?php echo $page; ?></a>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo "?page" . ($page); ?>"><?php echo $page; ?></a>
                    <?php
                        }
                    }
                    ?>

                    <a href="<?php if ($page_no >= $number_of_page) {
                                    echo "#";
                                } else {
                                    echo "?page=" . ($page_no + 1);
                                } ?>">&raquo;</a>
                </div>
            </div>
            <!-- paginations -->


            <!-- modal -->
            <div class="modal" tabindex="-1" id="viewMsgModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">My Messages</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>

                        <div class="modal-body">

                            <!-- record -->
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="col-8 bg-success rounded">
                                        <div class="row">
                                            <div class="col-12 pt-2">
                                                <span class="text-white fs-4">Hello there!!!</span>
                                            </div>
                                            <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6">2022-06-11 | 08:00:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- record -->

                            <!-- send -->
                            <div class="col-12 mt-2">
                                <div class="row">
                                    <div class="offset-4 col-8 bg-success rounded">
                                        <div class="row">
                                            <div class="col-12 pt-2">
                                                <span class="text-white fs-4">How are you!!</span>
                                            </div>
                                            <div class="col-12 text-end pb-2">
                                                <span class="text-white fs-6">2022-06-11 | 08:00:00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- send -->

                        </div>
                        <div class="modal-footer">
                            <div class="col-12">
                                <div class="row">

                                    <div class="col-8">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-4 d-grid">
                                        <button class="btn btn-primary">Send</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- modal -->

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>