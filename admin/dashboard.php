<?php
include_once("../layout/navbar.php");

$numPublishedBlogs = null;
$numRegisteredUsers = null;
$numUsersWhoPublishedABlog = null;
$rankedCategoriesByNumBlogs = null;
$rankedCategoriesByNumViews = null;
$rankedCategoriesByNumLikes = null;

if ($_SESSION && isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT role FROM users WHERE id = '$user_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)) {
      if (mysqli_fetch_assoc($result)['role'] !== 'admin')
        // User isn't admin 
        echo "<script>window.location.assign('/index.php');</script>";

      // The User Is Admin And We Can Fecth The Data From The DB Accordingly
      $sql = "SELECT COUNT(*) AS numBlogs FROM blogs";
      if ($result = mysqli_query($conn,  $sql))
        $numPublishedBlogs = mysqli_fetch_assoc($result)['numBlogs'];

      $sql = "SELECT COUNT(*) AS numUsers FROM users";
      if ($result = mysqli_query($conn,  $sql))
        $numRegisteredUsers = mysqli_fetch_assoc($result)['numUsers'];

      $sql = "SELECT COUNT(DISTINCT(author_id)) AS result FROM blogs";
      if ($result = mysqli_query($conn,  $sql))
        $numUsersWhoPublishedABlog = mysqli_fetch_assoc($result)['result'];

      $sql = "SELECT DISTINCT(category) AS result, category AS cat FROM blogs ORDER BY (SELECT COUNT(*) FROM blogs WHERE category = cat) DESC, blogs.title ASC";
      if ($result = mysqli_query($conn,  $sql))
        $rankedCategoriesByNumBlogs = $result;

      $sql = "SELECT DISTINCT(category) AS result FROM blogs ORDER BY views DESC, blogs.title ASC";
      if ($result = mysqli_query($conn,  $sql))
        $rankedCategoriesByNumViews = $result;

      $sql = "SELECT DISTINCT(category) AS result FROM blogs ORDER BY (SELECT COUNT(*) FROM likes WHERE blog_id = blogs.id) DESC, blogs.title ASC";
      if ($result = mysqli_query($conn,  $sql))
        $rankedCategoriesByNumLikes = $result;
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
      <li style="border-bottom-color: #333;">
        <a href="/admin/dashboard.php">Dashboard</a>
      </li>
      <li>
        <a href="/admin/view_blogs.php">View Blogs</a>
      </li>
      <li>
        <a href="/admin/view_users.php">View Users</a>
      </li>
    </ul>
  </div>
  <div class="top__row">
    <div class="col">
      <span>Total Number Of Published Blogs:</span>
      <span><?php echo $numPublishedBlogs; ?></span>
    </div>
    <div class="col">
      <span>Total Number Of Registered Users:</span>
      <span><?php echo $numRegisteredUsers; ?></span>
    </div>
    <div class="col">
      <span>Total Number Of Users That Published At Least One Blog:</span>
      <span><?php echo $numUsersWhoPublishedABlog; ?></span>
    </div>
  </div>
  <div class="bottom__row">
    <div class="col">
      <h3>Categories Ranked By No. Of Blogs</h3>
      <ul>
        <?php $index = 1;
        while ($data = mysqli_fetch_assoc($rankedCategoriesByNumBlogs)) : ?>
          <li>
            <?php echo "<span>" . $index++ . ".</span> " . "<span>" . $data['result'] . "</span>"; ?>
          </li>
        <?php endwhile ?>
      </ul>
    </div>
    <div class="col">
      <h3>Categories Ranked By No. Of Views</h3>
      <ul>
        <?php $index = 1;
        while ($data = mysqli_fetch_assoc($rankedCategoriesByNumViews)) : ?>
          <li>
            <?php echo "<span>" . $index++ . ".</span> " . "<span>" . $data['result'] . "</span>"; ?>
          </li>
        <?php endwhile ?>
      </ul>
    </div>
    <div class="col">
      <h3>Categories Ranked By No. Of Likes</h3>
      <ul>
        <?php $index = 1;
        while ($data = mysqli_fetch_assoc($rankedCategoriesByNumLikes)) : ?>
          <li>
            <?php echo "<span>" . $index++ . ".</span> " . "<span>" . $data['result'] . "</span>"; ?>
          </li>
        <?php endwhile ?>
      </ul>
    </div>
  </div>
</div>

<?php
include_once("../layout/footer.php");
?>