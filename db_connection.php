<?php
//DATA_BASE_CONNECTION
$conn =mysqli_connect('localhost','root','','login');


if($conn){

    echo'connected';
}else{

    echo'~~~~~~~~';
}

?>