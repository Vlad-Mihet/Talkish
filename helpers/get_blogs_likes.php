<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "talkish");


if (isset($_POST['blog_id'])) {
  $blog_id = $_POST['blog_id'];
  $sql = "SELECT COUNT(*) AS num_likes FROM likes WHERE blog_id = '$blog_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
      $data = mysqli_fetch_assoc($result)['num_likes'];

      if (!$data)
        return "No Likes";

      if ($data == 1)
        return "1 Like";

      if ($data >= 2)
        return $data . " Likes";
    } else return "No Likes";
  }

  return;
}
