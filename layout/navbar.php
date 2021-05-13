<?php

$conn = mysqli_connect("127.0.0.1", "root", "", "talkish");
session_start();

function isAdmin($conn)
{
  $logged = false;
  if ($_SESSION && isset($_SESSION['user_id']))
    $logged = true;

  if ($logged) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT role FROM users WHERE id = '$user_id'";

    if ($result = mysqli_query($conn, $sql))
      if (mysqli_num_rows($result) > 0)
        if (mysqli_fetch_assoc($result)['role'] === 'admin')
          return true;
    return false;
  }
}

function isLoggedIn()
{
  if ($_SESSION && isset($_SESSION['user_id'])) return true;
  return false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../scss/index.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <title>Talkish</title>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <script>
    function view_blog_func(blog_id) {
      console.log(blog_id);
      $.ajax({
        type: 'POST',
        url: '/view_blog.php',
        crossDomain: true,
        dataType: 'json',
        data: {
          blog_id
        },
        success: function(result) {
          console.log(result[0].result)
        }
      })
    }
  </script>

  <script>
    function like_blog_func(blog_id, user_id) {
      $.ajax({
        type: 'POST',
        url: '/like_blog.php',
        crossDomain: true,
        dataType: 'json',
        data: {
          blog_id,
          user_id
        },
        success: function(result) {
          console.log(result[0].result)
        }
      })
    }
  </script>

  <script>
    function remove_like_blog_func(blog_id, user_id) {
      $.ajax({
        type: 'POST',
        url: '/remove_blog_like.php',
        crossDomain: true,
        dataType: 'json',
        data: {
          blog_id,
          user_id
        },
        success: function(result) {
          console.log(result[0].result)
        }
      })
    }
  </script>

  <script>
    // Here we'll get the document height
    function getDocHeight() {
      var D = document;
      return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
      );
    }

    // Template to check if we're on a blog page
    let url = window.location.href;

    if (url.indexOf('blog.php?blog_id=') !== -1) {
      let scrolled = false;
      let blog_id = url.split('blog_id=')[1];
      let viewed = false;

      // Start a timer as soon as the user enters the blog page that will 
      // be checked as well when he reaches the bottom of the page

      // Declare it as a var in order to access it globally
      var activeSeconds = 0;

      // We'll increment the timer each second to track the time spent on the blog page
      var timer = setInterval(() => {
        activeSeconds++;

        if (!viewed) {
          if (activeSeconds >= 25) {
            view_blog_func(blog_id);
            viewed = true;
            clearInterval(timer)
          }

          if (scrolled === true && activeSeconds >= 15) {
            view_blog_func(blog_id);
            viewed = true;
            clearInterval(timer)
          }
        }

      }, 1000)

      $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() == getDocHeight()) {
          scrolled = true;
          // We'll check the timer as well to make sure it was't a bot that made the request
          // Or it wasnt a spam scroll or anything similar
        }
      });
    }
  </script>
</head>

<nav class="header">
  <div class="wrapper">
    <h2 onclick="window.location.href = '/index.php'">Talkish</h2>
    <div class="options">
      <ul>
        <li>
          <a href="/index.php">View Blogs</a>
        </li>
        <?php if (isLoggedIn()) : ?>
          <li>
            <a href="/user/publish_blog.php">Publish</a>
          </li>
          <li>
            <?php if (isAdmin($conn)) : ?>
              <a href="/admin/dashboard.php">Dashboard</a>
            <?php else : ?>
              <a href="/user/blogs.php">Your Account</a>
            <?php endif ?>
          </li>
          <li>
            <a href="/logout.php">Log Out</a>
          </li>
        <?php else : ?>
          <li>
            <a href="/login.php">Log In</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>

<body>