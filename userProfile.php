
<?php
session_start();
$page_title = "Sign In"
?>
<?php include('includes/header.php'); ?>
<?php include('includes/navbar.php'); ?>


    <div class="container-fluid">
        <div class="row">

           

            <?php
            require "connection.php";

            if (isset($_SESSION["u"])) {
                $email = $_SESSION["u"]["email"];

                $resultset = Database::search("SELECT * FROM `users` 
                INNER JOIN`profile_image` ON 
                `users`.`email`=`profile_image`.`users_email` 
                INNER JOIN user_address ON `users`.`email`=`user_address`.user_email 
                INNER JOIN `city` ON `user_address`.`city_id`=`city`.`id`
                INNER JOIN district ON `city`.`district_id`=`district`.`id` 
                INNER JOIN province ON `district`.`province_id`=`province`.`id` 
                INNER JOIN`gender` ON `gender`.`id`=`users`.`gender_id`
                WHERE `users`.`email` = '" . $email . "'");

                $n = $resultset->num_rows;
                $d = $resultset->fetch_assoc();

            ?>

                <div class="col-12 bg-body rounded mt-4 mb-4">
                    <div class="row g-2">

                        <div class="col-md-3 border-end">
                            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                <?php

                                if ($d["path"] == null) {
                                ?>
                                    <img id="viewimg" src="resources//profile_img//user_icon.svg" class="rounded mt-5" style="width: 150px;">
                                <?php
                                } else {
                                ?>
                                    <img id="viewimg" src="<?php echo $d["path"] ?>" class="rounded mt-5" style="width: 150px;">
                                <?php
                                }

                                ?>

                                <span class="fw-bold"><?php echo $d["fname"] ?> <?php echo $d["lname"] ?></span>
                                <span class="text-black-50"><?php echo $d["email"] ?></span>

                                <input class="d-none" type="file" accept="img/*" id="profileimg" onclick="changeImage();">
                                <label class="btn btn-primary mt-5" for="profileimg">Update Profile Image</label>

                            </div>
                        </div>

                        <div class="col-md-5 border-end">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="fw-bold">Profile Settings</h4>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" id="fn" class="form-control" value="<?php echo $d["fname"] ?>">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" id="ln" class="form-control" value="<?php echo $d["lname"] ?>">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Mobile</label>
                                        <input type="text" id="mo" class="form-control" value="<?php echo $d["mobile"] ?>">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Password</label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" aria-describedby="viewpassword" id="pwtxt" value="<?php echo $d["password"] ?>"" disabled>
                                            <button class=" btn btn-outline-primary" id="viewpassword" onclick="viewpw();" id="pwbtn"><i class="bi bi-eye-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="<?php echo $d["email"] ?>" readonly />
                                    </div>

                                    <div class="col-md-12 mt-1">
                                        <label class="form-label">Registered Date</label>
                                        <input type="text" class="form-control" value="<?php echo $d["joined_date"] ?>" readonly />
                                    </div>

                                    <?php
                                    if (!empty($d["line1"])) {
                                    ?>
                                        <div class="col-md-12 mt-1">
                                            <label class="form-label">Address Line 01</label>
                                            <input type="text" id="l1" class="form-control" value="<?php echo $d["line1"] ?>">
                                        </div>
                                    <?php

                                    } else {
                                    ?>
                                        <div class="col-md-12 mt-1">
                                            <label class="form-label">Address Line 01</label>
                                            <input type="text" id="l1" class="form-control" placeholder="Enter Address Line 01">
                                        </div>
                                    <?php
                                    }


                                    if (!empty($d["line2"])) {
                                    ?>
                                        <div class="col-md-12 mt-1">
                                            <label class="form-label">Address Line 02</label>
                                            <input type="text" id="l2" class="form-control" value="<?php echo $d["line2"] ?>">
                                        </div>
                                    <?php

                                    } else {
                                    ?>
                                        <div class="col-md-12 mt-1">
                                            <label class="form-label">Address Line 02</label>
                                            <input type="text" id="l2" class="form-control" placeholder="Enter Address Line 02">
                                        </div>
                                    <?php
                                    }
                                    $provincers = Database::search("SELECT * FROM `province`");
                                    $districtrs = Database::search("SELECT * FROM `district`");
                                    $cityrs = Database::search("SELECT * FROM `city`");
                                    ?>



                                    <div class="col-md-6 mt-1">
                                        <label class="form-label">Province</label>
                                        <select class="form-select" id="pr">

                                            <option value="0">Select Province</option>

                                            <?php

                                            $pn = $provincers->num_rows;
                                            for ($x = 0; $x < $pn; $x++) {
                                                $pd = $provincers->fetch_assoc();


                                            ?>
                                                <option value="<?php echo $pd["id"]; ?>" <?php
                                                                                            if ($pd["id"] == $d["province_id"]) {
                                                                                            ?> selected <?php
                                                                                                    }
                                                                                                        ?>><?php echo $pd["name"]; ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label class="form-label">District</label>
                                        <select class="form-select" id="dr">
                                            <option value="0">Select District</option>
                                            <?php

                                            $dn = $districtrs->num_rows;
                                            for ($x = 0; $x < $dn; $x++) {
                                                $dd = $districtrs->fetch_assoc();


                                            ?>
                                                <option value="<?php echo $dd["id"] ?>" <?php
                                                                                        if ($dd["id"] == $d["district_id"]) {
                                                                                        ?> selected <?php
                                                                                                }
                                                                                                    ?>><?php echo $dd["name"] ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label class="form-label">City</label>
                                        <select class="form-select" id="ci">
                                            <option value="0">Select City</option>

                                            <?php

                                            $cn = $cityrs->num_rows;
                                            for ($x = 0; $x < $cn; $x++) {
                                                $cd = $cityrs->fetch_assoc();


                                            ?>
                                                <option value="<?php echo $cd["id"] ?>" <?php
                                                                                        if ($cd["id"] == $d["city_id"]) {
                                                                                        ?> selected <?php
                                                                                                }
                                                                                                    ?>><?php echo $cd["name"] ?></option>

                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-1">
                                        <label class="form-label">Postal Code</label>
                                        <?php
                                        if (!empty($d["postal_code"])) {
                                        ?>
                                            <input id="pc" type="text" class="form-control" value="<?php echo $d["postal_code"] ?>">
                                        <?php
                                        } else {
                                        ?>
                                            <input id="pc" type="text" class="form-control" placeholder="Postal Code">
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-md-12 mt-1">
                                        <label class="form-label">Gender</label>
                                        <input type="text" class="form-control" value="<?php echo $d["gender_name"]; ?>" readonly />
                                    </div>

                                    <div class="col-md-12 d-grid mt-3 mb-3">
                                        <button class="btn btn-primary" onclick="update_profile();">Update My Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php require "footer.php"; ?>

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>

<?php
            } else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
            }
?>