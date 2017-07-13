<?php // forum page

session_start();

if (!isset($_SESSION['user_id'])){
  require('login_tools.php');
  load();
}
// set page title, include header and require db connection
$page_title = 'Forum';
include('includes/templates/header.html');
require('../connect_db.php');
include('includes/templates/nav.html');
// query the db
$q = "SELECT * FROM forum";
$r = mysqli_query($dbc,$q);
?>	



<h2 class="text-center">Forum</h2>

<?php
// if there are forum posts
if(mysqli_num_rows($r) > 0): ?>
  <table class="table table-striped table-bordered text-center">
    <tr>
      <th class="text-center text-success">Posted By</th>
      <th class="text-center text-success">Subject</th>
      <th class="text-center text-success">Message</th>
    </tr>
    <?php while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)): ?>
    <tr>
      <td><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>
      <td><?= $row['subject'] ?></td>
      <td><?= $row['message'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
<?php else: ?>
<p>There are currently no messages.</p>
<?php endif; ?>


<?php 
mysqli_close($dbc);
include('includes/templates/footer.html');
?>

