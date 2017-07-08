<?php // user dashboard page

// start the session
session_start();

// send the user to login page if not authorized
if (!isset($_SESSION['user_id'])){
	require('login_tools.php');
	load();
}

$page_title = 'Dashboard';
include('includes/templates/header.html');

echo <<<MENU
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Book Store</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="forum.php">Forum</a></li>
      <li><a href="store.php">Store</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
MENU;


echo <<<TXT
<div class="container-fluid text-center">
	<h3>DASHBOARD</h3>
	<br />
	<h4>Welcome to dashboard, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>
</div>
TXT;


include('includes/templates/footer.html');

