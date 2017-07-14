<?php

// start the session
session_start() ;

// redirect to login page if user not authorized
if (!isset($_SESSION['user_id'])) { 
	require('login_tools.php'); 
	load(); 
}

// page title, include header and navigation
$page_title = 'Cart Addition' ;
include('includes/templates/header.html');
include('includes/templates/nav.html');

// get product id
if(isset($_GET['id'])) {
	$id = $_GET['id']; 
}

// require db connection
require('../connect_db.php');

echo "<div class='container-fluid text-center'>";

// retrieve all items from db
$q = "SELECT * FROM store WHERE item_id = $id";
$r = mysqli_query($dbc, $q );
if(mysqli_num_rows($r) == 1) {
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );
	// check if cart already containes the product
  if(isset($_SESSION['cart'][$id])){ 
		// add one more of this product
    $_SESSION['cart'][$id]['quantity']++; 
    echo '<p>Another "'.$row["item_name"].'" has been added to your cart</p>';
  } else {
		// or add one this product to cart
    $_SESSION['cart'][$id]= array('quantity' => 1, 'price' => $row['item_price']);
		echo '<h3>A "'.$row["item_name"].'" has been added to your cart</h3>';
  }
}

echo "</div>";
// close db connection
mysqli_close($dbc);

// include footer
include('includes/templates/footer.html');

?>
