<!DOCTYPE html>
<html lang="en">

<head>
  <title>new user registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
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

<?php  
     //connect to database:demo
$conn = mysqli_connect("localhost","root","","demo");

if(!$conn){
	die("Connection error: " . mysqli_connect_error());	
}

 //1st step, input user name(email), password(hash functioned)
if(isset($_POST['submit'])){
		$firstName = $_POST['first_name'];
		$surName = $_POST['surname'];
		$email 	= $_POST['email'];
		$password = $_POST['password'];
		
		$options = array("cost"=>4);      //create an association, key is "cost", value is 4
		$hashPassword = password_hash($password,PASSWORD_BCRYPT,$options);    //hash plain text password, $hashPassword is stored in the database
		
		$sql = "insert into users (first_name, last_name,email, password) value('".$firstName."', '".$surName."', '".$email."','".$hashPassword."')";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			echo "<h2>Registration successfully</h2>";
		}
	}
?>





  
<div class="container">
   <div class="mt-5 mb-3 clearfix">
     <h2 class="pull-left">Register a new user</h2> 
   </div>
  
   <div>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	    <input type="text" name="first_name" value="" placeholder="First Name">
    	<input type="text" name="surname" value="" placeholder="Surname">
	    <input type="text" name="email" value="" placeholder="Email">
	    <input type="password" name="password" value="" placeholder="Password">
	    <button type="submit" name="submit" class="btn btn-primary">Submit</submit>
   </form>
   </div>
  
   <div class="mt-5 mb-3 clearfix">
      <h2> <a href="index.php" class="btn btn-secondary ml-2">Back to HomePage</a> </h2>
   </div>
  
</div>
   




<?php   
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";
include($INC_DIR. "footer.php");
?>

</body>
</html>