<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>

    
    
</head>
<body>
    
    
 <?php 
        //mysqli_connect("Host/web_address", "user","password","database Name")
       $conn =mysqli_connect("localhost","root","","forms");

      if ($conn){
            echo "You are connected";
        }else{
            echo "Not connected";
       } 
       //NOTIFICATION
       $notif='';

       if(isset($_POST['btnRegister'])){

          if (!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) 
          AND !empty($_POST['confirmPassword'])) {
            
                 if (!preg_match('/[\'^$&{}<>;=!]/',$_POST['username'])){

                   
                        //Declare the users input as variables
                        $inputUsername = $_POST['username'];
                        $inputEmail    = $_POST['email'];
                        $inputPassword = $_POST['password'];
                        $inputConfirmPassword  = $_POST['confirmPassword'];

                        //Check if the username exist in the database
                        $checkUsername =mysqli_query($conn,"SELECT Username FROM user WHERE Username='$inputUsername'");
                        $numberOfuser =mysqli_num_rows($checkUsername);

                        if($numberOfuser<1){

                         //Check if the email address exist in the database
                          $checkEmail=mysqli_query($conn,"SELECT Email_Address FROM  user WHERE Email_Address='$inputEmail'");
                          $numberofemail=mysqli_num_rows($checkEmail);

                          if($numberofemail<1){

                          //Check number of Input_Password
                            if(strlen($inputPassword) >=8){

                              //Checking if password match
                                if($inputPassword==$inputConfirmPassword){


                                  //Hashing_Password
                                  $option=['cost'=>12];
                              $hashedPassword=password_hash($inputPassword,PASSWORD_BCRYPT,$option);



                              //EXECUTE /Save record to DATA_BASE
                              $saveRecord=$conn->prepare("INSERT INTO `user`(`User_ID`, `Username`, `Email_Address`, `Password`)
                              VALUES ('',?,?,?)");


                                //Bind_param
                              $saveRecord->bind_param("sss",$inputUsername,$inputEmail,$hashedPassword);


                              //DONT FORGET ALWAYS THE EXECUTION ,!!!
                              if($saveRecord->errno){
                                $notif='The record has not been  saved';



                              }else{
                                $notif='Record has been saved';
                                $saveRecord->execute();
                                $saveRecord->close();
                                $conn->close();
                              }


                          }else{

                              $notif='Password should be MATCH !!';
                          }


                    }else{
                      $notif ='PASSWORD MUST MINIMUM 8 CHARACTERS !! ';
                    }

                        }else{

                            $notif ='Email already EXIST !!';
                        }

                          
                        }else{
                          $notif = 'Username Already  Exist';
                        }
          }else{
            $notif='No special characters for username included';
          }
            
        
        }else{
          $notif='All Fields are Required to Fill up';
        
        
        }
      
      }
           
    ?>

<center>
<div>
<h1>Account Registration</h1>
       <?php echo $notif ?>
<form action='Forms.php' method='POST'>

<input type="text" name="username" id="" placeholder="Username"> <br>
<input type="email" name="email" id="" placeholder="Email Address"><br>
<input type="password" name="password" id="" placeholder="Password"><br>
<input type="password" name="confirmPassword" id="" placeholder="Confirm Password"><br>
<input type="submit" name='btnRegister' value="Register my Account">
</form>
</center> 


<?php
/* CREATE_DATABASE -ALWAYS DONT FORGET THIS PART OF CODE THIS IS THE PART TO EXECUTE
  $conn=mysqli_connect('localhost','root','');

  $sql="CREATE DATABASE aelijion ";

  if($conn->query($sql)==TRUE){
      echo 'DATABASE'.$sql. 'CREATE'.'SUCCESSFULLY';
  }else{
    echo 'error';
  }

  

  $conn=mysqli_connect('localhost','root','','aelijion');

  $sql="CREATE TABLE SONGS (

        id INT(6) AUTO_INCREMENT PRIMARY KEY,
        song_name varchar(50) NOT NULL,
        writer varchar(50) NOT NULL,
        Producer VARCHAR(100) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";
    // Execute the query
    if ($conn->query($sql) === TRUE) {
      echo 'Table "SONGS" created successfully';
  } else {
      echo 'Error creating table: ' . $conn->error;
  }


//INSERT_DATA
  $conn=mysqli_connect('localhost','root','','aelijion');

 $sql="INSERT INTO SONGS(song_name,writer,Producer)
    VALUES ('Break-away','Avril','Avril')";

if ($conn->query($sql) === TRUE) {
  echo "";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

*/


/*/CREATING TABLE WITH BUTTON
$conn=mysqli_connect('localhost','root','','aelijion');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_table'])) {
  // SQL query to create the "SONGS" table
  $sql = "CREATE TABLE ADMIN (
      id INT(6) AUTO_INCREMENT PRIMARY KEY,
      song_name varchar(50) NOT NULL,
      writer varchar(50) NOT NULL,
      Producer VARCHAR(100) NOT NULL,
      reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

  // Execute the query -ALWAYS DONT FORGET THIS PART OF CODE THIS IS THE PART TO EXECUTE
  if ($conn->query($sql) === TRUE) {
      echo 'Table "ADMIN" created successfully';
  } else {
      echo 'Error creating table: ' . $conn->error;
  }
}

 
//INSERTING_DATA WITH BUTTON
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['INSERT'])) {

  $sql="INSERT INTO songs(song_name,writer,Producer)
      VALUES ('Carry You Home','akeerman','akeerman')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
      
}
*/
?>

 <form method="POST" action="">  
  
  <button type="submit" name="create_table">Create Table  </button> 
        <button type="BOTTON" name="INSERT">INSERT</button>
        </form>
       



  
    




</body>
</html>


