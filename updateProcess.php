<?php

session_start();
require "connection.php";

if(isset($_SESSION["p"])){

    $product_id = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $delivery_within_colombo = $_POST["dwc"];
    $delivery_outof_colombo = $_POST["doc"];
    $description = $_POST["d"];
    $image = $_FILES["i"];

    Database::iud("UPDATE `product` SET `title`= '".$title."', `qty` = '".$qty."', 
    `delivery_fee_colomco` = '".$delivery_within_colombo."', `delivery_fee_other` = '".$delivery_outof_colombo."', 
    `description` = '".$description."' WHERE `id` = '".$product_id."'");

    echo "Product updated successfully";

    $allowed_img_extentions = array("image/jpg", "image/jpeg", "image/png", "image/png", "image/svg+xml");

    if(isset($_FILES["i"])){
        $image = $_FILES["i"];

        $file_extention = $image["type"];
        if(!in_array($file_extention, $allowed_img_extentions)){
            echo "Invalid Image type";
        }else{

            $newExtention;

            if($file_extention == "image/jpg"){
                $newExtention = ".jpg";
            }else if($file_extention == "image/jpeg"){
                $newExtention = ".jpeg";
            }else if($file_extention == "image/png"){
                $newExtention = ".png";
            }else if($file_extention == "image/svg+xml"){
                $newExtention = ".svg";
            }

            $file_name = "resources//product_img//".uniqid().$newExtention;
            move_uploaded_file($image["tmp_name"], $file_name);

            Database::iud("UPDATE `images` SET `code` = '".$file_name."' WHERE `product_id` = '".$product_id."'");

            echo "Product Image updated successfully.";
        }
    }
}



// echo $title;
// echo $qty;
// echo $delivery_within_colombo;
// echo $delivery_outof_colombo;
// echo $description;
// echo $image["tmp_name"];

?>