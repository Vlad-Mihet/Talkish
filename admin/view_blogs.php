<?php
include_once("../layout/navbar.php");

$blogsResult = null;

if ($_SESSION && isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT role FROM users WHERE id = '$user_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)) {
      if (mysqli_fetch_assoc($result)['role'] !== 'admin')
        // User isn't admin 
        echo "<script>window.location.assign('/index.php');</script>";

      // The User Is Admin And We Can Fecth The Data From The DB Accordingly
      $sql = "SELECT blog.*, author.firstName, author.lastName FROM blogs AS blog INNER JOIN users AS author ON author.id = blog.author_id";
      if ($result = mysqli_query($conn,  $sql))
        if (mysqli_num_rows($result))
          $blogsResult = $result;
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
      <li style="border-bottom-color: #333;">
        <a href="/admin/view_blogs.php">View Blogs</a>
      </li>
      <li>
        <a href="/admin/view_users.php">View Users</a>
      </li>
    </ul>
  </div>
  <?php if ($blogsResult) : ?>
    <div id="blogs__container">
      <div class="labels__bar">
        <span class="thumbnail">Thumbnail</span>
        <span>Id</span>
        <span class="title">Title</span>
        <span class="content">Content</span>
        <span class="name">Author's Name</span>
        <span>Options</span>
      </div>
      <?php while ($data = mysqli_fetch_assoc($blogsResult)) : ?>
        <div class="blog__data">
          <div class="thumbnail__wrapper">
            <img src="<?php echo $data['thumbnail']; ?>" alt="<?php echo $data['title']; ?>" />
          </div>
          <span><?php echo $data['id']; ?></span>
          <span class="title">
            <?php echo substr($data['title'], 0, 25);
            if (strlen($data['title']) >= 25)
              echo "...";
            ?>
          </span>
          <span class="content">
            <?php echo substr($data['content'], 0, 40);
            if (strlen($data['content']) >= 40)
              echo "...";
            ?>
          </span>
          <span class="name">
            <?php echo $data['firstName'] . " " . $data['lastName']; ?>
          </span>
          <div class="options__wrapper">
            <i class="fas fa-pen" onclick="window.location.href='/admin/update_blog.php?blog_id=<?php echo $data['id']; ?>'"></i>
            <i class="fas fa-trash" onclick="window.location.href='/admin/delete_blog.php?blog_id=<?php echo $data['id']; ?>'"></i>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  <?php endif ?>
</div>

<?php
include_once("../layout/footer.php");
?>