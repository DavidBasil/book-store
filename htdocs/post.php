<?php

// start session
session_start();

// redirect to login page if user not authorized
if (!isset($_SESSION['user_id'])){
  require('login_tools.php');
  load();
}

// page title, header and nav
$page_title = 'Post Message';
include('includes/templates/header.html');
include('includes/templates/nav.html');

?>

<div class="container-fluid text-center">
	<div class="well">
		<form action="post_action.php" method="post" id="forum-post" accept-charset="utf-8" class="form text-center">
			<div class="form-group">
				<label for="subject">Subject</label>
				<input type="text" name="subject" size="50" id="subject" class="form-control" required/>
			</div>
			<div class="form-group">
				<label for="message"></label>
				<textarea name="message" id="message" rows="5" cols="50" class="form-control" required></textarea>
			</div>
				<button type="submit" class="btn"><i class="fa fa-plus-square"></i>  Post</button>
		</form> 
	</div>
</div>

<?php 
// include footer
include('includes/templates/footer.html');
