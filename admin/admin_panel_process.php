<?php
    session_start();
    //Database Connection 
    require_once '../database/database.php';
// Create Blog Form...
if(isset($_REQUEST['create_blog'])){
    //     echo "<pre>";
    // print_r($_SESSION['user']);
    // print_r($_REQUEST);
    // die;
    extract($_REQUEST);
    $query = "INSERT INTO blog (user_id,blog_title,created_at) Value('".$_SESSION['user']['user_id']."','".$blog_title."',Now())";
    $result1= mysqli_query($connection,$query);    
    if($result1){
            header("location:admin_panel.php?message=Blog Created Successfully&color=green");
    }else{
        header("location:admin_panel.php?message=Invalid Input!&color=red");
    }
}
// Update Blog Details
elseif(isset($_REQUEST['update_blog'])){
    // print_r($_REQUEST);
    extract($_REQUEST);
    $update_query = "UPDATE blog SET blog_title='" .$blog_title."', post_per_page='".$post_pr_page."', blog_status='".$blog_status."', updated_at= Now() WHERE user_id='".$user_id."' AND blog_id='".$blog_id."'";
    $result = mysqli_query($connection, $update_query);
    if ($result) {
        header("location:admin_panel.php?message=Blog Updated Successfully&color=green");
        // echo "<h3 style='color:red;'>User data Updated having ID: " . $_REQUEST['user_id'] . "</h3>";
    } else {
        header("location:admin_panel.php?message=Blog Not Updated!&color=red");
    }
}
// Update Category Details
elseif(isset($_REQUEST['update_category'])){
    // print_r($_REQUEST);
    // die;
    extract($_REQUEST);
    $update_query = "UPDATE category SET category_title='" .$category_title."', category_description='".$category_description."', category_status='".$category_status."', updated_at= Now() WHERE category_id='".$category_id."'";
    $result = mysqli_query($connection, $update_query);
    if ($result) {
        header("location:admin_panel.php?message=Category Updated Successfully&color=green");
        // echo "<h3 style='color:red;'>User data Updated having ID: " . $_REQUEST['user_id'] . "</h3>";
    } else {
        header("location:admin_panel.php?message=Category Not Updated!&color=red");
    }
}

// Update Comments
elseif(isset($_REQUEST['update_comment'])){
    // echo "<pre>";
    // print_r($_REQUEST);
    // die;
    extract($_REQUEST);
    $update_query = "UPDATE user_post_comment SET comment='".htmlspecialchars($comment)."', is_active='".$is_active."', updated_at= Now() WHERE post_id='".$post_id."'";
    $result = mysqli_query($connection,$update_query) or die($connection);
    if ($result) {
        header("location:admin_panel.php?message=Category Updated Successfully&color=green");
    } else {
        header("location:admin_panel.php?message=Comment Not Updated!&color=red");
    }
}

// Create POST
elseif(isset($_REQUEST['create_post'])){
    echo "<pre>";
    // print_r($_SESSION['user']);
    // print_r($_REQUEST);
    // print_r($_FILES);
    $featured_image = $_FILES['featured_image'];
    $post_attachment = $_FILES['post_attachment'];
    // print_r($featured_image);
    // print_r($post_attachment);
    extract($_REQUEST);
    // die;

    // upload profile image
    $dir = "uploaded_data";
    if (!is_dir($dir)) {
        // echo "Directory Created.";
        mkdir($dir);
    }

    $tmp_name = $featured_image['tmp_name'];
    // $imgPath = $featured_image['full_path'];
    $imgExt = $featured_image['type'];
    $imgSize = $featured_image['size'];
    $maxSize = 4194304;
    $randImg_no = rand(1000, 50000);
    $randImg_no .= "-post-";
    $destination = "../".$dir . "/" . $randImg_no . $featured_image['name'];
    $desti_db = $dir . "/" . $randImg_no . $featured_image['name'];
    // die;
    if (!($imgSize <= $maxSize)) {

        header("location:admin_panel.php?message=Image size must be less than 4 MB");

    } else {
        // Save profile image locally
        if (move_uploaded_file($tmp_name, $destination)) {

            // die;

            // Save Path of image  and other data into Database 
            $insert = "INSERT INTO post(blog_id,post_title,post_summary,post_description,featured_image,post_status,is_comment_allowed)
            VALUES('$blog_id','".$post_title."','".htmlspecialchars($post_summary)."','".htmlspecialchars($post_description)."','".$desti_db."','".$post_status."','".$comment_status."')";

            $result = mysqli_query($connection, $insert) or die(mysqli_error($connection));

            if (!$result) {
            // die;
                header("location:admin_panel.php?message=Data Insertion Failed in Post.");

            }else{
               $last_post_id = mysqli_insert_id($connection);
               // die;
               $insert_bridge = "INSERT INTO post_category (post_id,category_id) VALUES('$last_post_id','$category_id')";

               $result2 = mysqli_query($connection,$insert_bridge);
               if ($result2) {
                    $tmp_name2 = $post_attachment['tmp_name'];
                    $imgExt = $post_attachment['type'];
                    $attachment_size = $post_attachment['size'];
                    $max_Size = 3145728;
                    $rand_Img_no = rand(1000, 50000);
                    $rand_Img_no .= "_";
                    $destination2 = "../".$dir . "/" . $rand_Img_no . $post_attachment['name'];
                    $desti_2_db = $dir . "/" . $rand_Img_no . $post_attachment['name'];
                    // die;
                    if (!($attachment_size <= $max_Size)) {
                        header("location:admin_panel.php?message=Image size must be less than 3 MB");
                    }else{
                        // Save profile image locally
                        if (move_uploaded_file($tmp_name2, $destination2)){

                            $insert_attachment = "INSERT INTO post_atachment(post_id,post_attachment_title,post_attachment_path) 
                            VALUES('$last_post_id','".$attachment_title."','".$desti_2_db."')";
                            $result3 = mysqli_query($connection,$insert_attachment);

                            if ($result3) {
                                header("location:admin_panel.php?message=All Data Inserted Successfully");
                            }else{
                                header("location:admin_panel.php?message=Attachment Not Uploaded");
                            }
                        }else{
                            header("location:admin_panel.php?message=File not Uploaded.");
                        }   
                    }
                    // header("location:admin_panel.php?message=Data Inserted Successfully");
               }else{
                    header("location:admin_panel.php?message=Insertion Failed in post birdge.");
               }
            }
        }else{
            header("location:admin_panel.php?message=Image not Uploaded.");
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


