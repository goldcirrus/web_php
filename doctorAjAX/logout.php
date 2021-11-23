<?php
  session_start();          //if a session already exist, use the existing session

                                           // if old session exist, store to test if they *were* logged in
  $old_user = $_SESSION['valid_user'];
  
  unset($_SESSION['valid_user']);        //clear out the session variable: valid_user
  session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
   <title>Log Out</title>
</head>

<body>
<h1>Log Out</h1>

<?php
  if (!empty($old_user))      //if $old_use has a old session variable's value
  {
    echo "<p>user $old_user have been logged out.</p>";
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo '<p>You were not logged in, and so have not been logged out.</p>';
  }
?>
<p><a href="index.php">Back to Home Page</a></p>

</body>
</html>