<?php
require_once("database/database.php");
include("include/header.php");
?>
<!-- <script type="text/javascript">
  show_post()
</script> -->
<!-- Main Here -->
<!-- Quotation Div -->
<div class="container-fluid quoteDiv mt-1">
  <figure class="text-center">
    <blockquote class="blockquote">
      <p>“The best time to start was last year. Failing that, today will do.”</p>
    </blockquote>
    <figcaption class="blockquote-footer text-light">
      <cite title="Source Title">Chris Guillebeau</cite>
    </figcaption>
  </figure>
</div>
<!-- Quotation Div End -->

<!-- working Area here -->
<div class="container-fluid m-0 p-0 ">
  <div class="row  m-0 p-0">
    <!-- Main Activity Area -->
    <div class="col-1"></div>

    <!-- post Activity -->
    <div class="col-lg-6 col-md-6 p-0 post-activity">
      <div class="activity-head">
        <h3 class="p-1">All Posts</h3>
      </div>
      <div class="table-responsive-lg post-body" id="post_body">
        <!-- post area -->
      </div>
    </div>

    <!-- main area end -->
    <!-- Side bar -->
    <div class="col-lg-4 col-md-4 p-0 post-sideBar ms-2">
      <div class="activity-head ">
        <h3 class="p-1 text-white">Recent Posts</h3>
      </div>
      <div class="post_sidebar_div">
        <?php
        $select_recent_post = "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id = pc.post_id INNER JOIN category c ON pc.category_id = c.category_id ORDER BY p.post_id DESC limit 0,5";
        $result = mysqli_query($connection, $select_recent_post) or die($connection);
        if ($result) {
          while ($row = mysqli_fetch_array($result)) {
            // echo "<pre>";
            // print_r($row);
            // die;
        ?>
            <div class="card  rounded-0">
              <div class="row g-0">
                <div class="col-md-5 img-div">
                  <a href="blogs.php?page=blog&blog_id= <?=$row['blog_id']?>">
                    <img src="<?php echo $row['featured_image'] ?>" class="img-fluid" alt="...">
                  </a>
                </div>
                <div class="col-md-7">
                  <div class="card-body">
                    <a class="text-decoration-none text-black" href=" blogs.php?page=blog&blog_id= <?=$row['blog_id']?>">
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
<!-- </div>
</div> -->
<?php
include("include/footer.php");
?>