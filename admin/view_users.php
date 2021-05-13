<?php
include_once("../layout/navbar.php");

$usersResult = null;

if ($_SESSION && isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT role FROM users WHERE id = '$user_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)) {
      if (mysqli_fetch_assoc($result)['role'] !== 'admin')
        // User isn't admin 
        echo "<script>window.location.assign('/index.php');</script>";

      // The User Is Admin And We Can Fecth The Data From The DB Accordingly
      $sql = "SELECT users.*, count(blogs.id) as num_blogs from users left join blogs on (blogs.author_id = users.id) group by users.id";
      if ($result = mysqli_query($conn, $sql))
        if (mysqli_num_rows($result))
          $usersResult = $result;
    } else {
      // User doesn't exist
      echo "<script>window.location.assign('/index.php');</script>";
    }
  } else {
    // Error processing query
    echo "<script>window.location.assign('/index.php');</script>";
  }
} else {
  // User isn't logged in at all
  echo "<script>window.location.assign('/index.php');</script>";
}
?>

<div id="dashboard__container">
  <div class="nav">
    <ul>
      <li>
        <a href="/admin/dashboard.php">Dashboard</a>
      </li>
      <li>
        <a href="/admin/view_blogs.php">View Blogs</a>
      </li>
      <li style="border-bottom-color: #333;">
        <a href="/admin/view_users.php">View Users</a>
      </li>
    </ul>
  </div>
  <?php if ($usersResult) : ?>
    <div id="users__container">
      <div class="labels__bar">
        <span>Id</span>
        <span class="firstName">First Name</span>
        <span class="lastName">Last Name</span>
        <span class="email">Email</span>
        <span>No. Published Blogs</span>
        <span class="options">Options</span>
      </div>
      <?php while ($data = mysqli_fetch_assoc($usersResult)) : ?>
        <div class="user__data">
          <span><?php echo $data['id']; ?></span>
          <span class="firstName">
            <?php echo $data['firstName']; ?>
          </span>
          <span class="lastName">
            <?php echo $data['lastName']; ?>
          </span>
          <span class="email">
            <?php echo $data['email']; ?>
          </span>
          <span>
            <?php echo $data['num_blogs']; ?>
          </span>
          <div class="options__wrapper">
            <i class="fas fa-trash" onclick="window.location.href='/admin/delete_user.php?user_id=<?php echo $data['id']; ?>'"></i>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  <?php endif ?>
</div>

<?php
include_once("../layout/footer.php");
?>