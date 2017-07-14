<?php
// todo: modify logout styles
// start the session
session_start();

// redirect to login page if user not authorized
if (!isset($_SESSION['user_id'])){
	require('login_tools.php');
	load();
}

// page title and header
$page_title = 'Goodbye';
include('includes/templates/header.html');

$_SESSION = array();

// destroy session
session_destroy();

// display goodbye message
echo <<<TXT
<div class="container-fluid text-center">
		<h2>Goodbye!</h2>
		<p>You are now logged out</p>
		<p><a href="login.php" class="btn btn-success">Login Again</a></p>
</div>

TXT;

// include footer
include('includes/templates/footer.html');


