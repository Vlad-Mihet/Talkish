<?php

$userToBeDeletedId = $_GET['user_id'];

if ($_SESSION && isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT role FROM users WHERE id = '$user_id'";

  if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result)) {
      if (mysqli_fetch_assoc($result)['role'] !== 'admin')
        // User isn't admin 
        echo "<script>window.location.assign('/index.php');</script>";

      // The User Is Admin And We Will Then Have The Permission To Delete The Desired User
      $sql = "DELETE FROM users WHERE users.id = '$userToBeDeletedId'";
      if ($result = mysqli_query($conn, $sql))
        echo "<script>alert('User Deleted Successfully!');</script>";
    } else {
      // User doesn't exist
      echo "<script>window.location.assign('/index.php');</script>";
    }
  } else {
    // Error processing query
    echo "<script>window.location.assign('/index.php');</script>";
  }
} else {
  // User isn't logged in at all
  echo "<script>window.location.assign('/index.php');</script>";
}
