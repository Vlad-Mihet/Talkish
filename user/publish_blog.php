<?php
include("../layout/navbar.php");

function calculateReadingTime($blogContent)
{
  $wordsPerMinute = 200;
  $numWords = sizeof(explode(" ", $blogContent));
  $minutes = $numWords / $wordsPerMinute;
  $readTime = ceil($minutes);
  return $readTime;
}

if ($_SESSION && isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];


  if (isset($_POST['publish'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    $readingTime = calculateReadingTime($content);

    // Upload Blog Thumbnail

    // Create custom file name using unique ids and timestamps
    $filename = "tk_" . uniqid() . "-" . time();
    $extension  = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $basename   = $filename . "." . $extension;
    $source       = $_FILES["file"]["tmp_name"];
    $destination = "../images/{$basename}";
    move_uploaded_file($source,  $destination);

    $sql = "INSERT INTO `blogs`(`title`, `category`, `readingTime`, `content`, `author_id`, `thumbnail`) 
          VALUES ('$title', '$category', '$readingTime' ,'$content', '$user_id', '$destination')";

    if ($result = mysqli_query($conn, $sql))
      echo "<script>alert('Blog Post Created Successfully!')</script>";
  }
}

?>

<div class="form__container">
  <h2>
    Tell Your Story
    <p>To The Whole World!</p>
  </h2>
  <form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Blog Title..." />
    <textarea name="content" placeholder="Blog Content..."></textarea>
    <select name="category">
      <option value="Technology">Technology</option>
      <option value="Business">Business</option>
      <option value="Health">Health</option>
      <option value="Politics">Politics</option>
      <option value="Productivity">Productivity</option>
    </select>
    <input type="file" name="file" id="file" />
    <button name="publish" type="submit">Publish</button>
  </form>
</div>

<?php include("../layout/footer.php"); ?>