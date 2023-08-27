<?php 
if(!isset($_SESSION['user']))
{
	header("location:../login.php?message=First Login Please!...&color=red");
}

if(isset($_SESSION['user']['role_id']) && $_SESSION['user']['role_id'] !=  1)
{
	header("location:../users/user_panel.php");
}

?>

