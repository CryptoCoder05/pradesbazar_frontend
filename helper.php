<?php

// sanatize input string
function sanitize($textValue){
  if (!empty($textValue)) {
    $trim_text = trim($textValue);
    $sanitize_str = filter_var($trim_text,FILTER_SANITIZE_STRING);
    return $sanitize_str;
  }
  return '';
}

// sanatize input email
function sanitize_email($emailValue){
  if (!empty($emailValue)) {
    $trim_text = trim($emailValue);
    $sanitize_str = filter_var($trim_text,FILTER_SANITIZE_EMAIL);
    return $sanitize_str;
  }
  return '';
}

// profile image
function upload_profile($path, $file){
    $targetDir = $path;
    $default = "beard.png";

    // get the filename
    $filename = basename($file['name']);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    If(!empty($filename)){
        // allow certain file format
        $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if(in_array($fileType, $allowType)){
            // upload file to the server
            if(move_uploaded_file($file['tmp_name'], $targetFilePath)){
                return $targetFilePath;
            }
        }
    }
    // return default image
    return $path . $default;
}

// get users info...
function get_users_info($con, $userID){
  $query = "SELECT * FROM users WHERE id = '$userID'";
  $run_query = $con->query($query);
  $result = mysqli_fetch_assoc($run_query);
  if (empty($result)) {
    return false;
  }else {
    return $result;
  }
}

function display_error($error_data){
  foreach ($error_data as $e) {
    ?>
    <script>
    $(document).ready(function() {
      var errors = '<?= $e; ?>';
      $("#errors").text(errors);
    });
    </script>
    <?php
  }
}

function display_msg($msg){
?>
<script>
$(document).ready(function() {
  var errors = '<?= $msg; ?>';
  $("#errors").text(errors);
});
</script>
<?php
}

// check if login or not...
function is_login(){
  if (isset($_SESSION['login'])) {
    $_SESSION['login'];
    return true;
  }else {
    return false;
  }
}

// redirect location...
function redirect($path){
  header('Location:'.$path);
}

// money formate...
function money($number){
  return 'Rs. '.number_format($number,0);
}





 ?>
