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
      if (mysqli_num_rows($result) > 0) {
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
      } else {
        $errors['email'] = "Email doesn't exist";
      }
    }
  } else $errors['email'] = "Email doesn't exist";
}

?>

<div class="login__form" action="auth/signup">
  <form method="post">
    <input type="email" name="email" placeholder="Enter Your Email..." />
    <input type="password" name="password" placeholder="Enter Your Password..." />
    <button type="submit" name="submit">Login</button>
    <?php if (!empty($errors)) : ?><div class="errors__wrapper">
        <?php foreach ($errors as $error_type => $error) : ?>
          <p>
            <?php if ($errors["$error_type"]) : ?>
              <?php echo ucfirst($error_type) . " Error: " . $error; ?>
            <?php endif ?>
          </p>
        <?php endforeach ?>
      </div>
    <?php endif ?>
  </form>
  <span>Don't have an account? <a href="register.php">Register Here</a></span>
</div>

<?php include("./layout/footer.php"); ?>