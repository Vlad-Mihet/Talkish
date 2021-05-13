<?php
include_once('../layout/navbar.php');

function getLoggedUserData($conn)
{
  if (isset($_SESSION) && $_SESSION['user_id']) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT firstName, lastName FROM users WHERE id = '$user_id'";

    if ($result = mysqli_query($conn, $sql)) {
      $data = mysqli_fetch_assoc($result);

      return $data;
    }
  }
}

function doesUserHaveBlogs($userId, $conn)
{
  $sql = "SELECT * FROM blogs WHERE author_id = '$userId'";

  if ($result = mysqli_query($conn, $sql))
    return $result;
}

?>

<div id="account__container">
  <div class="top__bar">
    <h2>Hello, <?php echo getLoggedUserData($conn)['firstName'] ?>!</h2>
    <ul>
      <li>
        <a href="/user/blogs.php">Your Blogs</a>
      </li>
      <li>
        <a href="/user/settings.php">Settings</a>
      </li>
    </ul>
  </div>
  <?php if ($result = doesUserHaveBlogs($_SESSION['user_id'], $conn)) : ?>
    <h3>Your Blogs:</h3>
    <div class="blogs__container">
      <?php while ($data = mysqli_fetch_assoc($result)) : ?>
        <div class="blog">
          <div class="image__wrapper">
            <img src="<?php echo $data['thumbnail']; ?>" alt="<?php echo $data['title'] ?>" />
          </div>
          <div class="textContent__wrapper">
            <div class="top__wrapper">
              <h3>
                <?php echo substr($data['title'], 0, 50);
                if (strlen($data['title']) >= 50) echo "..."; ?>
              </h3>
              <p>
                <?php echo substr($data['content'], 0, 150) . '...'; ?>
              </p>
            </div>
            <div class="bottom__wrapper">
              <div>
                <p>Reading Time: <?php echo $data['readingTime'] ?> Minutes</p>
                <p>Published on <?php echo date("F j, Y", strtotime($data["published_at"])) ?></p>
              </div>
              <a href="/blog.php?blog_id=<?php echo $data['id']; ?>">See Blog</a>
            </div>
            <div class="options__wrapper">
              <i class="fas fa-pen" onclick="window.location.href='/user/update_blog.php?blog_id=<?php echo $data['id']; ?>'"></i>
              <i class="fas fa-trash" onclick="window.location.href='/user/delete_blog.php?blog_id=<?php echo $data['id']; ?>'"></i>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  <?php else : ?>
    <div class="noBlogs">
      <h3>You haven't posted any blogs yet.</h3>
      <a href="/user/publish_blog.php">Publish Your First Blog</a>
    </div>
  <?php endif ?>
</div>

<?php include("../layout/footer.php"); ?>