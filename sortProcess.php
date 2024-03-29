<?php

session_start();
$user = $_SESSION["u"];

require "connection.php";

$search = $_POST["s"];
$time = $_POST["t"];
$qty = $_POST["q"];
$condition = $_POST["c"];

$query = "SELECT * FROM `product` WHERE `users_email` = '" . $user["email"] . "'";

if (!empty($search)) {
    $query .= "AND `title` LIKE '%" . $search . "%'";
}

if ($time == "1") {
    $query .= " ORDER BY `datetime_added` DESC";
} else if ($time == "2") {
    $query .= " ORDER BY `datetime_added` ASC";
}

if ($qty == "1") {
    $query .= " ORDER BY `qty` DESC";
} else if ($qty == "2") {
    $query .= " ORDER BY `qty` ASC";
}

if ($condition == "1") {
    $query .= " AND `condition_id` = '1'";
} else if ($condition == "2") {
    $query .= " AND `condition_id` = '2'";
}


?>

<div class="row justify-content-center">

    <?php
    if (isset($_GET["page"])) {
        $pageno = $_GET["page"];
    } else {
        $pageno = 1;
    }

    $product_rs = Database::search("$query");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    $result_per_page = 6;
    $number_of_pages = ceil($product_num / $result_per_page);

    $page_result = ($pageno - 1) * $result_per_page;
    $selected_rs = Database::search($query. " LIMIT " . $result_per_page . " OFFSET " . $page_result . "");

    $selected_num = $selected_rs->num_rows;

    // echo $selected_num;

    for ($x = 0; $x < $selected_num; $x++) {
        $selected_data = $selected_rs->fetch_assoc();


    ?>

        <!-- Card -->

        <div class="card mb-3 mt-3 col-12 col-lg-6">
            <div class="row">
                <div class="col-md-4 mt-4">

                    <?php

                    $product_img_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $selected_data["id"] . "'");
                    $product_img_data = $product_img_rs->fetch_assoc();

                    ?>

                    <img src="<?php echo $product_img_data["code"]; ?>" class="img-fluid rounded-start" />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?php echo $selected_data["title"]; ?></h5>
                        <span class="card-text fw-bold text-primary"><?php echo $selected_data["price"]; ?> .00</span>
                        <br />
                        <span class="card-text fw-bold text-success"><?php echo $selected_data["title"]; ?> Items left</span>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault <?php echo $selected_data["id"]; ?>" <?php if ($selected_data["status_id"] == 2) {
                                                                                                                                                echo "checked";
                                                                                                                                            } ?> onclick="changeStatus(<?php echo $selected_data['id']; ?>);">
                            <label class="form-check-label text-info fw-bold" for="flexSwitchCheckDefault <?php echo $selected_data["id"]; ?>" id="switch_lbl<?php echo $selected_data["id"]; ?>">

                                <?php

                                if ($selected_data["status_id"] == 2) {
                                    echo "Make your Product Active";
                                } else {
                                    echo "Make your Product Deactive";
                                }

                                ?>

                            </label>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="row g-1">

                                    <div class="col-12 col-lg-6 d-grid">
                                        <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $selected_data['id']; ?>);">Update</button>
                                    </div>
                                    <div class="col-12 col-lg-6 d-grid">
                                        <button class="btn btn-danger fw-bold">Delete</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <!-- Card -->

    <?php
    }
    ?>

</div>
</div>

<!-- pagination -->

<div class=" offset-2 offset-lg-4 col-8 col-lg-6 text-center mb-3">

    <div class="pagination">

        <a href="#" <?php
                    if ($pageno <= 1) {

                        echo "#";
                    } else {
                        echo "?page=" . ($pageno - 1);
                    }
                    ?> <a href="#">&laquo;</a>

        <?php
        for ($page = 1; $page <= $number_of_pages; $page++) {
            if ($page == $pageno) {

        ?>
                <a href="<?php echo "?page=" . ($page) ?>" class="active"><?php echo $page; ?></a>
            <?php

            } else {
            ?>
                <a href="<?php echo "?page=" . ($page) ?>"><?php echo $page; ?></a>
        <?php
            }
        }

        ?>

        <a href="
                                        <?php
                                        if ($pageno >= $number_of_pages) {

                                            echo "#";
                                        } else {
                                            echo "?page=" . ($pageno + 1);
                                        }
                                        ?>
                                        
                                        ">&raquo;</a>
    </div>

</div>


<?php



//  echo $search;
//  echo "<br/>";
//  echo $time;
//  echo "<br/>";
//  echo $qty;
//  echo "<br/>";
//  echo $condition;

?>