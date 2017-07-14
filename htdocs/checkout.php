<?php 

// start session
session_start() ;

// redirect to login page if user not authorized
if (!isset($_SESSION[ 'user_id'])) { 
	require('login_tools.php'); 
	load(); 
}

// page title, header and nav
$page_title = 'Checkout' ;
include ('includes/templates/header.html');
include ('includes/templates/nav.html');

// if total and cart are set
if(isset( $_GET['total']) && ($_GET['total'] > 0) && (!empty($_SESSION['cart']))) {
	// require db connection
  require ('../connect_db.php');
	// store buyer and order total in order table
  $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (". $_SESSION['user_id'].",".$_GET['total'].", NOW() ) ";
  $r = mysqli_query ($dbc, $q);
	// retrives current order number
  $order_id = mysqli_insert_id($dbc);
	// retrive cat items from store table
  $q = "SELECT * FROM store WHERE item_id IN (";
	foreach ($_SESSION['cart'] as $id => $value) { 
		$q .= $id . ',';}
  $q = substr($q, 0, -1 ).') order by item_id asc';
  $r = mysqli_query ($dbc, $q);
	// store order contents in order_contents table
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
    $query = "INSERT INTO order_contents ( order_id, item_id, quantity, price )
    VALUES ( $order_id, ".$row['item_id'].",".$_SESSION['cart'][$row['item_id']]['quantity'].",".$_SESSION['cart'][$row['item_id']]['price'].")" ;
    $result = mysqli_query($dbc,$query);
  }
	// close db connection
  mysqli_close($dbc);
	// display order number
  echo "<div class='container-fluid'><p>Thanks for your order. Your Order Number Is #".$order_id."</p></div>";
	// remove cart items
  $_SESSION['cart'] = NULL ;
} else { 
	echo '<div class="container-fluid"><p>There are no items in your cart.</p></div>'; 
}

// include footer
include('includes/templates/footer.html');

?>
