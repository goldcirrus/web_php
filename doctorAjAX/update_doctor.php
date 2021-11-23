<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Doctor Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

<?php   //include header file stored in hotdoc/incl folder
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";    //incl foler is in web's root directory
include($INC_DIR. "header.php");
?>


     <div class="wrapper">
        <div class="container-fluid">
		    <h3 class="mt-5">Please fill this form and submit it to update a doctor record to the database.</h3><br>
          
            <div class="row">
                <div class="col-md-12">                  
                    
                    
                        <form>
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
						
						
                        <input type="submit" onclick="updateDoctor(document.getElementById('DID').value, document.getElementById('Dname').value, document.getElementById('PCode').value, document.getElementById('Country').value, document.getElementById('Phone').value)" class="btn btn-success pull-right" value="Update Doctor">     <!--submit to call php program in this own file(action=..) -->
						
                            <!--submit to call php program in this own file(action=..) -->
                        <a href="index.php" class="btn btn-secondary ml-2">Back to Home Page</a>
                    </form>
                </div>
            </div>        
        </div>
     </div>
	 
	 <div id="txtnote"></div>
	 
<?php   //include footer in hotdoc/incl folder
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";
include($INC_DIR. "footer.php");
?>

<script>
    function updateDoctor(id, name, pcode, country, phone){
	  if (id== "" || name=="" || pcode=="" || country=="" || phone=="") {
      document.getElementById("txtnote").innerHTML = "";
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
	
    xmlhttp.open("GET","update_doctor_server.php?DoctorID="+id+"&DoctorName="+name+"&PostalCode="+pcode+"&Country="+country+"&Phone="+phone,true);
    xmlhttp.send();
  }
	
}

</script>


</body>
</html>
  
  
  