<?php 

$server = "localhost";
$db = "u533227227_manchestercity";
$username = "u533227227_jfr";
$password = "JFRmanchestercityDB#10";

$con = mysqli_connect($server, $username, $password, $db);

if(!$con)
{
    echo"<font color='red'>Connection Error!!</font>";
}


?>