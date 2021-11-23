<?php
    // create short variable names, to get input form user's form entry
    $searchtype=$_GET['searchtype'];           //$searchtype used for query, value is sent from form $_POST. 
    $searchterm="%{$_GET['searchterm']}%";     //$searchterm used for query, value is sent from form input $_POST
	
	echo "ajax request sent to search_doctor.php successfully.";

    if (!$searchtype || !$searchterm) {
       echo '<p>You have not entered search details.<br/>
       Please go back and try again.</p>';
       exit;
    }
	else{
		echo " Receive search content!";
	}

    // whitelist the searchtype, exit if user input is not CourseID, CourseName, Credit, or Tuition. 
    switch ($searchtype) {
      case 'DoctorID':
      case 'DoctorName':
      case 'PostalCode':   
	  case 'Country':
	  case 'Phone':
        break;
      default: 
        echo '<p>That is not a valid search type. <br/> Please go back and try again.</p>';
        exit; 
    }

    // set up for using PDO
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $db_name = 'doctors';

    // set up DSN(database source name)
    $dsn = "mysql:host=$host;dbname=$db_name";

    // connect to database
    try {
      $db = new PDO($dsn, $user, $pass); //create new connection object to database

      // perform query
      $sql = "SELECT *
	          FROM doctors
			  WHERE $searchtype LIKE :searchterm and Hide=0";  
      $stmt = $db->prepare($sql);  
      $stmt->bindParam(':searchterm', $searchterm);      //bind $searchterm to query's :searchterm
      $stmt->execute(); 

      // get number of returned rows  
      echo "<p>Number of books found: ".$stmt->rowCount()."</p>"; 

      // display each returned row
    
	  
	  
	  echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
                echo "<tr>";         //1st bable-row start, also table-head
                   echo "<th>DoctorIDID</th>";
                   echo "<th>DoctorName</th>";
                   echo "<th>PostalCode</th>";
                   echo "<th>Country</th>";
                   echo "<th>Phone</th>";			
                   echo "<th>RUD Operations</th>";				   
                echo "</tr>";
            echo "</thead>";         //end of table-head
                                
			echo "<tbody>";
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                echo "<tr>";
                    echo "<td id='DID_search'>" .$result->DoctorID. "</td>";
                    echo "<td>" .$result->DoctorName. "</td>";
                    echo "<td>" .$result->PostalCode. "</td>";
                    echo "<td>" .$result->Country. "</td>";
					echo "<td>" .$result->Phone. "</td>";
									
                    echo "<td>";
					      echo '<div class="btn-group">';
                          echo '<a href="read_doctor.php?DoctorID='.$result->DoctorID.'"class="btn btn-primary">read</a>';
                          echo '<a href="update_doctor.php?DoctorID='.$result->DoctorID.'" class="btn btn-primary">update</a>';
                          echo '<a href="delete_doctor.php?DoctorID='.$result->DoctorID.'" class="btn btn-primary">delete</a>';
						  echo '</div>';
                    echo "</td>";
                echo "</tr>";
            }
			echo "</tbody>";                            
      echo "</table>";

      // disconnect from database
      $db = NULL;
    } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
      exit;
    }
  ?>
  
  
  