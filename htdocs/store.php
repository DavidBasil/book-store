<?php // store page

// start session
session_start();

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

// include navigation
include('includes/templates/nav.html');

echo "<div class='container-fluid text-center'><h3>Store</h3><br>";
// retrieve all items from db
$q = "SELECT * FROM store";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0){
  echo '<table class="table-bordered table table-condensed store-table"><tr>';
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		echo '<td><strong><u>'.$row['item_name'].
			'</u><br></strong><br><p>'.$row['item_desc'].
			'</p><br><img src='.$row['item_img'].
			' class="img-thumbnail img-responsive"><br>$'.$row['item_price'].
			'<br><a href="added.php?id='.$row['item_id'].'">Add to cart </a></td>';
	}
  echo '</tr></table>';
	// close db connection
  mysqli_close($dbc); 
} else { 
	echo '<p>There are currently no items in this shop.</p>'; 
}
echo "</div>";
// display the footer
include ('includes/templates/footer.html');

?>
