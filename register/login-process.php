<?php
// error variable
$error = array();

$phone = sanitize_email($_POST['phone']);
if (empty($phone)) {
  $error[] = "You forgot to enter your Email";
}

$password = sanitize($_POST['password']);
if (empty($password)) {
  $error[] = "You forgot to enter your Password";
}

if (empty($error)) {
  // sql query
  $query = "SELECT * FROM users WHERE phone_no = '$phone' AND permissions = 'customer'";
  $run_query = $con->query($query);
  $row_result = mysqli_fetch_assoc($run_query);
  if (!empty($row_result)) {
    // very password...
    if (password_verify($password,$row_result['password'])) {
      $_SESSION['login'] = $row_result['id'];
      header('Location:index.php');
      exit();
    }else {
      echo display_msg('Check your Phone and password...!');
    }
  }else {
    echo display_msg('You are not a member please register!');
  }
}else {
  echo display_msg('Please Fill out email and password to login');
}
 ?>
