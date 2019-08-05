<?php
session_start();

$host = 'localhost:3307';
$username = 'root';
$password = '';
$dbname = 'shoppingcart';

try {
	$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $username, $password);
} catch (PDOException $exception) {
	// If there is an error with the connection, stop the script and display the error.
	die ('Failed to connect to database!');
}

// Add pages we only need for our shopping cart system, for example addtocart will include the addtocart.php file.
$pages = array('cart', 'home', 'product', 'products', 'placeorder');
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && in_array($_GET['page'], $pages) ? $_GET['page'] : 'home';


// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Hillary Shopping Hub </title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Hillary Shopping Hub</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
						<span><?=$num_items_in_cart?></span>
					</a>
                </div>
            </div>
        </header>
        <main>
        <?php include $page . '.php'; ?>
        </main>
        <footer>
			<div class="content-wrapper">
            	<p>© <?=date('Y')?>, Hillary Shopping Hub</p>
			</div>
        </footer>
    </body>
</html>