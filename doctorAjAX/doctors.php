<?php
  session_start();    //if session already created, use the existing session's variable:$_SESSION['valid_user'] from index.php
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <title>Doctors HomePage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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


  
<div class="container">
  <div>
  <?php
  // check session variable
  if (isset($_SESSION['valid_user']))
  {
    echo '<p><i>You are logged in as user: '.$_SESSION['valid_user'].'</i></p>';
  }
  else
  {
    echo '<p>You are not logged in.</p>';
    echo '<p>Only logged in members may see this page.</p>';
  }
  ?>
  </div>


  
 
  
  
  <div class="mt-5 mb-3 clearfix">
     <h2 class="pull-left">Search doctors</h2> 
  </div>

  <form>
	 <div class="form-group">
     <p><strong>Enter Search Term Text:</strong><br>
        <input id="iterm" name="searchterm" value="" type="text" size="40">
	 </p>		  
     </div>  
  
  
     <div class="form-group">
      <label for="sel"><strong>Select search type (select one):</strong></label>
      <select id="itype" name="searchtype" class="form-control" id="sel" onchange="showUser(this.value,document.getElementById('iterm').value )">
        <option value="">--Please Select--</option>
		<option value="DoctorID">Doctor ID</option>
        <option value="DoctorName">Doctor Name</option>
        <option value="PostalCode">Post Code</option>
        <option value="Country">Country</option>
		<option value="Phone">Phone</option>		
      </select>
     </div>
	 
  </form>
  
 
   
   <div id="txtHint">  </div> 
   
  
  
  <!-- form to insert a new doctor-->
       <div class="wrapper">
        <div class="container-fluid">
		    <h3 class="mt-5">Please fill this form and submit it to add a new doctor record to the database.</h3><br>
          
            <div class="row">
                <div class="col-md-12">                  
                    
                    <form id="form1">
                        <div class="form-group">
                            <label><b>Doctor ID</b></label>
                            <input id="DID" type="text" name="DoctorID" maxlength="7" size="7" class="form-control" >                            
                        </div>
						
                        <div class="form-group">
                            <label><b>Doctor Name</b></label>
                            <input id="Dname" type="text" name="DoctorName" maxlength="68" class="form-control">
                        </div>
						
                        <div class="form-group">
                            <label><b>Postal Code</b></label>
                            <input id="PCode" type="text" name="PostalCode" class="form-control" >
                        </div>
						
						<div class="form-group">
                            <label><b>Country</b></label>
                            <input type="text" id="Country" name="Country" class="form-control" >                            
                        </div>
						
						<div class="form-group">
                            <label><b>Phone</b></label>
                            <input type="text" id="Phone"name="Phone" class="form-control">                            
                        </div>
						
						
                        <input type="submit" onclick="addDoctor(document.getElementById('DID').value, document.getElementById('Dname').value, document.getElementById('PCode').value, document.getElementById('Country').value, document.getElementById('Phone').value)" class="btn btn-success pull-right" value="Insert New Doctor">     <!--submit to call php program in this own file(action=..) -->
                        
                    </form>
                </div>
            </div>        
        </div>
     </div>
  
  
  
  <p><?php echo '<a href="logout.php" class="btn btn-primary">User Log out</a></p>'; ?> </p>
   
</div>



<?php   
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";
include($INC_DIR. "footer.php");
?>

  <script>
function showUser(str,str2) {
  if (str == "" || str2=="") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		document.getElementById("txtHint").innerHTML = "aaa";
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","search_doctor.php?searchtype="+str+"&searchterm="+str2,true);
    xmlhttp.send();
  }
}




function addDoctor(id, name, pcode, country, phone){
	  if (id== "" || name=="" || pcode=="" || country=="" || phone=="") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		
      if (this.readyState == 4 && this.status == 200) {
           document.getElementById("txtHint").innerHTML = this.responseText;
		   alert(this.responseText);
		   console.log(this.responseText);
		   
      }
    };
	
    xmlhttp.open("GET","insert_doctor.php?DoctorID="+id+"&DoctorName="+name+"&PostalCode="+pcode+"&Country="+country+"&Phone="+phone,true);
    xmlhttp.send();
  }	
}
  //document.getElementById("s1").innerHTML = "xxxxx";
	
function readDoctor(id){
	if (id == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
		document.getElementById("txtHint").innerHTML = "aaa";
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","read_doctor.php?DoctorID="+id,true);
    xmlhttp.send();
  }
	
}	
  
  
  
  
  $(document).ready(function(){
        //$("a").click(function(){
     //alert("aa");
//});
  });
  
  
  
     
      
       document.addEventListener('DOMContentLoaded', function(){		   
		   
	   });
  </script>

</body>
</html>