<?php
    //Database Connection 
    require_once 'database/database.php';
    include 'mailing_system.php';

if (isset($_REQUEST['register'])) {
    
    /////////////////// Get Variables.
    $is_validate = true;
    $first_name = $_REQUEST['first_name'];
	$last_name = $_REQUEST['last_name'];
	$email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
	$address = $_REQUEST['address'];
    $gender = false;
    $date_of_birth = $_REQUEST['date-of-birth'];
    $img = $_FILES['profile_img'];
    $errors = '';

    // ///////////////// Patterns
    $f_name_pattern = "/[A-Z]{3,20}/i";
    $l_name_pattern = "/[A-Z]{3,20}/i";
    $email_pattern = "/^[\w]{3,15}[@][a-z]{5,8}[.](com|org)$/";
    $password_pattern_small = "/[a-z]+/";
    $password_pattern_capital = "/[A-Z]+/";
    $password_pattern_special = "/[\W]+/";
    $password_pattern_number = "/[\d]+/";
    $address_pattern = "/^[\w\W]{10,100}$/";

    /////////////// Server Validations
    // First Name
    if ($first_name == "") {
        $errors .= "<li>" . "Please Enter First Name </li>";
        $is_validate = false;
    } else {
        if (!preg_match($f_name_pattern,$first_name)) {
            $errors .= "<li>" . "Format should be: Asadullah </li>";
            $is_validate = false;
        }
    }
    // Last Name
    if ($last_name == "") {
    } else {
        if (!preg_match($l_name_pattern, $last_name)) {
            $errors .= "<li>" . "Format should be: Phull </li>";
            $is_validate = false;
        }
    }
    //Email
    if ($email == "") {
        $errors .= "<li>" . "Please Enter Email!</li>";

        $is_validate = false;
    } else {
        if (!preg_match($email_pattern, $email)) {
            $errors .= "<li>" . "Format should be: abc123@gmail.com </li>";
            $is_validate = false;
        }
    }
    // password
    if ($password == "") {
        $errors .= "<li>" . "Please Enter Password!</li>";
        $is_validate = false;
    } else {
        if (!(strlen($password) >= 6 && preg_match($password_pattern_capital, $password)
         && preg_match($password_pattern_small, $password) 
         && preg_match($password_pattern_special, $password) 
         && preg_match($password_pattern_number, $password))){
            $errors .= "<li>" . "Format should be: Aa1@xx at least 6 chars </li>";
            $is_validate = false;
        }
    }
    // Gender
    if (isset($_REQUEST['gender'])) {
        $gender = $_REQUEST['gender'];
    } else {
        $errors .= "<li>" . "Please Select Gender!</li>";
        $is_validate = false;
    }
    //Address
    if($address == ""){
		$is_validate = false;
		$errors .= "<li>Address: Please Enter Address</li>";
	}
	elseif(!preg_match($address_pattern,$address)){
		$is_validate = false;
		$errors .= "<li>Address Length Min:10 Max:100</li>";
	} 

    // upload profile image
    $dir = "uploaded_data";
    if (!is_dir($dir)) {
        // echo "Directory Created.";
        mkdir($dir);
    }

    $tmp_name = $img['tmp_name'];
    // $imgPath = $img['full_path'];
    $imgExt = $img['type'];
    $imgSize = $img['size'];
    $maxSize = 1048576;
    $randImg_no = rand(1000, 50000);
    $randImg_no .= "-profile-";
    $destination = $dir . "/" . $randImg_no . $img['name'];

    if (!($imgSize <= $maxSize)) {

        $is_validate = false;
        $errors .= "<li>Image size must be less than 1 MB</li>";

    } else {
        // Save profile image locally
        if (move_uploaded_file($tmp_name, $destination)) {

            // echo "<pre>";
            // print_r($_REQUEST);
            // echo "<br />";
            // print_r($_FILES);
            // echo "</ pre>";
            // echo "<br />";
            // echo $destination;
            // die;


            // Save Path of image  and other data into Database 
            $insert = "INSERT INTO user (role_id,first_name,last_name,email,password,gender,date_of_birth,user_image,address)
            VALUES('2','".$first_name."','".$last_name."','".$email."','".$password ."','".$gender."','".$date_of_birth."','".$destination."','".$address."')";

            // die;
            $result = mysqli_query($connection, $insert);

            if (!$result) {
                $errors .= "<li> Message: " . mysqli_error($connection)."</li>";
            }else{
                require_once 'generate_pdf_profile.php';
                $mail_object = new mail_class;
                $mail_object->php_mailer($email,$first_name,"Account Registration Email","your request to register Account is sent successfully to admin wait for admin's approval. Thank you");
            }
        
        }else{
            $is_validate = false;
            $errors .= "<li>Image not Uploaded...!</li>";
        }
    }

    // output
    if ($is_validate) {

        // header("location:login.php?message=Account Created, and check email&color=green&destination=$destination&first_name=$first_name&last_name=$last_name&email=$email&password=$password&address=$address&gender=$gender&date_of_birth=$date_of_birth");
    ?>
        <script type="text/javascript">
            window.location = "account_register.php?message=Account Created, and check email&color=green";
        </script>
    <?php
    } else {
        header("location:account_register.php?message=$errors&color=red");
        die();
    }
}
 else {
    header("location:account_register.php?message=Please The Fill Form.&color=red");
    die;
}




