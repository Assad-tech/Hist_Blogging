<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

// E-mail class
class mail_class{
	function php_mailer($email_to,$first_name,$subject,$message){

		                // // Send Email to Admin and User both


                    //Create a new PHPMailer instance
                    $mail = new PHPMailer();
                    //Tell PHPMailer to use SMTP
                    $mail->isSMTP();
                    //Enable SMTP debugging
                    // SMTP::DEBUG_OFF = off (for production use)
                    // SMTP::DEBUG_CLIENT = client messages
                    // SMTP::DEBUG_SERVER = client and server messages
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    //Set the hostname of the mail server
                    $mail->Host = 'smtp.gmail.com';
                    // use
                    // $mail->Host = gethostbyname('smtp.gmail.com');
                    // if your network does not support SMTP over IPv6
                    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                    $mail->Port = 587;
                    //Set the encryption mechanism to use - STARTTLS or SMTPS
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    //Whether to use SMTP authentication
                    $mail->SMTPAuth = true;
                    //Username to use for SMTP authentication - use full email address for gmail
                    // $mail->Username = 'phpbasic2k22@gmail.com';
                    $mail->Username = 'assadullahphull@gmail.com';
                    //Password to use for SMTP authentication
                    // $mail->Password = '@hidaya123';
                    $mail->Password = '2723.Asad';
                    //Set who the message is to be sent from
                    // $mail->setFrom('phpbasic2k22@gmail.com', 'Php Basic');
                    // $mail->setFrom('phpbasic2k22@gmail.com');
                    $mail->setFrom('assadullahphull@gmail.com');

                    //Set an alternative reply-to address
                    //$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
                    //Set who the message is to be sent to
                    // $mail->addAddress('phpbasic2k22@gmail.com', "Reciever");
                    $mail->addAddress($email_to, "Reciever");
                    // $mail->addCC('enter-your-id@gmail.com','ABC');
                    // $mail->addCC('enter-your-id@gmail.com','Sajjad');

                    $mail->addBCC('assadullahphull@gmail.com');


                    //Set the subject line
                    $mail->Subject = $subject;
                    //Read an HTML message body
                    //$mail->isHTML();
                    //$mail->msgHTML("This Is Testing Message Using PhpMailer");
                    $mail->msgHTML("Dear: <h1>$first_name</h1>".$message);

                    //Attach an image file (optional)
                    // $mail->addAttachment('image1.jpg',"My Image");
                    //send the message, check for errors
                    if (!$mail->send()) {
                        $is_validate = false;
                        $errors .="<li>".$mail->ErrorInfo."<li>";
                    } else {
                        // Generate PDF
                        // require_once 'generate_pdf_profile.php';
                    }

	}
}

?>