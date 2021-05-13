<?php
include_once("./layout/navbar.php");

$category = "All";

if (isset($_GET['category']))
  $category = $_GET['category'];

function renderBlogs($category, $conn)
{
  $sql = null;

  if ($category)
    $sql = "SELECT blogs.*, users.firstName, users.lastName FROM blogs INNER JOIN users ON blogs.author_id = users.id WHERE category = '$category'";

  if ($category === 'All')
    $sql = "SELECT blogs.*, users.firstName, users.lastName FROM blogs INNER JOIN users ON blogs.author_id = users.id";

  if ($result = mysqli_query($conn, $sql)) : ?>
    <div id="blogs__container">
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
              <p>By <a href="/author/profile.php?author_id=<?php echo $data['author_id']; ?>"><?php echo $data['firstName'] . " " . $data['lastName'] ?></a> in <a href="/index.php?category=<?php echo $data['category'] ?>"><?php echo $data['category']; ?></a></p>
              <p><?php echo substr($data['content'], 0, 135) . '...'; ?></p>
            </div>
            <div class="bottom__wrapper">
              <div>
                <p>Reading Time: <?php echo $data['readingTime'] ?> Minutes</p>
                <p>Published on <?php echo date("F j, Y", strtotime($data["published_at"])) ?></p>
              </div>
              <a href="/blog.php?blog_id=<?php echo $data['id']; ?>">See Blog</a>
            </div>
          </div>
        </div>
      <?php endwhile ?>
    </div>
  <?php endif ?>
<?php
}
?>

<div id="homepage__container">
  <?php include("./layout/CategoryNav.php") ?>
  <?php renderBlogs($category, $conn); ?>
</div>

<?php include_once("./layout/footer.php"); ?>