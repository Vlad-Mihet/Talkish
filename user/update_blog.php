<?php

include_once("../layout/navbar.php");
$data = null;

if (!$_SESSION || !isset($_SESSION['user_id']))
  echo "<script>window.location.href='/index.php';</script>";

if (isset($_GET['blog_id'])) {
  $blog_id = $_GET['blog_id'];

  $sql = "SELECT * FROM blogs WHERE id = '$blog_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)) {
      $data = mysqli_fetch_assoc($result);

      if ($data['author_id'] !== $_SESSION['user_id'])
        echo "<script>window.location.assign('/index.php');</script>";

      echo "<script>
            window.addEventListener('DOMContentLoaded', () => {
              document.getElementsByTagName('textarea')[0].value = `" . $data['content'] .
        "`;
          })
          </script>";

      if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $category = $_POST['category'];
        $content = $_POST['content'];

        $readingTime = calculateReadingTime($content);

        $filename = "tk_" . uniqid() . "-" . time();
        $extension  = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $basename   = $filename . "." . $extension;
        $source       = $_FILES["file"]["tmp_name"];
        $destination = "../images/{$basename}";
        move_uploaded_file($source,  $destination);

        $sql = "INSERT INTO `blogs`(`title`, `category`, `readingTime`, `content`, `author_id`, `thumbnail`) 
          VALUES ('$title', '$category', '$readingTime' ,'$content', '$user_id', '$destination')";

        if ($result = mysqli_query($conn, $sql))
          echo "<script>alert('Blog Post Updated Successfully!')</script>";
      }
    }
  }
}

?>

<?php if ($data) :  ?>
  <div class="form__container">
    <h2>
      The Perspective Changes
      <p>The Greatness Remains</p>
    </h2>
    <form method="post">
      <div class="wrapper">
        <label for="title">Blog Title</label>
        <input type="text" name="title" value="<?php echo $data['title']; ?>" />
      </div>
      <div class="wrapper">
        <label for='category'>Blog Category</label>
        <select name="category">
          <option value="Technology">Technology</option>
          <option value="Business">Business</option>
          <option value="Health">Health</option>
          <option value="Politics">Politics</option>
          <option value="Productivity">Productivity</option>
        </select>
      </div>
      <div class="wrapper">
        <label for="content">Blog Content</label>
        <textarea id="blog__content" name="content" value="<?php echo $data['content']; ?>"></textarea>
      </div>
      <div class="wrapper">
        <label for="file">Blog Thumbnail</label>
        <input type="file" name="file" id="file" />
      </div>
      <button name="update" type="submit">Update</button>
    </form>
  </div>

<?php else : ?>
  <script>
    window.location.href = "/not_found.php";
  </script>
<?php endif ?>

<?php include_once("../layout/footer.php"); ?>