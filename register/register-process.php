<?php
// error variable
$error = array();

$firstName = sanitize($_POST['firstName']);
if (empty($firstName)) {
  $error[] = "You forgot to enter your first Name!";
}

$lastName = sanitize($_POST['LastName']);
if (empty($lastName)) {
  $error[] = "You forgot to enter your last Name!";
}

$phone = sanitize_email($_POST['phone']);
if (empty($phone)) {
  $error[] = "You forgot to enter your Phone!";
}

$referral = sanitize_email($_POST['referral']);

// check email in database...
$query = "SELECT * FROM users WHERE phone_no = '$phone' AND permissions = 'customer'";
$run_query = $con->query($query);
$result = mysqli_num_rows($run_query);
if ($result > 0) {
  $error[] = "You are already registerd!";
}

$password = sanitize($_POST['password']);
if (empty($password)) {
  $error[] = "You forgot to enter your Password!";
}

$confirm_pwd = sanitize($_POST['confirm-pwd']);
if (empty($confirm_pwd)) {
  $error[] = "You forgot to enter your Confirm Password!";
}


if (empty($error)) {
  // Register a new
  $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

  // make a query
  $query = "INSERT INTO `users`(`full_name`, `last_name`, `phone_no`, `password`,`reg_code`)
                         VALUES ('$firstName','$lastName','$phone','$hashed_pass','$referral')";
  $run_query = $con->query($query);

  if ($run_query === true) {
    // start a new session...
    session_start();
    // create session variable...
    $_SESSION['userID'] = mysqli_insert_id($con);

    header('Location:login.php?success=1');
    exit();
  }else {
    echo display_msg('Error while registration...!');
  }

}else {
  echo display_error($error);
}
 ?>
