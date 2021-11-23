  <?php
  
    echo "first line from insert_doctor.php ";
	
	// Define variables to hold form input data, and initialized with empty values
   $DoctorID = $DoctorName = $PostalCode = $Country = $Phone = "";
    // define variable_err to hold error message when input validation fails. 
   $DoctorID_err = $DoctorName_err = $PostalCode_err = $Country_err = $Phone_err = "";

      

   // Processing form data validation when form is submitted
	 
    // Validate CourseID input from user. only allow 7 letters 
    $input_DoctorID = trim($_GET["DoctorID"]);
    if(empty($input_DoctorID)){
        echo "Please enter a DoctorID.";
    } elseif(!filter_var($input_DoctorID, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9\s]+$/")))){
        echo "Please enter a valid doctor ID.";
    } else{
        $DoctorID = $input_DoctorID;             //when pass validation, $CoursID  to hold form input data for CourseID
    }
    
    // Validate CourseName from user input.
    $input_DoctorName = trim($_GET["DoctorName"]);
    if(empty($input_DoctorName)){
        $DoctorName_err = "Please enter an doctor Name.";     
    } else{
        $DoctorName = $input_DoctorName;             //when pass validation, $CoursName to hold form input data 
    }
    
    // Validate credits from user input
    $input_PostalCode = trim($_GET["PostalCode"]);
    if(empty($input_PostalCode)){
        $PostalCode_err = "Please enter the Postal Code.";     
    } else{
        $PostalCode = $input_PostalCode;
    }
	
	// Validate Tuition from user input
    $input_Country = trim($_GET["Country"]);
    if(empty($input_Country)){
        $Country_err = "Please enter the Country.";     
    } else{
        $Country = $input_Country;
    }
	
	// Validate Term from user input
    $input_Phone = trim($_GET["Phone"]);
    if(empty($input_Phone)){
        $Phone_err = "Please enter the Phone.";     
    } else{
        $Phone = $input_Phone;
    }
	
		
	//no need to input for Hide column, it is automatically inserted as boolean 0 as default. 
	
	
	

    //start database operation, if(form input has no err) then, 
    if(empty($DoctorID_err) && empty($DoctorName_err) && empty($PostalCode_err)&&empty($Country_err)&&empty($Phone_err))
	{
		
    echo "start to connect to database from inser_doctor.php  ";
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
      $sql = "INSERT INTO doctors 
	          (DoctorID, DoctorName, PostalCode, Country, Phone)  
			  VALUES (:DoctorID, :DoctorName, :PostalCode, :Country, :Phone)";  
			  //:CourseID,etc are nameholder to be bind with $CourseID(hold user's form input for CourseID column's value)
      $stmt = $db->prepare($sql);  
      $stmt->bindValue(':DoctorID', $DoctorID);        
	  $stmt->bindParam(':DoctorName', $DoctorName);
	  $stmt->bindValue(':PostalCode', $PostalCode);
	  $stmt->bindParam(':Country', $Country);
	  $stmt->bindValue(':Phone', $Phone);
	  
      $success = $stmt->execute(); 

      // Attempt to execute the prepared statement, if Records created successfully.   
      if($success){                      
		  echo "Add a new doctor successfully. ";
			               //Redirect to landing page
       // header("location: message.php");
	   
      } 
	  else{
           echo "Oops! Something went wrong. Please try again later.";
      }	  
	    
     
      // disconnect from database
      $db = NULL;
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
      exit;
    }
	
	}
	
	
	echo "from the very end of insert_doctor.php!";
 
	
?>


