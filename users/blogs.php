<?php
include("include/header.php");

// Run Query
$select_post_by_blog = "SELECT * FROM USER u INNER JOIN blog b ON u.user_id = b.user_id
  INNER JOIN post p ON b.blog_id = p.blog_id 
  INNER JOIN post_category pc ON p.post_id = pc.post_id 
  INNER JOIN category c ON pc.category_id = c.category_id WHERE b.blog_id = '" . $_REQUEST['blog_id'] . "' ORDER BY p.post_id DESC";
$result = mysqli_query($connection, $select_post_by_blog);
if ($result) {
  $data = mysqli_fetch_assoc($result);
  // echo "<pre>";
  // print_r($data);
  // print_r($_SESSION['user']);
  // die;

?>
  <!-- Main Home -->

  <!-- Blogger Details Here -->
  <div class="container-fluid Main-blogger-details p-0">
    <nav class="navbar navbar-expand-lg navbar-light">

      <a class="navbar-brand" href="#"><img src="../<?php echo $data['user_image'] ?>" alt="Blogger image">
        <h2 class="blogger-name"><?php echo $data['first_name'] ?></h2>
      </a>
      <?php
      $select_follow_status = "SELECT status FROM user_blog_following WHERE follower_id='" . $_SESSION['user']['user_id'] . "'";
      $follow_result = mysqli_query($connection, $select_follow_status) or die($connection);
      if ($follow_result) {
        $check_status = mysqli_fetch_assoc($follow_result);
        // print_r($check_status);
        if ($check_status['status'] == "Followed") {
          // echo $check_status['status'];
          ?>
          <button onclick="follow_btn(<?php echo $data['blog_id']; ?>)" id="follow_btn" class="follow-btn"><i class="fa fa-rss" aria-hidden="true"></i> Unfollow</button>
          <?php
        }
        $select_unfollow_status = "SELECT status FROM user_blog_following WHERE follower_id='" . $_SESSION['user']['user_id'] . "'";
        $unfollow_result = mysqli_query($connection, $select_unfollow_status) or die($connection);
        if ($unfollow_result) {
          $check_status_unfollow = mysqli_fetch_assoc($unfollow_result);
          if($check_status_unfollow['status'] == "Unfollowed"){
            ?>
            <button onclick="follow_btn(<?php echo $data['blog_id']; ?>)" id="follow_btn" class="follow-btn"><i class="fa fa-rss" aria-hidden="true"></i> Follow</button>
            <?php
          }        
        }
      }
      ?>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto ">
          <?php
          $result_category = mysqli_query($connection, $select_post_by_blog);
          if ($result_category) {
            while ($category_nav = mysqli_fetch_assoc($result_category)) {
          ?>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#"><?php echo $category_nav['category_title'] ?></a>
              </li>
          <?php
            }
          }
          ?>
        </ul>
        <div class=" blog-name">
          <h3><?php echo $data['blog_title'] ?></h3>
          <button><i class="fa fa-cog" aria-hidden="true"></i> Customize display</button>
        </div>
      </div>
    </nav>
  </div>
  <!-- Blogger Detail End -->

  <!-- working Area here -->
  <div class="container-fluid m-0 p-0 ">
    <div class="row  m-0 p-0">
      <!-- Main Activity Area -->
      <div class="col-1"></div>
      <!-- post Activity -->
      <div class="col-lg-6 col-md-6 p-0 post-activity mt-1">
        <div class="activity-head bg-secondary mt-1">
          <h3 class="h2 p-1 text-white">All Posts</h3>
        </div>
        <div class="table-responsive-lg post-body ">
          <!-- post area -->
          <?php
          $j = 1;
          while ($post_data = mysqli_fetch_assoc($result)) {
            // echo "<pre>";
            // print_r($post_data);
            // die;
          ?>
            <!--Post Table -->
            <table border="0" class="table table-borderless post-area mb-3 shadow">
              <tr>
                <!-- Post Image -->
                <td colspan="4" class="post-img">
                  <img src="../<?= $post_data['featured_image'] ?>" alt="">
                </td>
              </tr>
              <!--Post heading -->
              <tr>
                <th align="left" colspan="4" class="post-heading">
                  <h5><?= $post_data['post_title'] ?></h5>
                </th>
              </tr>
              <!-- post details -->
              <tr>
                <td colspan="" class="post-details">Posted on:
                  <small class="text-muted"><?= $post_data['created_at'] ?></small>
                </td>
                <td class="card-text">/ Category:
                  <small class="text-muted"><?= $post_data['category_title'] ?></small>
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
                  <?= $post_data['post_summary'] ?>
                  <div class="collapse" id="collapseExample<?= $j ?>">
                    <div class="card card-body border-0 m-0 mt-1 p-0">
                      <h5>Post Description:</h5>
                      <?= $post_data['post_description'] ?>
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
              <!-- <tr>
                <td colspan="4">
                  <button onclick="read_more()" id="read_more_btn" class="read-more-btn rounded-0">Read More</button>
                </td>
              </tr> -->
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
                        <input type="hidden" name="post_id" value="<?= $post_data['post_id'] ?>">
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
                    $comment_post = "SELECT * FROM user u INNER JOIN user_post_comment upc ON u.user_id = upc.user_id WHERE post_id='" . $post_data['post_id'] . "'";
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
          } //while ending 
          ?>
          <!-- post area ends -->
        </div>
      </div>
      <!-- main area end -->
      <!-- Side bar -->
      <div class="col-lg-4 col-md-4 p-0 post-sideBar ms-2 mt-2">

        <div class="activity-head ">
          <h3 class="p-1 text-white">Recent Posts</h3>
        </div>
        <div class="post_sidebar_div">
          <?php
          $select_recent_post = "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id = pc.post_id INNER JOIN category c ON pc.category_id = c.category_id ORDER BY p.post_id DESC limit 0,5";
          $result = mysqli_query($connection, $select_recent_post) or die($connection);

          if ($result) {
            while ($row = mysqli_fetch_array($result)) {
              // echo"<pre>";
              // print_r($row);
              // die;
          ?>
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
          <?php
            }
          }
          ?>
        </div>
      </div>

      <!-- side bar ends -->
      <div class="col-1"></div>
    </div>
  </div>


<?php
} //if closing..



include("include/footer.php");
?>