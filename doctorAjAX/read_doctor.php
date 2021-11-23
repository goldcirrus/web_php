<!DOCTYPE html>
<html>
<head>
  <title>Read a Doctor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>



<body>
<?php   //include header file stored in hotdoc/incl folder
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";    //incl foler is in web's root directory
include($INC_DIR. "header.php");
?>



<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Read a Doctor's Record</h2>
                    <form>
                        <div class="alert alert-danger">          
                            <input id="DID" type="hidden" value="<?php echo trim($_GET["DoctorID"]);?>"/>   <!--Get URL parameter:DoctorID from search_doctor.php, then it is cleared and can not be used again -->
                            <p>Are you sure you want to read record?</p>
                            <p>                                                                   <!--use value attribute to pass DoctorID via ajax to delete_doctor_server.php-->
                                <button id="btn" type="button" class="btn btn-info">READ</button>
                                <a href="index.php" class="btn btn-secondary">Back to HomePage</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>


    <div id="txtHint"> </div>

<?php   
$INC_DIR = $_SERVER["DOCUMENT_ROOT"]. "/incl/";
include($INC_DIR. "footer.php");
?>

<script>
$(document).ready(function(){
        $("#btn").click(function(){
			var id = document.getElementById('DID').value;
            var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
		            var content = this.responseText;
                    document.getElementById("txtHint").innerHTML = content;
		            //alert(content);
                }
            };
			xmlhttp.open("GET","read_doctor_server.php?DoctorID="+id,true);
            xmlhttp.send();
        });
  });

</script>

</body>
</html>