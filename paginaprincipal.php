session_start(); // this will go on top of the page
.........
<?php
if($count == 1) {
    session_register(username);
    session_register(password);

    $_SESSION['username'] = $_POST['username']; // store username
    $_SESSION['password'] = $_POST['password']; // store password

    header('location: index.php');
  }
  else {
    $error = "Invalid Username or Password Please Try Again";
  }
  ?>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?=$error=?>
  Username : <input type="text" name="username">
  Password : <input type="password" name="password">
  <input type="submit" />
  </form>
