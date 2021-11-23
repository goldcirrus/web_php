<?php
    // create short variable names, to get input form user's form entry
    $searchtype=$_GET['searchtype'];           //$searchtype used for query, value is sent from form $_POST. 
    $searchterm="%{$_GET['searchterm']}%";     //$searchterm used for query, value is sent from form input $_POST
	
	echo "from search.php is test test!";

    if (!$searchtype || !$searchterm) {
       echo '<p>You have not entered search details.<br/>
       Please go back and try again.</p>';
       exit;
    }
	else{
		echo "Not receive requeset !";
	}

    // whitelist the searchtype, exit if user input is not CourseID, CourseName, Credit, or Tuition. 
    switch ($searchtype) {
      case 'CourseID':
      case 'CourseName':
      case 'Credit':   
	  case 'Tuition':
        break;
      default: 
        echo '<p>That is not a valid search type. <br/>
        Please go back and try again.</p>';
        exit; 
    }

    // set up for using PDO
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $db_name = 'courses_hide';

    // set up DSN(database source name)
    $dsn = "mysql:host=$host;dbname=$db_name";

    // connect to database
    try {
      $db = new PDO($dsn, $user, $pass); //create new connection object to database

      // perform query
      $sql = "SELECT CourseID, CourseName, Credits, TotalHours, ClassroomType, Tuition, Term, Description 
	          FROM courses 
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
                   echo "<th>CourseID</th>";
                   echo "<th>CourseName</th>";
                   echo "<th>Credits</th>";
                   echo "<th>TotalHours</th>";
                   echo "<th>ClassroomType</th>";
				   echo "<th>Tuition</th>";
				   echo "<th>Term</th>";
				   echo "<th>Description</th>";
				   echo "<th>Opeartions</th>";
                echo "</tr>";
            echo "</thead>";         //end of table-head
                                
			echo "<tbody>";
            while($result = $stmt->fetch(PDO::FETCH_OBJ)){
                echo "<tr>";
                    echo "<td>" .$result->CourseID. "</td>";
                    echo "<td>" .$result->CourseName. "</td>";
                    echo "<td>" .$result->Credits. "</td>";
                    echo "<td>" .$result->TotalHours. "</td>";
					echo "<td>" .$result->ClassroomType. "</td>";
					echo "<td>" .number_format($result->Tuition, 2). "</td>";
					echo "<td>" .$result->Term. "</td>";
					echo "<td>" .$result->Description. "</td>";					
                    echo "<td>";
					      echo '<div class="btn-group">';
                          echo '<a href="read_course.php?CourseID='.$result->CourseID.'" class="btn btn-primary">read</a>';
                          echo '<a href="update_course.php?CID='.$result->CourseID.'" class="btn btn-primary">update</a>';
                          echo '<a href="delete_course.php?CID='.$result->CourseID.'" class="btn btn-primary">delete</a>';
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