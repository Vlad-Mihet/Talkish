<?php
include("./layout/navbar.php");

if (isset($_POST['submit'])) {
  $errors = [
    "email" => "",
    "password" => "",
  ];

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT email FROM users WHERE email = '$email'";

  if ($result = mysqli_query($conn, $sql)) {
    $sql = "SELECT id, password FROM users WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      $data = mysqli_fetch_row($result);
      $db_pass = $data[1];
      $id = $data[0];

      if (password_verify($password, $db_pass)) {
        $_SESSION['user_id'] = $id;
        echo "<script>
                alert('Logged In Successfully! Redirecting you home...');
                setTimeout(() => {
                  window.location.href = 'index.php';
                }, 750)
              </script>";
      } else $errors['password'] = "Wrong Password";
    }
  } else $errors['email'] = "Email doesn't exist";
}

?>

<div class="login__form" action="auth/signup">
  <form method="post">
    <input type="email" name="email" placeholder="Enter Your Email..." />
    <input type="password" name="password" placeholder="Enter Your Password..." />
    <button type="submit" name="submit">Login</button>
  </form>
  <span>Don't have an account? <a href="register.php">Register Here</a></span>
</div>

<?php include("./layout/footer.php"); ?>