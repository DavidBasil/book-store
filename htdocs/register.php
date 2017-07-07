<?php // registration page

// set page title and display header section
$page_title = 'Register';
include('includes/templates/header.html');

// if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	// connect to db and intialize errors array	
	require('../connect_db.php');
	$errors = array();
	// validate first name
	if(empty($_POST['first_name'])){
		$errors[] = 'Enter your first name';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	// validate last name
	if (empty($_POST['last_name'])){
		$errors[] = 'Enter your last name';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	// validate email
	if (empty($_POST['email'])){
		$errors[] = 'Enter your email';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	// validate passwords
	if (!empty($_POST['pass1'])){
		if ($_POST['pass1'] != $_POST['pass2']){
			$errors[] = "Passwords don't match";
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = "Enter your password";
	}
	// check if an email is already in use
	if (empty($errors)){
		$q = "select user_id from users where email='$e'";
		$r = mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) != 0){
			$errors[] = "Email address already registered <a href='login.php'>Login</a>";
		} 
	}
	// if there are no errors store user data
	if (empty($errors)){
		$q = "insert into users (first_name, last_name, email, pass, reg_date)
					values
					('$fn', '$ln', '$e', SHA('$p'), NOW())";
		$r = mysqli_query($dbc, $q);
		// show sucess message
		if ($r)	{
			echo '<h1>Registered!<h1>
						<p>You are now registered</p>
						<p><a href="login.php">Login</p>';
		}
		// close the connection
		mysqli_close($dbc);
		include('includes/templates/footer.html');
		exit();
	}
	// if there are errors
	else {
		echo '<h2>Error!</h2><p id="err_msg">The following error(s) occurred:<br></p>';
		foreach ($errors as $msg){
			echo " - $msg<br>";
		}
		echo "Please try again.";
		mysqli_close($dbc);
	}

// end of post request method
}
?>

<h2>Register</h2>
<form action="register.php" method="post">
	<p>
	First Name:
	<input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />
	Last Name:
	<input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']; ?>" />
	<p>
		Email Address:
		<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />	
	</p>
	<p>
		Password:
		<input type="password" name="pass1" value="<?php if(isset($_POST['pass1'])) echo $_POST['pass1']; ?>" />	
		Confirm Password:
		<input type="password" name="pass2" value="<?php if(isset($_POST['pass2'])) echo $_POST['pass2']; ?>" />	
	</p>
	<input type="submit" value="Register" />
</form>

<?php include('includes/templates/footer.html'); ?>
