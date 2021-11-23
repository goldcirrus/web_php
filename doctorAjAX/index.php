<?php
//use session to track user authentificatoin. user authentification:database is demo, table is user. 
session_start();       //step1: create a new sesssion

if (isset($_POST['userid']) && isset($_POST['password']))
{
  // if the user had submitted form input and tried to log in
  $userid = $_POST['userid'];
  $password = $_POST['password'];
  
  $options = array("cost"=>4);      //create an association array, key is "cost", value is 4, for hashpassword function
  $hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);    //hash plain text password, $hashPassword is stored in the database

  $db_conn = new mysqli("localhost","root","","demo");   //connect to database:demo

  if (mysqli_connect_errno()) {
    echo 'Connection to database failed:'.mysqli_connect_error();
    exit();
  }
                 //make a query to table:users where column email's value = form's userid input.
  $sql = "select * from users where email='".$userid."'" ;      //password=sha1('".$password."')";
			
  $rs = mysqli_query($db_conn,$sql);
  $numRows = mysqli_num_rows($rs);
	
	if($numRows  == 1){
		$row = mysqli_fetch_assoc($rs);                       //fetch a row from query result
		if(password_verify($password,$row['password'])){      //verify password by hatch function. 
			echo "Password verified";
			$_SESSION['valid_user'] = $userid;               //if pass user validation, step2: register a session variable
		}
		else{
			echo "User found, but Wrong Password";
		}
	}
	else{
		echo "No User found";
	}

  
  
  $db_conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctors</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <title>Home Page</title>
    <style type="text/css">
     
      
      label {
         width: 125px;
         float: left;
         text-align: left;
         font-weight: bold;
      }
      input {
         border: 1px solid #000;
         padding: 3px;
      }
      button {
         margin-top: 12px;
      }
    </style>
  
  <style>
  div {
    background-color: linen;
    margin: 0px 0 25px 0;
    padding: 10px;
  }
  </style>
</head>

<body>

<?php   //include header file stored in hotdoc/incl folder
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";    //incl foler is in web's root directory
include($INC_DIR. "header.php");
?>

  
<div class="container">
  <div class="mt-5 mb-3 clearfix">
     <h2 class="pull-left">User loing in </h2> 
  </div> 
  
  <div>
  <?php
//if session validation is valid, show the login approved contents(go to the page show the doctors), else show the warning, and login form. 
  if (isset($_SESSION['valid_user']))        
  {
    //only if user validation variable exist(pass validation)
    header('Location: doctors.php');  
    //echo '<a href="logout.php">go to Log out page</a></p>';
  }
  else
  {
    if (isset($userid))
    {
      // if they've tried and failed to log in
      echo '<p>Could not log you in.</p>';
    }
    else
    {
      // they have not tried to log in yet or have logged out
	  
	         echo 'You are not logged in. If you are new to here, please register yourself';
			 echo '<p></p>';
             echo '<a href="newuser_register.php" class="btn btn-primary">create new account</a>';
			 echo '<p></p>';
      
      
    }

// provide form to log in
	
    echo '<form action="' .$_SERVER['PHP_SELF']. '" method="post">';
     
      echo '<p>Login Now!</p>';
	  
        echo '<p><label for="userid">UserID:</label>';
        echo '<input type="text" name="userid" id="userid" size="30"/></p>';    //name goes to$_POST['userid']
   
        echo '<p><label for="password">Password:</label>';
        echo '<input type="password" name="password" id="password" size="30"/></p>';    //name goes to $_POST['password']
		
      echo '</fieldset>';
	
      echo '<button type="submit" name="login" class="btn btn-primary">Login</button>';
    echo '</form>';
  }
  
  ?>  
  </div>
  
  
</div>







<?php   
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";
include($INC_DIR. "footer.php");
?>

</body>
</html>