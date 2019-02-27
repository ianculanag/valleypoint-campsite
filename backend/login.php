<?php
require 'dbcon.php';
session_start();
if(isset($_POST['login']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$sql ="SELECT username,password FROM staff WHERE username =:username AND password =:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['login']=$_POST['username'];
echo "<script type='text/javascript'> document.location = 'dashboard.html'; </script>";
} else{
  echo "<script>alert('Invalid Details');</script>";
}
}
?>