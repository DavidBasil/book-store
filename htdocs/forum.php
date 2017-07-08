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

// query the db
$q = "SELECT * FROM forum";
$r = mysqli_query($dbc,$q);

// if there are forum posts
if(mysqli_num_rows($r) > 0): ?>
  <table>
    <tr>
      <th>Posted By</th>
      <th>Subject</th>
      <th id="msg">Message</th>
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

<p>
  <a href='post.php'>Post Message</a> |
  <a href='store.php'>Shop</a> |
  <a href='dashboard.php'>Home</a> |
  <a href='logout.php'>Lougout</a> |
</p>

<?php 
mysqli_close($dbc);
include('includes/templates/footer.html');
?>

