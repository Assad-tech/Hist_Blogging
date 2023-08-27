<?php
	session_start();
	require_once 'database/database.php';
	
	if (isset($_REQUEST['login'])){
		// print_r($_REQUEST);

		extract($_REQUEST);
		$query = "SELECT * FROM user WHERE email = '".$email."' AND password= '".$password."' ";

		$result = mysqli_query($connection,$query);

		if ($result) {
		$user = mysqli_fetch_assoc($result);
		$_SESSION['user'] = $user;
		// echo "<pre>";
		// print_r($user);
		
			// Check Request Status..
			if($user['is_approved'] == "approved"){

				// Check Account Status
				if($user['is_active'] == "active"){

					// Check Role
					if($user['role_id'] == 1) {
						header("location:admin/admin_panel.php");
					}elseif($user['role_id'] == 2) {
						header("location:users/user_panel.php");
					}else{
						header("location:login.php?message=Invalid Input&color=red");
					}
				}else{
					header("location:login.php?message=Your Account is not Active.&color=red");
				}

			}elseif($user['is_approved'] == "rejected"){
				header("location:login.php?message=Your Account Request is Rejected.&color=red");
			}else{
				header("location:login.php?message=Your Account Request is Pending..&color=red");
			}

		}

	}

?>