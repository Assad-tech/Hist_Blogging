<?php
    session_start();
    require_once '../database/database.php';
    // Session Maintainance
    if(!isset($_SESSION['user']))
    {
        header("location:../login.php?message=First Login Please!...&color=red");
    }

    if(isset($_SESSION['user']['role_id']) && $_SESSION['user']['role_id'] !=  1)
    {
        header("location:../users/user_panel.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIST Blogs</title>

    <!-- Data table Links -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

     
</head>

<body onload="manage_user()">
    <!-- header -->
    <div class="container-fluid bg-light">
        <div class="row m-0 p-0 upperNav">
            <h5 class=" col-sm-6 panel_identity ">
            <i class="fa fa-cogs" aria-hidden="true"></i> Admin Panel
            </h5>
            <ul class="nav justify-content-end p-0 m-0 col-sm-6">
                <li class="nav-item <?php echo ($_REQUEST['page']??'')== 'user-profile'?'active':'' ?> ">
                    <a class="nav-link text-dark" aria-current="page" href="user_profile.php?page=user-profile"> profile <i class="fa fa-user" aria-hidden="true"></i> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="../logout.php"><?php echo $_SESSION['user']['first_name']??" "?> <i class="fa fa-sign-out" aria-hidden="true"></i> </a>
                </li>
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="img-fluid logo" src="../images/hist_logo_no_bg.png" alt=""></a>
            <button class="navbar-toggler navbar-light rounded-0 border border-1 " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item <?php echo ($_REQUEST['page']??'')== 'admin-panel'?'active':'' ?>">
                        <a href="admin_panel.php?page=admin-panel" class="nav-link text-dark" aria-current="page" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark dropdown-toggle " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-list-alt" aria-hidden="true"></i> Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                                $select_category = "SELECT * FROM category";
                                $category_result = mysqli_query($connection, $select_category);
                                if($category_result){
                                    while ($category_list = mysqli_fetch_assoc($category_result)){
                                    ?>
                                        <li class="">
                                            <a onclick="manage_category(this)" class="dropdown-item" href="#"><?php echo $category_list['category_title']?></a>
                                        </li>
                                    <?php
                                    }
                                }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item <?php echo ($_REQUEST['page']??'')== 'about-us'?'active':'' ?> ">
                        <a href="about-us.php?page=about-us" class="nav-link text-dark"><i class="fa fa-address-card-o" aria-hidden="true"></i> About Us</a>
                    </li>
                    <li class="nav-item <?php echo ($_REQUEST['page']??'')== 'contact-us'?'active':'' ?>">
                        <a href="contact-us.php?page=contact-us" class="nav-link text-dark "><i class="fa fa-fw fa-envelope"></i> Contact Us</a>
                    </li>
                </ul>
                <div class="searchDiv">
                    <form class="d-flex">
                        <!-- <a class="loginBtns" href="#"> Sign up</a> -->
                        <input class="form-control me-2 rounded-0" type="search" placeholder="Search Posts, Categories" aria-label="Search">
                        <button class="btn btn-outline-dark rounded-0" type="submit"><i class="fa fa-fw fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <!-- Header end -->