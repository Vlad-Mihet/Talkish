<?php

if (isset($_GET['blog_id'])) {
  $blog_id = $_GET['blog_id'];

  $sql = "SELECT * FROM blogs WHERE id = '$blog_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)) {
      $data = mysqli_fetch_assoc($result);

      if ($data['author_id'] !== $_SESSION['user_id'])
        echo "<script>window.location.assign('/index.php');</script>";

      $sql = "DELETE FROM blogs WHERE id = '$blog_id'";

      if ($result = mysqli_query($conn, $sql)) {
        echo "<script>alert('Blog Deleted Successfully!');</script>";
      } else {
        echo "<script>alert('There Was An Error Deleting The Blog. Try Again Later');</script>";
      }
      echo "<script>
      setTimeout(() => {
        window.location.href = '/user/blogs.php';
      }, 750);
      </script>";
    }
  }
}
