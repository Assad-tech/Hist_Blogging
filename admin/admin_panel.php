<?php
include("include/header.php");
// print_r($_REQUEST);
?>
<!-- Main Here -->

<!-- Blogger Details Here -->
<div class="container-fluid Main-blogger-details p-0">
    <nav class="navbar navbar-expand-lg navbar-light">

        <a class="navbar-brand ms-2" href="#"><img src="../<?=$_SESSION['user']['user_image']??"" ?>" alt="Blogger image">
            <h2 class="blogger-name"> <?php echo $_SESSION['user']['first_name']??""?> </h2>
        </a>

        <div class=" blog-name">
            <h3>Blog Name Here</h3>
            <button onclick="customize_blog()" id="customize_blog"><i class="fa fa-cog" aria-hidden="true"></i> Customize Blog</button>
        </div>
    </nav>
</div>
<!-- Blogger Detail End -->

<!-- working Area here -->
<div class="container-fluid m-0 p-0">
    <div class="row  m-0 p-0">
        <!-- Side bar -->
        <div class="col-lg-2 col-md-2 p-0 sideBar">
            <h3 class="text-center">Manage Activities</h3>
            <div class="sideBar-navigations bg-light p-2">
                <ul class="nav flex-column">
                    <li class="nav-item users">
                        <a onclick="manage_user(this)" id="users" class="nav-link " aria-current="page" href="#?nav_link=user">Manage Users</a>
                    </li>
                    <li class="nav-item manage_post">
                        <a onclick="manage_post(this)" class="nav-link manage_post" aria-current="page" href="#?nav_link=post">Manage Posts</a>
                    </li>
                    <li class="nav-item manage_category">
                        <a onclick="manage_category(this)" class="nav-link" aria-current="page" href="#?nav_link=category">Manage Categories</a>
                    </li>
                    <li class="nav-item manage_comment">
                        <a onclick="manage_comment(this)" class="nav-link" aria-current="page" href="#?nav_link=comment">Manage Comments</a>
                    </li>
                    <li class="nav-item manage_feedback">
                        <a onclick="manage_feedback(this)" class="nav-link" aria-current="page" href="#?nav_link=feedback">Manage Feedback</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- side bar ends -->
        <!-- Main Activity Area -->
        <div class="col-lg-10 col-md-10 p-0 activity-area">
            <!-- General div -->
            <div class="table-responsive-lg activity-body" id="activity-body" > </div>
        </div>
        <!-- main area end -->
    </div>
</div>

<?php
include("include/footer.php");
?>