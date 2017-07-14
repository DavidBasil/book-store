<?php
// set page title and include header 
$page_title = 'Login';
include('includes/templates/header.html');

// if there are errors, dislay them and provide registration link 
if (isset($errors) && !empty($errors)){
	echo '<p id="error">Oop! There was a problem</p>';
	foreach($errors as $error){
		echo " - $error<b>";
	}
	echo "Please try again or <a href='register.php'>register</a> here.";
}
?>

<div class="container-fluid text-center">
	<div class="well">
	<h2>Welcome to Book Store</h2>
	<h3 class="text-success">Login</h2>
	<br />
	<form action="login_action.php" method="post" class="form-inline text-center">
		<div class="form-group">
			<label for="email">Email:</label>	
			<input type="email" name="email" id="email" class="form-control" /><br>
		</div>
		<div class="form-group">
			<label for="pass">Password:</label>
			<input type="password" name="pass" id="pass" class="form-control" /><br>
		</div>
		<button type="submit" class="btn btn-success">Login <span class="glyphicon glyphicon-home"></span></button>
	</form>
	</div>
</div>

<?php include('includes/templates/footer.html'); ?>
