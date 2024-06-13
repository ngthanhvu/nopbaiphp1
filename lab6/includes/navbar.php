<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="product.php">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <?php
                session_start();
                include_once "./config/DBUntil.php";
                include_once "cart-services.php";
                $db = new DBUntil();
                if (isset($_SESSION['username'])) {
                    $user = $_SESSION['username'];
                    if ($user['role'] == 'admin') {
                        echo '<li class="nav-item"><a class="nav-link" href="../admin/index.php?view=index">Admin</a></li>';
                    }
                }
                ?>
            </ul>
            <form class="d-flex">
                <a class="btn btn-outline-dark" href="cart.php">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                        <?php
                        $cart = new Cart();
                        $count = $cart->getCart();
                        $getcount = $db->select("SELECT * FROM cart");
                        echo count($getcount);
                        ?>
                    </span>
                </a>
            </form>
            <form class="d-flex ms-3">
                <?php
                if (isset($_SESSION['username'])) {
                    echo '
                <div class="dropdown">
                    <a href="#" class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php?id=' . $_SESSION['username']['id'] . '">Profile</a></li>
                        <li><a class="dropdown-item" href="history.php">History order</a></li>
                        <li><a class="dropdown-item" href="./admin/logout.php">logout</a></li>
                    </ul>
                </div>
                ';
                } else {
                    echo '
                <a class="btn btn-outline-dark" href="./admin/login.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Login
                </a>
                    ';
                }
                ?>
            </form>
        </div>
    </div>
</nav>
