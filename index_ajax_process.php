<?php
// session_start();
require_once("database/database.php");
// require_once 'database/database.php';
// show posts
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_post") {
    $select_post = "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id = pc.post_id INNER JOIN category c ON pc.category_id = c.category_id ORDER BY p.post_id DESC";
    $result = mysqli_query($connection, $select_post);

    if ($result) {
        // $data = mysqli_fetch_assoc($result);
        // echo "<pre>";
        // print_r($data);
        // print_r($_SESSION['user']);
        // die;
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
?>
            <!--Post Table -->
            <table border="0" class="table table-borderless post-area mb-3 shadow">
                <tr>
                    <!-- Post Image -->
                    <td colspan="4" class="post-img">
                        <img src="<?= $row['featured_image'] ?>" alt="">
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
                        <div class="accordion" id="accordionExample<?= $i ?>">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header" id="headingOne read_more_btn<?= $i ?>">
                                    <button class="read-more-btn rounded-0 fs-6" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne<?= $i ?>" aria-expanded="true" aria-controls="collapseOne">
                                        Read more
                                    </button>
                                </h2>
                                <div id="collapseOne<?= $i ?>" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample<?= $i ?>">
                                    <div class="accordion-body">
                                        <h5>Post Description:</h5>
                                        <?= $row['post_description'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- post add comments -->
                <tr>
                    <td colspan="4" class="mt-2 write-comment">
                        <div>
                            <form action="user_panel_process.php" method="post" class="input-group mb-1">
                                <?php
                                if (!(isset($_SESSION['user']['user_id']))) {
                                    echo '<p>To comment on Post <a class="text-decoration-none" href="login.php" >Login</a> or <a class="text-decoration-none" href="account_register.php" >Register</a></p>';
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
                            $select_comment = "SELECT * FROM user_post_comment upc INNER JOIN user u ON upc.user_id = u.user_id WHERE post_id='" . $row['post_id'] . "'";
                            $comment_result = mysqli_query($connection, $select_comment);
                            ?>
                            <!-- 1st comment -->
                            <table class="table table-borderless">
                                <?php
                                if ($comment_result) {
                                    while ($comment = mysqli_fetch_assoc($comment_result)) {
                                        // echo "<pre>";
                                        // print_r($comment);
                                        ?>
                                        <tr>
                                            <th rowspan="2" scope="row">
                                                <img class=" comment-img rounded-circle" src="<?=$comment['user_image']?>">
                                            </th>
                                            <th class="w-25"><?=$comment['first_name'];  echo" ".$comment['last_name']?></th>
                                            <td class="text-muted"><?=$comment['created_at']?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><?=$comment['comment']?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- comments end -->
            <!-- 1st post body ends -->
            <?php
            $i++;
        }
    }
}
// Blog Navbar dropdown
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == "show_post") {
    $select_blog = "SELECT * FROM blog";
    $result($connection, $select_blog) or die($connection);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo "<pre>";
        print_r($data);
    }
}

?>