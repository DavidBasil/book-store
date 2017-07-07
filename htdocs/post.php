<?php

session_start();

if (!isset($_SESSION['user_id'])){
  require('login_tools.php');
  load();
}

$page_title = 'Post Message';
include('includes/header.html');

?>

<form action="post_action.php" method="post" accept-charset="utf-8">
  <p>Subject:<br>
    <input type="text" name="subject" size="64" />
  </p>  
  <p>Message:<br>
    <textarea name="message" rows="5" cols="50"></textarea>
  </p>
  <p>
    <input type="submit" value="Submit" />
  </p>
</form> 

<p>
  <a href="forum.php">Forum</a> 
  <a href="shop.php">Shop</a> 
  <a href="home.php">Home</a> 
  <a href="goodbye.php">Logout</a>  
</p>

<?php 
include('includes/footer.html');
