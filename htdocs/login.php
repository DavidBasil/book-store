<?php // login page

/* set page title and include header */
$page_title = 'Login';
include('includes/templates/header.html');

/* if there are errors, dislay them and provide registration link */
if (isset($errors) && !empty($errors)){
	echo '<p id="error">Oop! There was a problem</p>';
	foreach($errors as $error){
		echo " - $error<b>";
	}
	echo "Please try again or <a href='register.php'>register</a> here.";
}

?>

<h2>Login</h2>
<form action="login_action.php" method="post">
	<label for="email">Email:</label>	
	<input type="email" name="email" id="email" /><br>
	<label for="pass">Password:</label>
	<input type="password" name="pass" id="pass" /><br>
	<input type="submit" value="Login" />
</form>

<?php include('includes/templates/footer.html'); ?>
