<?php
    session_start();
    //Database Connection 
    require_once 'database/database.php';
    include 'mailing_system.php';
    // Add comment
    // if(isset($_REQUEST['add_comment'])){
    //     // echo "<pre>";
    //     // print_r($_REQUEST);
    //     extract($_REQUEST);
    //     $insert_comment = "INSERT INTO user_post_comment (post_id,user_id,comment) VALUES('$post_id','$user_id','".$comment."')";
    //     $result = mysqli_query($connection,$insert_comment);
    //     if($result){
    //         header("location:index.php?message=Comment Done.&color=green");
    //     }else{
    //         header("location:index.php?message=Error While Commenting.&color=red");
    //     }
    // }
    // Feedback
    if(isset($_REQUEST['feedback_btn'])){
        echo "<pre>";
        print_r($_REQUEST);
        extract($_REQUEST);   
        if(isset($_SESSION['user']['user_id'])){

            $insert_feedback ="INSERT INTO user_feedback(user_id,user_name,user_email,feedback) 
            VALUES('".$_SESSION['user']['user_id']."','".$user_name."','".$email."','".$feedback."')";
            $result = mysqli_query($connection,$insert_feedback);
            if($result){
                $mail_object = new mail_class;
                $mail_object->php_mailer($email,$user_name,"Feedback from user",$feedback);
                header("location:contact-us.php?message=Your Feedback is sent to Admins.&color=green");
            }else{
                header("location:contact-us.php?message=Feedback could not be saved!&color=red");
            }   
        }else{
            $insert_feedback ="INSERT INTO user_feedback(user_name,user_email,feedback) 
            VALUES('".$user_name."','".$email."','".$feedback."')";
            $result = mysqli_query($connection,$insert_feedback);
            if($result){
                $mail_object = new mail_class;
                $mail_object->php_mailer($email,$user_name,"Feedback from user",$feedback);
                header("location:contact-us.php?message=Your Feedback is sent to admin.&color=green");
            }else{
                header("location:contact-us.php?message=Feedback could not be saved!&color=red");
            }   
        }
    }
?>