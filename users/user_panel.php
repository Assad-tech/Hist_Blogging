<?php
include("include/header.php");
?>
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

      <div id="recent_post_body" class="post_sidebar_div">
      
      </div>
      <!--recent post body ends-->
    </div>
    <!-- side bar ends -->
    <div class="col-1"></div>
  </div>
</div>
<?php
include("include/footer.php");
?>