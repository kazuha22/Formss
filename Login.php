
<?php 

include('db_connection.php');
session_start();


$notif='';


if(isset($_POST['btnlogin'])){

        //Check username and password are filled up
        if(!empty($_POST['Username']) AND !empty(($_POST['Password']))){

            //Check special characters
            if(!preg_match('/[\'^$&{}<>;=!]/',$_POST['Username'])){
                
                //username/email and password if exist in database
                $user=$_POST['Username'];
                $password=$_POST['Password'];

                $queryUser=mysqli_query($conn,"SELECT * FROM user WHERE (user_name='$user' OR email_address='$user')");
                $numberOfquery=mysqli_num_rows($queryUser);

                if($numberOfquery>0){

                    //Pull out  RECORD IN OUR DATAB_BASE

                    while($row=mysqli_fetch_assoc($queryUser)){
                            $outusername= $row['user_name'];
                            $outemail=$row['email_address'];
                            $outpassword=$row['Passwords'];

                    } if(($outusername ==$user OR $outemail==$user) AND $password==$outpassword){ 

                        
                        $_SESSION['email_address']=$user;
                        
                        header("Location: user_page.php");
                        exit();
                        


                }else{
                    $notif='Your Credential NOT VALID';
                }

                   
                    
                }else{
                    $notif='Record is not Yet in our system.Please Register an account !!';

                }
    
        }else{
            $notif='No Special Characters NOT INCLUDED!!';
            
        }

    }else{
        $notif='Required to Input all FIELD';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<center>
<div >
    
<form action="Login.php" method="POST">
    <h1>Login Account</h1>
    <h3><?php echo $notif;?> </h3>

    
    <input type="text" name="Username"  placeholder="Username or Email Address:"> <br>
    <input type="password" name="Password"  placeholder="Password:"><br>

    <input type="submit" name="btnlogin" id="">
    

</form>

</div>


</center>



    
</body>
</html>