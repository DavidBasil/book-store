<?php // shopping cart page

// session start
session_start();

// redirect to login page if not logged in
if (!isset( $_SESSION['user_id'])) { 
	require('login_tools.php'); 
	load();
}

// page title, include header and nav
$page_title = 'Cart' ;
include ('includes/templates/header.html');
include('includes/templates/nav.html');

echo "<div class='container-fluid'>";
// if cart form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// update altered quantities
  foreach ( $_POST['qty'] as $item_id => $item_qty )
  {
		// values must be integers
    $id = (int)$item_id;
    $qty = (int)$item_qty;
		// change quantity or delete if zero 
		if ($qty == 0) { 
			unset($_SESSION['cart'][$id]); 
		} 
		elseif ($qty > 0) {
			$_SESSION['cart'][$id]['quantity'] = $qty;}
  }
}

// cart total
$total = 0; 

// display the cart if not empty 
if (!empty($_SESSION['cart']))
{
	// connect to db
  require ('../connect_db.php');
	// retrieve all items from db
  $q = "SELECT * FROM store WHERE item_id IN (";
  foreach ($_SESSION['cart'] as $id => $value) { $q .= $id . ','; }
  $q = substr( $q, 0, -1 ) . ') ORDER BY item_id ASC';
  $r = mysqli_query ($dbc, $q);
	// display body section
	echo '<form action="cart.php" method="post">
					<table class="table table-condensed">
						<tr>
							<th colspan="5">Items in your cart</th>
						</tr>
						<tr>';
  while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC))
  {
		// display totals
    $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
    $total += $subtotal;
		// display rows
		echo "<tr class='animated fadeInLeft'>
						<td>{$row['item_name']}</td> 
						<td>{$row['item_desc']}</td>
   					<td><input type='text' size='3' name='qty[{$row['item_id']}]' value='{$_SESSION['cart'][$row['item_id']]['quantity']}'></td>
    <td>{$row['item_price']}</td><td>".number_format ($subtotal, 2)."</td></tr>";
  }
  // Close the database connection. 
  mysqli_close($dbc); 
  // Display the total. 
	echo '<tr>
					<td colspan="5" style="text-align:right" class="bg-success">Total = '.number_format($total,2).'</td></tr>
				</table>
				<button type="submit" name="submit" class="btn btn-warning">Update cart</button>
				<button class="btn btn-warning"><a class="btn-checkout" href="checkout.php?total='.$total.'">Checkout</a></button>
				</form>';
}
else { 
	echo "<p>Your cart is currently empty.</p>"; 
}

echo "</div>";
// include footer
include('includes/templates/footer.html');
?>
