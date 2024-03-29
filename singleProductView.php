<?php

require "connection.php";
if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $production_rs = Database::search("SELECT `product`.`id`, `product`.`category_id`,
    `product`.`model_has_brand_id`, `product`.`title`, `product`.`price`, `product`.`qty`,
    `product`.`description`, `product`.`condition_id`, `product`.`status_id`, `product`.`users_email`,
    `model`.`name` AS `mname`, `brand`.`name` AS `bname` FROM `product` INNER JOIN `model_has_brand` ON
    `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `brand` ON `brand`.`id` = `model_has_brand`.`brand_id`
    INNER JOIN `model` ON `model`.`id` = `model_has_brand`.`model_id` WHERE `product`.`id` = '" . $pid . "'");

    $product_num = $production_rs->num_rows;

    if ($product_num == 1) {

        $product_data = $production_rs->fetch_assoc();



?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>eShop | Single Product View</title>
            <link rel="icon" href="resources/logo.svg" />
            <link rel="stylesheet" href="style.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="bootstrap.css" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">
                    <?php
                    require "header.php";
                    ?>

                    <div class="col-12 mt-0 bg-bg-white singleproduct">
                        <div class="row">
                            <div class="col-12" style="padding: 11px;">
                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php
                                            $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id` = '" . $pid . "'");
                                            $product_img_num = $product_img_rs->num_rows;
                                            $img = array();

                                            if ($product_img_num != 0) {
                                                for ($x = 0; $x < $product_img_num; $x++) {
                                                    $product_img_data = $product_img_rs->fetch_assoc();
                                                    $img[$x] = $product_img_data["code"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center 
                                                     align-items-center border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-1 mb-1" style="height: 200px;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);">
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center 
                                                align-items-center border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1">
                                                </li>

                                                <li class="d-flex flex-column justify-content-center 
                                                align-items-center border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1">
                                                </li>

                                                <li class="d-flex flex-column justify-content-center 
                                                align-items-center border-1 border-secondary mb-1">
                                                    <img src="resources/empty.svg" class="img-thumbnail mt-1 mb-1">
                                                </li>
                                            <?php
                                            }
                                            ?>

                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">

                                            <div class="col-12 align-items-center border border-1 border-secondary">
                                                <div class="mainImg" id="mainImg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row border-bottom border-dark">

                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>

                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-3">
                                                        <span class="fs-4 fw-bold text-success"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 mt-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-half text-warning fs-5"></i>

                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 35 Ratings and Reviews</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">

                                                        <?php

                                                        $price = $product_data["price"];
                                                        $addingPrice = ($price / 100) * 5;
                                                        $newPrice = $price + $addingPrice;
                                                        $difference = $newPrice - $price;
                                                        $percentage = ($difference / $price) * 100;

                                                        ?>

                                                        <span id="unitPrice" class="fs-4 fw-bold text-black">Rs. <?php echo $price; ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-danger"><del>Rs. <?php echo $newPrice; ?> .00</del></span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">Save Rs. <?php echo $difference; ?> .00 (<?php echo $percentage; ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12">
                                                        <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months warrenty</span>
                                                        <br />
                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>1 Months warrenty</span>
                                                        <br />
                                                        <span class="fs-5 text-primary"><b>In-stock : </b><?php echo $product_data["qty"]; ?> Items Available</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2">
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-4 text-info"><b>Seller : </b>Mohomed Fazil</span>
                                                            </div>
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-4 text-success"><b>Sold : </b>10 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-1 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3 col-lg-2 border-end border-1 border-danger">
                                                                        <img src="resources/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <span class="fs-5 fw-bold text-warning">Stand a chance to get 5% discound by using VISA or MASTER</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-3">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden float-start mt-2 position-relative product_qty">
                                                                        <div class="col-12">
                                                                            <span>Quantity :</span>
                                                                            <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" id="qtyInput" onkeyup='check_value(<?php echo $product_data["qty"] ?>);'/>

                                                                            <div class="position-absolute qty-buttons">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1
                                                                    border-secondary qty_inc">
                                                                                    <i class="bi bi-caret-up text-info fs-5" onclick='qty_inc(<?php echo $product_data["qty"] ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center border border-1
                                                                    border-secondary qty_dec">
                                                                                    <i class="bi bi-caret-down text-info fs-5" onclick="qty_dec();"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-success" onclick="buynow(<?php echo $_GET['id']; ?>);">Buy Now</button>
                                                                                </div>

                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-primary">Add to card</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-outline-secondary">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                            <div class="col-12">
                                <span class="fs-3 fw-bold">Related Items</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 bg-white">
                        <div class="row g-2">



                            <?php
                            $related_rs = Database::search("SELECT * FROM `product` WHERE
                            `model_has_brand_id` = '" . $product_data["model_has_brand_id"] . "' LIMIT 6");

                            $related_num = $related_rs->num_rows;

                            for ($y = 0; $y < $related_num; $y++) {
                                $related_data = $related_rs->fetch_assoc();

                            ?>
                                <div class="offset-1 offset-lg-0 col-4 col-lg-2">
                                    <div class="card" style="width: 18rem;">
                                        <img src="resources/mobile_images/iphone12.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $related_data["title"]; ?></h4>
                                            <span class="fs-5 fw-bold">Rs. 100000 .00</span>
                                            <div class="col-12">
                                                <div class="row g-1">
                                                    <div class="col-12 d-grid">
                                                        <button class="btn btn-primary" onclick="buynow(<?php echo $pid ?>);">Buy Now</button>
                                                    </div>
                                                    <div class="col-12 d-grid">
                                                        <button class="btn btn-primary">Add to card</button>
                                                    </div>
                                                    <div class="col-12 d-grid">
                                                        <button class="btn btn-primary"><i class="bi bi-heart-fill fs-5 text-danger"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }


                            ?>



                            <div class="col-12">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-4 fw-bold">Product Details</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 bg-white">
                                <div class="row">
                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand</label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["bname"]; ?></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model</label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4"><?php echo $product_data["mname"]; ?></label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12">

                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea class="form-control" cols="60" rows="10" disabled><?php echo $product_data["description"] ?></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <?php
                    require "footer.php";
                    ?>
                </div>
            </div>




            <script src="script.js"></script>
            <script src="bootstrap.js"></script>
            <script src="bootstrap.bundle.js"></script>
        </body>

        </html>
<?php
    } else {
        echo "Sorry for the inconvenient.";
    }
} else {
    echo "Something went wrong.";
}
?>