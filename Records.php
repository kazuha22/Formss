<?php 

$conn=mysqli_connect('localhost','root','','aelijion');

$notif='';


    if(isset($_POST['btnInsert'])){

        $fname=$_POST['fname'];
        $address=$_POST['address'];
        $age=$_POST['age'];
        $emailaddress=$_POST['emailaddress'];

        $sql="INSERT INTO user(Fullname,Complete_Address,Age,Email_Address)VALUES ('$fname','$address','$age','$emailaddress' )";

       

        if($conn->query($sql)==TRUE){
            
            echo $notif="Successfully Added!!";

        }else{
            
            echo  $notif="ERROR NOT INSERTED!!";
        
            
            }
            

    }




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    

<center>

<form action="Records.php" method="POST">
    <h1><?php  $notif; ?></h1> 

  <div class="col-md-6 mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Name:</label>
    <input type="text" class="form-control " name="fname" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text"></div>
  </div>
  <div class="col-md-6 mb-3">
    <label for="exampleInputPassword1" class="form-label">Address:</label>
    <input type="text" class="form-control"  name="address">
  </div>

  <div class="col-md-6 mb-3">
    <label for="exampleInputPassword1" class="form-label">Age:</label>
    <input type="number" class="form-control"  name="age">
  </div>

  <div class="col-md-6 mb-3">
    <label for="exampleInputPassword1" class="form-label">Email Address:</label>
    <input type="email" class="form-control"  name="emailaddress">
  </div>
  
  
  <button type="submit"  name="btnInsert" class="btn btn-primary">INSERT</button>

</form>


</center>

</body>
</html>