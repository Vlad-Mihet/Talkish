<?php
include_once('./layout/navbar.php');

$data = null;

function trigger_view_blog($blog_id)
{
  echo "<script>view_blog($blog_id)</script";
}

if (isset($_GET['blog_id'])) {
  $blog_id = $_GET['blog_id'];
  $sql = "SELECT blogs.*, users.firstName, users.lastName FROM blogs INNER JOIN users ON blogs.author_id = users.id WHERE blogs.id = '$blog_id'";

  $result = mysqli_query($conn, $sql);

  $data = mysqli_fetch_assoc($result);
}

function blog_likes($blog_id, $conn)
{
  $sql = "SELECT COUNT(*) FROM likes WHERE blog_id = '$blog_id'";

  if ($result = mysqli_query($conn, $sql)) {
    $data = mysqli_fetch_assoc($result)['COUNT(*)'];

    if (!$data)
      return "No Likes";

    if ($data == 1)
      return "1 Like";

    if ($data >= 2)
      return $data . " Likes";
  }

  return;
}

function isLiked($user_id, $blog_id, $conn)
{
  $sql = "SELECT * FROM likes WHERE blog_id = '$blog_id' AND user_id = '$user_id'";

  if ($result = mysqli_query($conn, $sql))
    if (mysqli_num_rows($result))
      return true;
  return false;
}
?>

<div id="blog__container">
  <h1><?php echo $data['title']; ?></h1>
  <div class="authorInfo__container">
    <div class="circle__container">
      <div class="wrapper__1"></div>
      <div class="wrapper__2"></div>
      <div class="wrapper__3"></div>
      <span><?php echo substr($data['firstName'], 0, 1) . substr($data['lastName'], 0, 1) ?></span>
    </div>
    <div class="right__col">
      <div class="top__row">
        <a class="author__name" href="/author/profile.php?author_id=<?php echo $data['author_id']; ?>">
          <?php echo $data['firstName'] . " " . $data['lastName'] ?>
        </a>
      </div>
      <div class="bottom__row">
        <span><?php echo date("M j", strtotime($data["published_at"])) ?></span>
        <div></div>
        <span><?php echo $data['readingTime'] ?> min read</span>
      </div>
    </div>
  </div>
  <div class="thumbnail__wrapper">
    <?php echo "<img src='" . substr($data['thumbnail'], 1) . "'/>" ?>
  </div>
  <div class="content__container">
    <p><?php echo $data['content']; ?></p>
  </div>
  <div class="blog__footer">
    <div class="like__wrapper">
      <?php if (!isLiked($author_id, $data['id'], $conn)) : ?>
        <button onclick="like_blog_func(<?php echo $data['id'] . ', ' . $author_id; ?>)">Like</button>
      <?php else : ?>
        <button onclick="remove_like_blog_func(<?php echo $data['id'] . ', ' . $author_id; ?>)">Liked</button>
      <?php endif ?>
      <p>
        <?php echo blog_likes($data['id'], $conn) ?>
      </p>
    </div>
    <p><?php echo $data['views']; ?> Views</p>
  </div>
</div>

<?php
include_once("./layout/footer.php");
?>