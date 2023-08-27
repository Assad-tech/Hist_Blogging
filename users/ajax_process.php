<?php
session_start();
require_once("../database/database.php");
// show posts
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_user_post") {
    $select_post = "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id = pc.post_id INNER JOIN category c ON pc.category_id = c.category_id ORDER BY p.post_id DESC";
    $result = mysqli_query($connection, $select_post);

    if ($result) {
        // $data = mysqli_fetch_assoc($result);
        // echo "<pre>";
        // print_r($data);
        // print_r($_SESSION['user']);
        // die;
        $j = 1;
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <!--Post Table -->
            <table border="0" class="table table-borderless post-area mb-3 shadow">
                <tr>
                    <!-- Post Image -->
                    <td colspan="4" class="post-img">
                        <img src="../<?= $row['featured_image'] ?>" alt="">
                    </td>
                </tr>
                <!--Post heading -->
                <tr>
                    <th align="left" colspan="4" class="post-heading">
                        <h5><?= $row['post_title'] ?></h5>
                    </th>
                </tr>
                <!-- post details -->
                <tr>
                    <td colspan="" class="post-details">Posted on:
                        <small class="text-muted"><?= $row['created_at'] ?></small>
                    </td>
                    <td class="card-text">/ Category:
                        <small class="text-muted"><?= $row['category_title'] ?></small>
                    </td>
                    <td colspan="" class="read-comment">/
                        <small class="text-muted">
                            <a class=" border-0 rounded-0" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Read Comments</a>
                        </small>
                    </td>
                    <td colspan="2"></td>
                </tr>
                <!-- post text -->
                <tr>
                    <td class="post-text" colspan="4">
                        <h5>Post Summary:</h5>
                        <?= $row['post_summary'] ?>
                        <div class="collapse" id="collapseExample<?= $j ?>">
                            <div class="card card-body border-0 m-0 mt-1 p-0">
                                <h5>Post Description:</h5>
                                <?= $row['post_description'] ?>
                            </div>
                        </div>
                        <p>
                            <button class="read-more-btn rounded-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?= $j ?>" aria-expanded="false" aria-controls="collapseExample">
                                Read More
                            </button>
                        </p>
                    </td>
                </tr>
                <!-- read more button -->
                <tr>
                    <!-- <td colspan="4">
                        <button onclick="read_more()" id="read_more_btn" class="read-more-btn rounded-0">Read More</button>
                    </td> -->
                </tr>
                <!-- post add comments -->
                <tr>
                    <td colspan="4" class="mt-2 write-comment">
                        <div>
                            <form action="user_panel_process.php" method="post" class="input-group mb-1">
                                <?php
                                if (!(isset($_SESSION['user']['user_id']))) {
                                    echo '<p>To comment on Post <a class="text-decoration-none" href="../login.php" >Login</a> or <a class="text-decoration-none" href="../account_register.php" >Register</a></p>';
                                } else {
                                ?>
                                    <input type="text" name="comment" class="form-control rounded-0" placeholder="Leave a Comment" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?? "" ?>">
                                    <input type="hidden" name="post_id" value="<?= $row['post_id'] ?>">
                                    <button type="submit" name="add_comment" class="input-group-text rounded-0 p-1" id="basic-addon2"> Add comment</button>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
            <!-- Watch Comments -->
            <div class="row watch-comment">
                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <?php
                            $comment_post = "SELECT * FROM user u INNER JOIN user_post_comment upc ON u.user_id = upc.user_id WHERE post_id='" . $row['post_id'] . "'";
                            $comment_result = mysqli_query($connection, $comment_post);
                            if ($comment_result) {
                                while ($comment_list = mysqli_fetch_assoc($comment_result)) {
                                    // echo "<pre>";
                                    // print_r($comment_list);
                            ?>
                                    <!-- 1st comment -->
                                    <table class="table table-borderless">
                                        <tr>
                                            <th rowspan="2" scope="row">
                                                <img class=" comment-img rounded-circle" src="../<?php echo $comment_list['user_image'] ?>">
                                            </th>
                                            <th class="w-25"><?= $comment_list['first_name'] ?></th>
                                            <td class="text-muted"><?= $comment_list['created_at'] ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <!-- <th scope="row">2</th> -->
                                            <td colspan="4"><?= $comment_list['comment'] ?></td>
                                        </tr>
                                    </table>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- comments end -->
            <!-- 1st post body ends -->
        <?php
            $j++;
        }
    }
}
// 5 recent Posts
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "recent_user_post") {

    $select_recent_post = "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id = pc.post_id INNER JOIN category c ON pc.category_id = c.category_id ORDER BY p.post_id DESC limit 0,5";
    $result = mysqli_query($connection, $select_recent_post) or die($connection);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <!--recent post now -->
            <div class="card  rounded-0">
                <div class="row g-0">
                    <div class="col-md-5 img-div">
                        <a href="blogs.php?page=blog&blog_id= <?= $row['blog_id'] ?>">
                            <img src="../<?php echo $row['featured_image'] ?>" class="img-fluid" alt="...">
                        </a>
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <a class="text-decoration-none text-black" href=" blogs.php?page=blog&blog_id= <?= $row['blog_id'] ?>">
                                <h5 class="card-title"><?= $row['post_title'] ?></h5>
                                <p class="card-text"><?= $row['post_summary'] ?></p>
                            </a>
                            <p class="card-text"><small class="text-muted"><?= $row['created_at'] ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <!--recent post ends-->
    <?php
        }
    }
}
// Edit User's Profile
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_user_profile') {
    // print_r($_REQUEST);
    // die;
    $select_user = "SELECT * FROM user WHERE user_id='" . $_REQUEST['user_id'] . "'";
    $result = mysqli_query($connection, $select_user);
    if ($result) {
        $user_info = mysqli_fetch_assoc($result);
        // echo "<pre>";
        // print_r($user_info);
        // die;
    }
    ?>
    <form action="user_panel_process.php" method="post" enctype="multipart/form-data">
        <table class="table" border="1">
            <tr class="bg-light text-dark">
                <th colspan="8" class="table-heading"> Update User's Profile</th>
            </tr>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="fisrt_name" id="fisrt_name" value="<?= $user_info['first_name'] ?>" placeholder="Enter Name"></td>
                <td>Last Name: </td>
                <td><input type="text" name=" last_name" id=" last_name" value="<?= $user_info['last_name'] ?>" placeholder="Enter Last Name"></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><input type="text" name="email" id="email" value="<?= $user_info['email'] ?>" placeholder="abc@gmail.com"></td>
                <td>Password:</td>
                <td><input type="text" name="password" id="password" value="<?= $user_info['password'] ?>" placeholder="1234"> </td>
            </tr>
            <tr>
                <td>Date of Birth:</td>
                <td><input type="date" name="date_of_birth" value="<?= $user_info['date_of_birth'] ?>"></td>
                <td>Gender:</td>
                <td>
                    <select name="gender" id="gender">
                        <option <?php
                                if ($user_info['gender'] == "Male") {
                                    echo "selected";
                                }
                                ?> value="Male">Male</option>
                        <option <?php
                                if ($user_info['gender'] == "Female") {
                                    echo "selected";
                                }
                                ?> value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Upload Profile:</td>
                <td><input type="file" name="profile_img" id="profile_img"></td>
                <td>Address:</td>
                <td>
                    <textarea name="address" id=address"" cols="17" rows="1">
                        <?php echo $user_info['address'] ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td colspan="4"><img width="150" height="200" src="../<?php echo $user_info['user_image'] ?>" alt=""></td>
            </tr>
            <tr>
                <td colspan="4"> <button type="submit" name="update_btn" class="activity-btns rounded-0">Update Admin Profile</button></td>
            </tr>
        </table>
    </form>
<?php
}
// Follow Button
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'follow_btn') {
    // print_r($_REQUEST);
    // die;
    $follow_blog = "INSERT INTO user_blog_following (follower_id,blog_following_id) VALUES('".$_SESSION['user']['user_id']."','".$_REQUEST['blog_id']."')";
    $follow_result = mysqli_query($connection,$follow_blog);
    if($follow_result){
        echo "Blog Followed.";
    }
}
// Unfollow Button
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'unfollow_btn') {
    // print_r($_REQUEST);
    // die;
    $unfollow_blog = "UPDATE user_blog_following  SET status='Unfollowed' WHERE follower_id ='".$_SESSION['user']['user_id']."'";
    $unfollow_result = mysqli_query($connection,$unfollow_blog) or die($connection);
    if($unfollow_result){
        echo "Blog Unfollowed";
    }else{
        echo "not worked";
    }
}else {
?>
    <h3>Data Not Found</h3>
<?php
}
?>