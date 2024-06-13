<?php
include_once 'includes/header.php';
include_once "includes/navbar.php";
// if (!isset($_SESSION['username'])) {
//     session_destroy();
//     header("Location: ./admin/login.php");
//     exit();
// }
?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in Landing page</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <!-- <img src="./admin/products/uploads/xiaomi-14-ultra.jpg" alt=""> -->
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            include_once "config/DBUntil.php";
            $db = new DBUntil();
            $product = $db->select("SELECT * FROM product LIMIT 3");
            foreach ($product as $products) {
            // var_dump($products['image']);

            ?>
                <div class="col mb-5">
                    <a href="detail.php?id=<?php echo $products['id']; ?>" style="text-decoration: none; color:black;">
                        <div class="card h-100">
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <img class="card-img-top" src="./admin/products/uploads/<?php echo $products['image']; ?>" alt="..." />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder"><?php echo $products['name']; ?></h5>
                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                        <div class="bi-star-fill"></div>
                                    </div>
                                    <!-- Product price-->
                                    <?php echo $products['price']; ?>$
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">

        <h2 class="fw-bolder mb-4 text-center">New product</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            global $db;
            $product = $db->select("SELECT * FROM product");
            foreach ($product as $products) {

            ?>
                <div class="col mb-5">
                    <a href="detail.php?id=<?php echo $products['id']; ?>" style="text-decoration: none; color:black;">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="./admin/products/uploads/<?php echo $products['image']; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $products['name']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $products['price']; ?>$
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                            </div>
                        </div>
                    </a href="detail.php?id=<?php echo $products['id']; ?>" style="text-decoration: none; color:black;">
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- Footer-->
<?php include_once "includes/footer.php" ?>