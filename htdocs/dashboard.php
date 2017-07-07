<?php // user dashboard page

session_start();

if (!isset($_SESSION['user_id'])){
	require('login_tools.php');
	load();
}

$page_title = 'Dashboard';
include('includes/templates/header.html');

echo <<<TXT
<h3>DASHBOARD</h3>
<p>Welcome to dashboard, {$_SESSION['first_name']} {$_SESSION['last_name']}</p>
TXT;

echo <<<MENU
<p>
 <a href="forum.php">Forum</a>
 <a href="store.php">Store</a>
 <a href="logout.php">Logout</a>
</p>
MENU;

include('includes/templates/footer.html');

