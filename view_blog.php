<?php
header("Access-Control-Allow-Origin: *");
$conn = mysqli_connect("127.0.0.1", "root", "", "talkish");

if (isset($_POST['blog_id'])) {
  $blog_id = $_POST['blog_id'];

  $sql = "UPDATE blogs SET views = views + 1 WHERE id = '$blog_id'";

  if ($result = mysqli_query($conn, $sql))
    echo json_encode(array([
      'result' => 'succes!'
    ]));
  else
    echo json_encode(array([
      'result' => 'fail!'
    ]));
}
