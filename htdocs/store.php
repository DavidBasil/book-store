<?php // store page

// start session
session_start() ;

// redirect to login page if user not logged in
if (!isset( $_SESSION['user_id'])) { 
	require('login_tools.php'); 
	load(); 
}

// set page title and include header
$page_title = 'Store';
include('includes/templates/header.html');

// connect to db
require ('../connect_db.php');

// retrieve all items from db
$q = "SELECT * FROM store";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0){
  echo '<table><tr>';
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
    echo '<td><strong>' . $row['item_name'] .'</strong><br><span>'. $row['item_desc'].'</span><br><img src='.$row['item_img'].'><br>$'. $row['item_price'].'<br><a href="added.php?id='.$row['item_id'].'">Add To Cart</a></td>';
	}
  echo '</tr></table>';
	// close db connection
  mysqli_close($dbc); 
} else { 
	echo '<p>There are currently no items in this shop.</p>'; 
}

// navigation
echo '<p><a href="cart.php">View Cart</a> | 
			<a href="forum.php">Forum</a> | 
			<a href="dashboard.php">Home</a> | 
			<a href="logout.php">Logout</a></p>';

// display the footer
include ('includes/templates/footer.html');

?>
