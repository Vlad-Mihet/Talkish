<?php
include("./layout/navbar.php");

function isUnique($email, $conn)
{
  $sql = "SELECT * FROM users WHERE email = '$email'";

  if ($result = mysqli_query($conn, $sql))
    if (mysqli_num_rows($result) > 0) return false;

  return true;
}

if (isset($_POST['submit'])) {
  $errors = [
    'email' => "",
    'password' => ""
  ];

  $email = $_POST['email'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];


  if ($password !== $confirm_password) {
    $errors['password'] = "Make sure your password matches the confirmation password";
    echo ('x');
  } else {
    // Check if the email is unique
    if (isUnique($email, $conn)) {
      $hash = password_hash($password, PASSWORD_BCRYPT);

      $sql = "INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`)
              VALUES ('$firstName', '$lastName', '$email', '$hash')";

      var_dump($sql);

      if ($result = mysqli_query($conn, $sql)) {
        echo "<script>alert('Account Created Successfully!');";

        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $_SESSION['user_id'] = mysqli_fetch_assoc($result)['id'];

        echo "<script>window.location.href = 'index.php';</script>";
      }
    } else {
      $errors['email'] = "That email is already registered.";
      echo ('y');
    }
  }
}



?>

<div class="register__form">
  <form method="post">
    <input type="text" name="firstName" placeholder="Enter Your First Name..." />
    <input type="text" name="lastName" placeholder="Enter Your Last Name..." />
    <input type="email" name="email" placeholder="Enter Your Email..." />
    <input type="password" name="password" placeholder="Enter Your Password..." />
    <input type="password" name="confirm_password" placeholder="Enter Your Password..." />
    <button type="submit" name="submit">Register</button>
  </form>
  <span>Already have an account? <a href="login.php">Login Here</a></span>
</div>

<?php include("./layout/footer.php"); ?>