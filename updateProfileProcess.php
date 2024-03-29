<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {
    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["m"];
    $line1 = $_POST["li1"];
    $line2 = $_POST["li2"];
    $province = $_POST["pr"];
    $district = $_POST["dr"];
    $city = $_POST["ci"];
    $postal_code = $_POST["pc"];


    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg");
        $file_ex = $image["type"];

        if (!in_array($file_ex, $allowed_image_extentions)) {

            echo "Please select a valid image";
        } else {

            $new_image_extention;

            if ($file_ex == "image/jpg") {
                $new_image_extention = ".jpg";
            } else if ($file_ex == "image/jpeg") {
                $new_image_extention = ".jpeg";
            } else if ($file_ex == "image/png") {
                $new_image_extention = ".png";
            } else if ($file_ex == "image/svg+xml") {
                $new_image_extention = ".svg";
            }

            $file_name = "resources//profile_img//" . uniqid() . $new_image_extention;

            move_uploaded_file($image["tmp_name"], $file_name);

            $profile_pic_rs = Database::search("SELECT * FROM `profile_image` WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");
            $profile_pic_num = $profile_pic_rs->num_rows;

            if ($profile_pic_num == 1) {
                Database::iud("UPDATE `profile_image` SET `path`='" . $file_name . "' WHERE `users_email`='" . $_SESSION["u"]["email"] . "'");
                //echo "Profile picture updated Successfully.";
            } else {
                Database::iud("INSERT INTO `profile_image` (`path`,`users_email`) VALUES ('" . $file_name . "', '" . $_SESSION["u"]["email"] . "')");

                //echo "New Profile Picture added Successfilly.";


            }
        }
    } else {
    }
    Database::iud("UPDATE `users` SET 
        `fname`='" . $fname . "',
        `lname`='" . $lname . "',
        `mobile`='" . $mobile . "'
        WHERE `email`='" . $_SESSION["u"]["email"] . "'");

    $address_rs = Database::search("SELECT * FROM `user_address` WHERE 
                `user_email`='" . $_SESSION["u"]["email"] . "'");
    $address_num = $address_rs->num_rows;
    if ($address_num == 1) {
        Database::iud("UPDATE `user_address` SET 
                    `line1`='" . $line1 . "',
                    `line2`='" . $line2 . "',
                    `city_id`='" . $city . "',
                    `postal_code`='" . $postal_code . "' 
                    WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");

        //echo "Address updated Successfully.";
    } else {

        Database::iud("INSERT INTO `user_address` (`line1`, `line2`, `user_email`, `city_id`, `postal_code`)
                    VALUES ('" . $line1 . "', '" . $line2 . "', '" . $_SESSION["u"]["email"] . "', '" . $city . "', '" . $postal_code . "')");

        //echo "Address save Successfully";
    }

    echo "Success";
} else {
    echo "Please Log In to your account first";
}
?>