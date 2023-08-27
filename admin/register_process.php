<?php
    //Database Connection 
    require_once '../database/database.php';


    // PHP mailer Library
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/Exception.php';

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
    $dir = "profile_img";
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
                
                // // Send Email to Admin and User both

                // //Create a new PHPMailer instance
                // $mail = new PHPMailer();
                // //Tell PHPMailer to use SMTP
                // $mail->isSMTP();

                // $mail->Host = 'smtp.gmail.com';
                // $mail->Port = 587;
                // //Set the encryption mechanism to use - STARTTLS or SMTPS
                // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                // //Whether to use SMTP authentication
                // $mail->SMTPAuth = true;
                // //Username to use for SMTP authentication - use full email address for gmail
                // $mail->Username = 'assadullahphull@gmail.com';
                // //Password to use for SMTP authentication
                // $mail->Password = '2723.Asad';

                // $mail->setFrom('assadullahphull@gmail.com', 'Asadullah Phull');
                // $mail->addAddress($email);
                // $mail->Subject = "Account Status.";
                // $mail->msgHTML("<h1>Dear User:</h1> Your account is activated. Thank you.");

                // if (!$mail->send()) {
                //     echo 'Mailer Error: ' . $mail->ErrorInfo;
                // } else {
                //     // echo 'Message sent!';
                //     header("location:admin.php?msg= Email Sent And Account Activated.");
                // }
            }
        
        }else{
            $is_validate = false;
            $errors .= "<li>Image not Uploaded...!</li>";
        }
    }

    // output
    if ($is_validate) {

        // Generate PDF
    require_once '../fpdf/fpdf.php';
    $cvObj = new FPDF();

    $cvObj->AddPage("P","A4");
    // Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]]);
    $cvObj->Image($destination,150,10,50,50);

    // SetFont(string family [, string style [, float size]])
	$cvObj->setfont('Times','B',30);
    
    // Ln([float h])
    $cvObj->Ln(5);
    
    //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
	$cvObj->cell(70,12,$first_name,'',1,'L');
    
    // SetTextColor(int r [, int g, int b])
    $cvObj->SetTextColor(237, 150, 19);
    $cvObj->cell(70,11,$last_name,'',2,'L');
    
    // Other Details
	$cvObj->Ln(2);
    $cvObj->setfont('Times','',16);
    $cvObj->cell(70,5,'Other Details:','',1,'L');
        
	$cvObj->Ln(1);
	$cvObj->setfont('Arial','',11);
    $cvObj->SetTextColor(13, 13, 13);
    // MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
    $cvObj->MultiCell(110,5,"Role id: 2",'');
    $cvObj->MultiCell(110,5,"Email: $email",'');
    $cvObj->MultiCell(110,5,"Passeord: $password",'');
    $cvObj->MultiCell(110,5,"Gender: $gender",'');
    $cvObj->MultiCell(110,5,"Date of Birth: $date_of_birth",'');
    $cvObj->MultiCell(110,5,"Addess: $address",'');
    $cvObj->MultiCell(110,5,"Request Status: pending",'');
    
    //Some Lines
    $cvObj->Ln(2);
    $cvObj->SetTextColor(237, 150, 19);
    $cvObj->setfont('Times','',16);
    // $cvObj->Line(10,61,200,61);
    $cvObj->Line(10,225,200,225);
    $cvObj->cell(70,5,'Please Note:','',1);

    $cvObj->Ln(3);
	$cvObj->setfont('Arial','',12);
    $cvObj->SetTextColor(13, 13, 13);
    $cvObj->Cell(100,5,'Please Goto to your email check further deatails',0,1,);

    $cvObj->output("",time()."_user_data.pdf");


        header("location:login.php?message=Account Created, and check email&color=green");
    } else {
        header("location:ajax-process.php?action=manage_user&message=$errors&color=red");
        die();
    }
}
 else {
    header("location:account_register.php?message=Please The Fill Form.&color=red");
    die;
}



