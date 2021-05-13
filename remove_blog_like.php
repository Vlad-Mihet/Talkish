<?php
header("Access-Control-Allow-Origin: *");
$conn = mysqli_connect("127.0.0.1", "root", "", "talkish");

if (isset($_POST['blog_id']) && isset($_POST['user_id'])) {
  $blog_id = $_POST['blog_id'];
  $user_id = $_POST['user_id'];

  $sql = "DELETE FROM likes WHERE blog_id = '$blog_id'
          AND user_id = '$user_id'";

  if ($result = mysqli_query($conn, $sql)) {
    $sql = "SELECT COUNT(*) AS num_likes FROM likes WHERE blog_id = '$blog_id'";

    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result)['num_likes'];

        if (!$data)
          echo "No Likes";

        if ($data == 1)
          echo "1 Like";

        if ($data >= 2)
          echo $data . " Likes";
      } else return "No Likes";
    }
  } else
    echo json_encode(array([
      'result' => 'fail!'
    ]));
}
