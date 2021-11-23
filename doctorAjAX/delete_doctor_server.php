<?php
// Process update column Hide's value to 1, after confirmation
if(isset($_GET["DoctorID"]) && !empty($_GET["DoctorID"])){     //$_GET["DoctorID"] is from AJAX in delete_doctor.php
        // Get URL parameter
        $DoctorID_Transit =  $_GET["DoctorID"];     //$CourseID_Transit used for query update(only update one course record) according to $searchterm's value-value is sent from form's update_course?CourseID
	    
       // set up for using PDO
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $db_name = 'doctors';

    // set up DSN(database source name)
    $dsn = "mysql:host=$host;dbname=$db_name";

    // connect to database: courses
    try {
      $db = new PDO($dsn, $user, $pass); //create new connection object to database
      // set the PDO error mode to exception
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
      // perform query
      $sql = "UPDATE doctors 
	          SET `Hide`=1
			  WHERE DoctorID=:DoctorID_Transit";  
			  //:CourseID,etc are nameholder to be bind with $CourseID(hold user's form input for CourseID column's value)
      $stmt = $db->prepare($sql);  
	  $stmt->bindValue(':DoctorID_Transit', $DoctorID_Transit); 
      
      $success= $stmt->execute(); 

      // Attempt to execute the prepared statement
            if($success){        // Records created successfully.                 
				echo "delete a doctor from database. ";
				//Redirect to landing page
                header("location: message.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }	  
	    
     
      // disconnect from database
      $db = NULL;
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
      exit;
    }
	
}
?>