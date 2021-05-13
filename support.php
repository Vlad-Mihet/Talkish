<?php

include_once("./layout/navbar.php");

if (!empty($_SESSION) && isset($_SESSION['user_id'])) : ?>
  <?php $user_id = $_SESSION['user_id'];


  if (isset($_POST['submit_request'])) {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $details = $_POST['details'];

    // Upload Request Attachment

    // Create Custom Attachment File Names
    $filename = "tk_support_" . uniqid() . "-" . time();
    $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $basename = $filename . "." . $extension;
    $source = $_FILES["file"]["tmp_name"];
    $destination = "/support_attachments/{$basename}";
    move_uploaded_file($source,  $destination);

    $sql = "INSERT INTO `support_requests`(`title`, `category`, `details`, `attachment`, `user_id`) 
          VALUES ('$title', '$category', '$details', '$destination', '$user_id')";

    if ($result = mysqli_query($conn, $sql))
      echo "<script>alert('Support Request Submitted Successfully!')</script>";
  } ?>

  <div id="support__container">
    <h2>
      Have a problem?
      <p>Don't worry, we're here</p>
    </h2>
    <p>Submit a request and our team will handle it in the shortest timeframe possible.</p>
    <form method="post">
      <div class="wrapper">
        <label for='title'>Request Title</label>
        <input type="text" name="title" placeholder="Request Title" />
      </div>
      <div class="wrapper">
        <label for='category'>Request Category</label>
        <select name="category">
          <option value="Bug">Bug</option>
          <option value="Feature Request">Feature Request</option>
          <option value="How To">How To</option>
          <option value="Technical Issue">Technical Issue</option>
        </select>
      </div>
      <div class="wrapper">
        <label for="content">Details</label>
        <textarea id="blog__content" name="details" value="<?php echo $data['content']; ?>" placeholder="Please Provide Some Details Regarding Your Issue"></textarea>
      </div>
      <div class="wrapper">
        <label for="file">Issue Attachment (Optional)</label>
        <input type="file" name="file" id="file" />
      </div>
      <button name="submit_request" type="submit">Submit Request</button>
    </form>
  </div>
<?php else : ?>
  <div id="not_logged_support">
    <div class="top">
      <h2>
        Have a problem?
        <p>Don't worry, we're here</p>
      </h2>
      <p>Submit a request and our team will handle it in the shortest timeframe possible.</p>
    </div>
    <div class="bottom">
      <p>It looks like you aren't currently logged in.</p>
      <p>Before we can offer our support we would ask you to log in and come back to this page in order to get all the support you may need.</p>
      <p>Log In <a href="login.php">Here</a></p>
    </div>
  </div>
<?php endif  ?>



<?php
include_once("./layout/footer.php");
?>