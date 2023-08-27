<?php 
session_start();

if(!isset($_SESSION['user']))
{
	header("location:../login.php?message=First Login Please!...&color=red");
}

if(isset($_SESSION['user']['role_id']) && $_SESSION['user']['role_id'] !=  2)
{
	header("location:../admin/admin_panel.php");
}

?>

