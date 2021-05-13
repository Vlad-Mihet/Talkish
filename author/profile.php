<?php
include("../layout/navbar.php");

$data = null;
$author_id = null;

if (isset($_GET['author_id'])) {
  $author_id = $_GET['author_id'];

  $sql = "SELECT * FROM users WHERE id = '$author_id'";

  if ($result = mysqli_query($conn, $sql))
    $data = mysqli_fetch_assoc($result);
}

function hasBlogs($authorId, $conn)
{
  $sql = "SELECT * FROM blogs WHERE author_id = '$authorId'";

  if ($result = mysqli_query($conn, $sql))
    return $result;
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

<div id="author__container">
  <div id="header">
    <h1>
      <?php echo $data['firstName'] . " " . $data['lastName'] ?>
    </h1>
  </div>
  <?php if ($result = hasBlogs($author_id, $conn)) : ?>
    <div id="blogs__section">
      <?php while ($data = mysqli_fetch_assoc($result)) : ?>
        <div class="blog">
          <div class="blog__header">
            <span>Published in <a href="/blogs.php?category=<?php echo $data['category']; ?>"><?php echo $data['category']; ?></a></span>
          </div>
          <div class="content">
            <h2>
              <?php echo $data['title']; ?>
            </h2>
            <div class="image__wrapper">
              <img src="<?php echo $data['thumbnail'] ?>" alt="<?php echo $data['title']; ?>" />
            </div>
            <p>
              <?php echo substr($data['content'], 0, 1250); ?>
            </p>
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
            <div class="views__container">
              <p>
                <?php echo $data['views']; ?> Views
              </p>
              <a href="/blog.php?blog_id=<?php echo $data['id']; ?>">View Blog</a>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  <?php else : ?>
    <div class="noBlogs">
      <p>This Author doesn't currently have any blogs</p>
    </div>
  <?php endif ?>
</div>

<?php
include("../layout/footer.php");
?>