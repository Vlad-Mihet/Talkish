<?php
include_once('../layout/navbar.php');

$user = null;

if ($_SESSION && isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM users WHERE id = '$user_id'";

  if ($result = mysqli_query($conn, $sql))
    $user = mysqli_fetch_assoc($result);

  if (isset($_POST['save'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', email = '$email' WHERE id = '$user_id'";

    $result = mysqli_query($conn, $sql);
  }

  function getLoggedUserData($conn)
  {
    if (isset($_SESSION) && $_SESSION['user_id']) {
      $user_id = $_SESSION['user_id'];

      $sql = "SELECT firstName, lastName FROM users WHERE id = '$user_id'";

      if ($result = mysqli_query($conn, $sql)) {
        $data = mysqli_fetch_assoc($result);

        return $data;
      }
    }
  }
} else echo "<script>window.location.href='index.php';</script>";

?>



<div id="account__container">
  <div class="top__bar">
    <h2>Hello, <?php echo getLoggedUserData($conn)['firstName'] ?>!</h2>
    <ul>
      <li>
        <a href="/user/blogs.php">Your Blogs</a>
      </li>
      <li>
        <a href="/user/settings.php">Settings</a>
      </li>
    </ul>
  </div>

  <h3>Settings</h3>

  <div id="settings__container">
    <h4>Account Info</h4>

    <div class="accountInfo__container">
      <form method="post">
        <div class="wrapper">
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" value="<?php echo $user['firstName']; ?>" />
        </div>
        <div class="wrapper">
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" value="<?php echo $user['lastName']; ?>" />
        </div>
        <div class="wrapper">
          <label for="email">Email</label>
          <input type="text" name="email" value="<?php echo $user['email']; ?>" />
        </div>
        <div class="wrapper">
          <input type="submit" name="save" value="Save" />
        </div>
      </form>
    </div>
  </div>
</div>

<?php include_once("../layout/footer.php"); ?>