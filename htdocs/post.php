<?php

session_start();

if (!isset($_SESSION['user_id'])){
  require('login_tools.php');
  load();
}

$page_title = 'Post Message';
include('includes/templates/header.html');

?>

<?php
echo <<<MENU
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Book Store</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="forum.php">Forum</a></li>
      <li><a href="store.php">Store</a></li>
      <li><a href="dashboard.php">Dashboard</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
MENU;
?>

<div class="container-fluid text-center">
	<div class="well">

		<form action="post_action.php" method="post" accept-charset="utf-8" class="form text-center">
			<div class="form-group">
				<label for="subject">Subject</label>
				<input type="text" name="subject" size="50" id="subject" class="form-control" />
			</div>
			<div class="form-group">
				<label for="message"></label>
				<textarea name="message" id="message" rows="5" cols="50" class="form-control"></textarea>
			</div>
				<button type="submit" class="btn btn-success">Post</button>
		</form> 

	</div>

</div>


<?php 
include('includes/templates/footer.html');
