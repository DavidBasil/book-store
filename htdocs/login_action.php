<?php 

// if form has been submitted 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	require('../connect_db.php');
	require('login_tools.php');
	list($check, $data) = validate($dbc, $_POST['email'], $_POST['pass']);
	if ($check){
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['first_name'] = $data['first_name'];
		$_SESSION['last_name'] = $data['last_name'];
		load('dashboard.php');
	} else {
		$errors = $data;
	}
	mysqli_close($dbc);
}

// include login.php
include('login.php');


