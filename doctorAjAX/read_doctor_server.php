<?php
// Check existence of id parameter before processing further
if(isset($_GET["DoctorID"]) && !empty(trim($_GET["DoctorID"]))){
	
	$searchterm=$_GET['DoctorID'];     //$searchterm used for query, value is sent from form's search_doctor.php's echo <a href...
	
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
      $sql = "SELECT * FROM doctors WHERE DoctorID = :searchterm";  
      $stmt = $db->prepare($sql);  
      $stmt->bindParam(':searchterm', $searchterm);
      $stmt->execute(); 

      // get number of returned rows  
      echo "<p>Number of courses found: ".$stmt->rowCount()."</p>"; 

      // display each returned row
    
	  
	  
	  echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
                echo "<tr>";         //1st bable-row start, also table-head
                   echo "<th>DoctorID</th>";
                   echo "<th>DoctorName</th>";
                   echo "<th>PostalCode</th>";
                   echo "<th>Country</th>";
                   echo "<th>Phone</th>";
				echo "</tr>";
            echo "</thead>";         //end of table-head
                                
			echo "<tbody>";
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                echo "<tr>";
                    echo "<td>" .$result->DoctorID. "</td>";
                    echo "<td>" .$result->DoctorName. "</td>";
                    echo "<td>" .$result->PostalCode. "</td>";
                    echo "<td>" .$result->Country. "</td>";
					echo "<td>" .$result->Phone. "</td>";
				echo "<td>";
					      echo '<div class="btn-group">';
                          echo '<a href="index.php" class="btn btn-primary">Back to Search</a>';                          
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
	
	
	
}
    
?>