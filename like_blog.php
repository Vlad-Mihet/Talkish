<?php
header("Access-Control-Allow-Origin: *");
$conn = mysqli_connect("127.0.0.1", "root", "", "talkish");

if (isset($_POST['blog_id']) && isset($_POST['user_id'])) {
  $blog_id = $_POST['blog_id'];
  $user_id = $_POST['user_id'];

  $sql = "INSERT INTO `likes`(`blog_id`, `user_id`)
          VALUES ('$blog_id', '$user_id')";

  if ($result = mysqli_query($conn, $sql))
    echo json_encode(array([
      'result' => 'succes!'
    ]));
  else
    echo json_encode(array([
      'result' => 'fail!'
    ]));
}
