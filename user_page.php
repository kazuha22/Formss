<?Php 
include('db_connection.php');
session_start();


$notif='';
//DOnt forget session start function star(session_start)
//GET_Session_user
$user=$_SESSION['email_address'];


if(!isset($_SESSION['email_address'])){
    header("Location: 404.php");
}


//GET DATA IN DATABASE
$getData =mysqli_query($conn,"SELECT * FROM user WHERE (email_address='$user' OR user_name='$user') " );


//Check if have pull record in database
$countData = mysqli_num_rows($getData);

if( $countData>0){

    while($row=mysqli_fetch_assoc($getData)){
        $usernames = $row['user_name'];
        $emails    = $row['email_address'];
        

    }

}

//LOGOUT
if(isset($_POST['btnLogout'])){


    session_unset();
    session_destroy();
    header("Location: Login.php");

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user_page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<center>

<form action="user_page.php" method="POST">
    <h1>Hello, <?php  echo $user; ?> Here!!</h1><br>
    <input   class="btn btn-link"  type="submit" name="btnLogout" value="LOGOUT"> 
    <br> <br>
    <table class="table table-bordered">
        <tr>
        
        <th>USER_NAME</th>
        <td><?Php  echo $usernames; ?></td>
        </tr>

        <tr>
        <th> Email_ADDRESS</th>
        <td>  <?php   echo $emails;  ?></td>
        </tr>

      


        </form>

    </table>
</center>




</head>
<body>
    
</body>
</html>