<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>eShop | Update Product</title>
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container-fluid">
        <div class="row gy-3">

            <?php require "header.php"; ?>

            <div class="col-12">
                <div class="row">

                    <?php
                    require "connection.php";
                    $product =  $_SESSION["p"];
                    if (isset($product)) {

                    ?>


                        <div class="col-12 text-center">
                            <h2 class="h2 text-primary fw-bold">Update Product</h2>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Category</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" disabled>

                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category` WHERE `id` = '" . $product["category_id"] . "'");
                                                $category_data = $category_rs->fetch_assoc();

                                                ?>
                                                <option><?php echo $category_data["name"] ?></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Brand</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" disabled>
                                                <?php
                                                $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id` IN
                                                (SELECT `brand_id` FROM model_has_brand WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                                $brand_data = $brand_rs->fetch_assoc();

                                                ?>
                                                <option><?php echo $brand_data["name"] ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Model</label>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="form-select" disabled>

                                                <?php
                                                $model_rs = Database::search("SELECT * FROM `model` WHERE `id` IN
                                                (SELECT `model_id` FROM model_has_brand WHERE `id`='" . $product["model_has_brand_id"] . "')");

                                                $model_data = $model_rs->fetch_assoc();

                                                ?>

                                                <option><?php echo $model_data["name"] ?></option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fw-bold lbl1">
                                        Add a title to your Product.
                                    </label>
                                </div>
                                <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                    <input type="text" class="form-control" value="<?php echo $product["title"]; ?>" id="ti" />
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1">
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Condition</label>
                                        </div>

                                        <?php
                                        if ($product["condition_id"] == 1) {
                                        ?>
                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="condition" id="bn" checked disabled>
                                                <label class="form-check-label" for="bn">
                                                    Brand new
                                                </label>
                                            </div>
                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="condition" id="us" disabled>
                                                <label class="form-check-label" for="us">
                                                    Used
                                                </label>
                                            </div>

                                        <?php

                                        } else {
                                        ?>
                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="condition" id="bn" disabled>
                                                <label class="form-check-label" for="bn">
                                                    Brand new
                                                </label>
                                            </div>
                                            <div class="offset-1 col-11 col-lg-3 ms-5 form-check">
                                                <input class="form-check-input" type="radio" name="condition" id="us" checked disabled>
                                                <label class="form-check-label" for="us">
                                                    Used
                                                </label>
                                            </div>
                                        <?php

                                        }
                                        ?>




                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Select Product Color</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">

                                                <?php
                                                if ($product["color_id"] == 1) {
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                        <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            Gold
                                                        </label>
                                                    </div>

                                                <?php

                                                } else if ($product["color_id"] == 2) {
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                        <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            Silver
                                                        </label>
                                                    </div>
                                                <?php
                                                } else if ($product["color_id"] == 3) {
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                        <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            Graphite
                                                        </label>
                                                    </div>
                                                <?php

                                                } else if ($product["color_id"] == 4) {
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                        <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            Pacific Blue
                                                        </label>
                                                    </div>
                                                <?php

                                                } else if ($product["color_id"] == 5) {
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                        <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            Jet Black
                                                        </label>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="form-check offset-1 offset-lg-0 col-5 col-lg-4">
                                                        <input class="form-check-input" type="radio" name="clrradio" id="clr1" checked disabled>
                                                        <label class="form-check-label" for="clr1">
                                                            Rose Gold
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">

                                        <label class="form-label fw-bold lbl1">Add Product Quantity</label>

                                        <input type="number" class="form-control" min="0" value="<?php echo $product["qty"]; ?>" id="qty">

                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Cost per Item</label>
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rs.</span>
                                            <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["price"];?>" disabled>
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold lbl1">Approved Payment Methods</label>
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="offset-2 col-2 pm1"></div>
                                                <div class="col-2 pm2"></div>
                                                <div class="col-2 pm3"></div>
                                                <div class="col-2 pm4"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="hr-break-1">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label fw-bold lbl1">Delivery Cost</label>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">

                                        <div class="col-12 offset-lg-1 col-lg-3">
                                            <label>Delivey Cost Within Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-8">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_colomco"];?>" id="dwc">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-12 col-lg-6">
                                    <div class="row">


                                        <div class="col-12 offset-lg-1 col-lg-3">
                                            <label>Delivey Cost Within Colombo</label>
                                        </div>

                                        <div class="col-12 col-lg-8">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">Rs.</span>
                                                <input type="text" class="form-control" aria-label="Amount (to the nearest rupee)" value="<?php echo $product["delivery_fee_other"];?>" id="doc">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1">
                        </div>



                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fw-bold lbl1">Product Description</label>
                                </div>

                                <div class="col-12">
                                    <textarea class="form-control" cols="30" rows="25" id="des"><?php echo $product["description"];?></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1">
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <label class="form-label fw-bold lbl1">Add Product Images</label>
                                </div>

                                <div class="offset-lg-3 col-12 col-lg-6">
                                    <div class="row ms-2">
                                        <?php
                                        $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '".$product["id"]."'");
                                        $images_data = $images_rs->fetch_assoc();
                                        ?>

                                        <div class="col-4 border rounded border-primary">
                                        <img class="img-fluid" src="<?php echo $images_data["code"] ?>" id="preview0" style="width: 250px;"/>
                                        </div>

                                        <div class="col-4 border rounded border-primary">
                                        <img class="img-fluid" src="resources/addproductimg.svg" id="preview1" style="width: 250px;"/>
                                        </div>

                                        <div class="col-4 border rounded border-primary">
                                        <img class="img-fluid" src="resources/addproductimg.svg" id="preview2" style="width: 250px;"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 offset-lg-3 col-lg-6 d-grid mt-3">
                                    <input type="file" accept="img/*" class="d-none" id="imageUploader" />
                                    <label for="imageUploader" class="col-12 btn btn-primary" onclick="changeProductImage();">Upload Image</label>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr class="hr-break-1">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold lbl1">Notice</label>
                            <br />
                            <label class="form-label">We are taking 5% of the product price from every product as a service charge.</label>
                        </div>

                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3 mt-2">
                            <button class="btn btn-success fw-bold" onclick="updateProduct();">Update Product</button>
                        </div>

                </div>
            </div>

            <?php require "footer.php" ?>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>
<?php
                    }
?>