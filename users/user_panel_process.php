<?php
    session_start();
    //Database Connection 
    require_once '../database/database.php';
    include '../mailing_system.php';
    // Add comment
    if(isset($_REQUEST['add_comment'])){
        // echo "<pre>";
        // print_r($_REQUEST);
        extract($_REQUEST);
        $insert_comment = "INSERT INTO user_post_comment (post_id,user_id,comment) VALUES('$post_id','$user_id','".$comment."')";
        $result = mysqli_query($connection,$insert_comment);
        if($result){
            header("location:user_panel.php?message=Comment Done.&color=green");
        }else{
            header("location:user_panel.php?message=Error While Commenting.&color=red");
        }
    }
    // Feedback
    elseif(isset($_REQUEST['feedback_btn'])){
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
                header("location:user_panel.php?message=Your Feedback is saved.&color=green");
            }else{
                header("location:user_panel.php?message=Feedback could not be saved!&color=red");
            }   
        }else{
            $insert_feedback ="INSERT INTO user_feedback(user_name,user_email,feedback) 
            VALUES('".$user_name."','".$email."','".$feedback."')";
            $result = mysqli_query($connection,$insert_feedback);
            if($result){
                $mail_object = new mail_class;
                $mail_object->php_mailer($email,$user_name,"Feedback from user",$feedback);
                header("location:user_panel.php?message=Your Feedback is saved.&color=green");
            }else{
                header("location:user_panel.php?message=Feedback could not be saved!&color=red");
            }   
        }
    }
    // update user profile
    elseif(isset($_REQUEST['update_btn'])){
        extract($_REQUEST);
        $profile_image = $_FILES['profile_img'];
        
        // upload profile image
        $dir = "uploaded_data";
        if (!is_dir($dir)) {
            // echo "Directory Created.";
            mkdir($dir);
        }
        $tmp_name = $profile_image['tmp_name'];
        $imgExt = $profile_image['type'];
        $imgSize = $profile_image['size'];
        $maxSize = 	1048576;
        $randImg_no = rand(1000, 50000);
        $randImg_no .= "-post-";
        $destination = "../".$dir . "/" . $randImg_no . $profile_image['name'];
        $desti_db = $dir . "/" . $randImg_no . $profile_image['name'];
        // die;
        if (!($imgSize <= $maxSize)) {

            header("location:admin_panel.php?message=Image size must be less than 1 MB");

        } else {
            // Save profile image locally
            if (move_uploaded_file($tmp_name, $destination)) {
                // Save Path of image  and other data into Database 
                $update = "UPDATE user 
                SET first_name='".$fisrt_name."', last_name='".$last_name."', 
                email='".$email."', password='".$password."', gender='".$gender."', 
                date_of_birth='".$date_of_birth."', user_image='".$desti_db."', 
                address='".$address."', updated_at='NOW()' WHERE user_id='".$_SESSION['user']['user_id']."'";
                $result = mysqli_query($connection, $update) or die(mysqli_error($connection));

                if (!$result) {
                    header("location:user_profile.php?message=Data Insertion Failed in Post&color=red.");
                }else{
                    header("location:user_profile.php?message=Profile Updated.&color=green");
                }
            }
        }
    }
