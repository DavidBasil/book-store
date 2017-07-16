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

include('includes/templates/nav.html');

echo <<<TXT
<div class="container-fluid text-center">
	<h3 class="well">DASHBOARD</h3>
	<br />
	<h4>Welcome to dashboard, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>
</div>
TXT;

include('includes/templates/footer.html');

