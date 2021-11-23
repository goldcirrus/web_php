<?php  /*
  if (!isset($_SERVER['HTTPS'])) {
    $url = 'https://' . $_SERVER['HTTP_HOST'] .
           $_SERVER['REQUEST_URI'];  // start with /...
    header("Location: " . $url);  // Redirect - 302
    exit();                         // should be before any output
  }                               // 
*/
?>

<?php 
require_once("config.php");

/*checking if the form is submitted or not: The name of the submit button is “submit”.
  When the submit button is pressed the $_POST['submit'] will be set and the IF condition will become true. 
  In this case, php codes can get user inputs to make database query.
  If the form is not submitted, the IF condition will be FALSE, as there will be no values in $_POST['submit'] 
  and PHP code will not be executed. In this case, only the form will be shown.*/
if(isset($_POST['submit'])){    
	
	echo "User Has submitted the form.";
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	
	$sql = "select * from users where email = '".$email."'";    //email is used as the user name to query database
	$rs = mysqli_query($conn,$sql);
	$numRows = mysqli_num_rows($rs);
	
	if($numRows  == 1){
		$row = mysqli_fetch_assoc($rs);
		if(password_verify($password,$row['password'])){      //verify password via hash function: password_verify()
			echo "Password verified";
		}
		else{
			echo "Wrong Password";
		}
	}
	else{
		echo "No User found";
	}
}
?>
<html>
<body>
<h1>Login</h1>
                    <!--This PHP code is above the HTML part and will be executed first.  -->
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">     
	<input type="text" name="email" value="" placeholder="Email">	
	<input type="password" name="password" value="" placeholder="Password">
	<button type="submit" name="submit">Submit</button>	
</form>

<h1>Register a new user</h1>

<a href="registration.php">regsiter a new user</a>

</body>

</html>