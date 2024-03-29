<?php
session_start();
$page_title = "Admin Panel"
?>
<?php include('includes/header.php'); ?>
<?php require "connection.php"; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-2">
            <div class="row">

                <div class="align-items-start bg-dark col-12">
                    <div class="row g-1 text-center">

                        <div class="col-12 mt-5">
                            <h4 class="text-white"><?php echo "Tharindu Geeshan" ?></h4>
                            <hr class="border border-1 border-white">
                        </div>

                        <div class="nav flex-column nav-pills me-3 mt-3">
                            <nav class="nav flex-column">
                                <a class="nav-link fs-5 active" href="#">Dashboard</a>
                                <a class="nav-link fs-5" href="manageUsers.php">Manage Users</a>
                                <a class="nav-link fs-5" href="manageProducts.php">Manage Product</a>
                            </nav>
                        </div>

                        <div class="col-12 mt-3">
                            <hr class="border border-1 border-white">
                            <a href="sellingHistory.php" class="text-decoration-none">
                                <h4 class="text-white">Selling History</h4>
                            </a>
                            <hr class="border border-1 border-white">
                        </div>

                        <div class="col-12 mt-3 d-grid">
                            <h5 class="text-white fw-bold">From Date</h5>
                            <input type="date" class="form-control">
                            <h5 class="text-white fw-bold">To Date</h5>
                            <input type="date" class="form-control">
                            <a href="#" class="btn btn-primary fw-bold mt-2">View Selling</a>
                            <hr class="border border-1 border-white">
                            <hr class="border border-1 border-white">
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-10">
            <div class="row">

                <div class="col-12 text-white fw-bold mb-3 mt-2">
                    <h2 class="fw-bold">Dashboard</h2>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12">
                    <div class="row g-1">

                        <div class="col-6 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 bg-primary text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Daily Earnings</span>
                                    <br />

                                    <?php
                                    $today = date("Y-m-d");
                                    $this_month = date("m");
                                    $this_year = date("Y");

                                    $a = "0";
                                    $b = "0";
                                    $c = "0";
                                    $d = "0";
                                    $e = "0";

                                    $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                    $invoice_num = $invoice_rs->num_rows;

                                    for ($x = 0; $x < $invoice_num; $x++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        $e = $e + $invoice_data["qty"];
                                        $f = $invoice_data["date"];
                                        $split_date = explode(" ", $f);
                                        $pdate = $split_date[0];

                                        if ($pdate == $today) {
                                            $a = $a + $invoice_data["total"];
                                            $c = $c + $invoice_data["qty"];
                                        }

                                        $split_result = explode("-", $pdate);
                                        $pyear = $split_result[0];
                                        $pmonth = $split_result[1];

                                        if ($pyear == $this_year) {
                                            if ($pmonth == $this_month) {
                                                $b = $b + $invoice_data["total"];
                                                $d = $d + $invoice_data["qty"];
                                            }
                                        }
                                    }
                                    ?>

                                    <span class="fs-5">Rs. <?php echo $a ?> .00</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-6 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 bg-white text-dark text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Monthly Earnings</span>
                                    <br />
                                    <span class="fs-5">Rs. <?php echo $b ?> .00</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-6 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 bg-dark text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Total Sellings</span>
                                    <br />
                                    <span class="fs-5"><?php echo $c ?> Items</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-6 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Monthly Sellings</span>
                                    <br />
                                    <span class="fs-5"><?php echo $d ?> Items</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-6 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 bg-success text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Total Sellings</span>
                                    <br />
                                    <span class="fs-5"><?php echo $e ?> Items</span>
                                </div>

                            </div>
                        </div>

                        <div class="col-6 col-lg-4 px-1">
                            <div class="row g-1">

                                <div class="col-12 bg-danger text-white text-center rounded" style="height: 100px;">
                                    <br />
                                    <span class="fs-4 fw-bold">Total Engagements</span>
                                    <br />
                                    <?php
                                    $user_rs = Database::search("SELECT * FROM `users`");
                                    $user_num = $user_rs->num_rows;

                                    ?>
                                    <span class="fs-5"><?php echo $user_num ?> Members</span>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-12 bg-dark">
                    <div class="row">

                        <div class="col-12 col-lg-2 text-center mt-3 mb-3">
                            <label class="form-label fs-3 fw-bold text-white">Total Active Time</label>
                        </div>

                        <?php
                        $start_date = new DateTime("2022-07-01 00:00:00");

                        $date = new DateTime();
                        $tz = new DateTimeZone("Asia/Colombo");
                        $date->setTimeZone($tz);

                        $end_date = new DateTime($date->format("Y-m-d H:i:s"));

                        $difference = $end_date->diff($start_date);
                        ?>

                        <div class="col-12 col-lg-10 text-end mt-3 mb-3">
                            <label class="form-label fs-4 fw-bold text-white">
                                <?php
                                echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                    $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                    $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                ?>
                            </label>

                        </div>

                    </div>
                </div>

                <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                    <div class="row g-1">

                        <div class="col-12 text-center">
                            <label class="form-label fw-bold fs-4">Mostly Sold Items</label>
                        </div>

                        <?php
                        $today = date("Y-m-d");
                        $freq_rs = Database::search("SELECT `product_id`, COUNT(`product_id`) AS `value_occurrence` 
                            FROM `invoice` GROUP BY `product_id` ORDER BY `value_occurrence` DESC LIMIT 1");

                        $freq_num = $freq_rs->num_rows;

                        if ($freq_num > 0) {
                            $freq_data = $freq_rs->fetch_assoc();

                            $proimg = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $freq_data["product_id"] . "'");
                            $code = $proimg->fetch_assoc();

                            $productDetails = Database::search("SELECT * FROM `product`
                                WHERE `id` = '" . $freq_data["product_id"] . "'");
                            $pdetails = $productDetails->fetch_assoc();

                            $qtyrs = Database::search("SELECT SUM(`qty`) AS `total` FROM `invoice`
                                WHERE `product_id` = '" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                            $qtytotal = $qtyrs->fetch_assoc();

                        ?>

                            <div class="col-12 text-center">
                                <img src="<?php echo $code["code"]; ?>" class="img-fluid rounded-top" style="height: 250px;">
                                <hr>
                            </div>

                            <div class="col-12 text-center">
                                <span class="fs-6"><?php echo $pdetails["title"]; ?></span>
                                <br>
                                <span class="fs-6"><?php echo $qtytotal["total"]; ?></span>
                                <br>
                                <span class="fs-6"><?php echo $pdetails["price"]; ?></span>
                                <br>
                            </div>



                            <div class="col-12 mb-2">
                                <div class="first_place"></div>
                            </div>

                    </div>
                </div>

                <div class="offset-1 col-10 col-lg-4 mt-3 mb-3 rounded bg-light">
                    <div class="row g-1">

                        <div class="col-12 text-center">
                            <label class="form-label fs-4 fw-bold">Most Famous Seller</label>
                        </div>

                        <?php
                            $prfileimg = Database::search("SELECT * FROM `profile_image`
                            WHERE `users_email`='" . $pdetails["users_email"] . "'");
                            $pcode = $prfileimg->fetch_assoc();

                            $userDetails = Database::search("SELECT * FROM `users`
                            WHERE `email`='" . $pdetails["users_email"] . "'");
                            $udetails = $userDetails->fetch_assoc();
                        ?>

                        <div class="col-12 text-center">
                            <img src="<?php echo $pcode["path"]; ?>" class="img-fluid" style="height: 250px;">
                            <hr>
                        </div>

                        <div class="col-12 text-center">
                            <span class="fs-5 fw-bold">
                                <?php echo $udetails["fname"] . " " . $udetails["lname"]; ?>
                            </span>
                            <br />
                            <span class="fs-6"><?php echo $pdetails["users_email"] ?></span>
                            <br />
                            <span class="fs-6"><?php echo $udetails["mobile"] ?></span>
                            <br />
                        </div>

                        <div class="col-12 mb-2">
                            <div class="first_place"></div>
                        </div>

                    </div>
                </div>

            <?php
                        }
            ?>

            </div>
        </div>

    </div>
</div>


<script src="script.js"></script>
</body>

</html>