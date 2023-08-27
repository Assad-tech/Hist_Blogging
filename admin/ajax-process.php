<?php
session_start();
require_once("../database/database.php");

// Customize Blog Settings
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'customize_blog') {
    $select_query = "SELECT * FROM blog ORDER BY blog_id DESC";
    $result = mysqli_query($connection, $select_query);
?>
    <div class="activity-head float-end">
        <h3 class="bg-white p-1 text-center">Customize your Blog</h3>
        <button onclick="create_blog()" class="activity-btns mb-3"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Blog</button>
    </div>
    <div class="table-responsive float-start">
        <table class="table" id="myTable">
            <thead class="bg-light text-dark">
                <tr>
                    <th colspan="9" class="table-heading">Blog Setting</th>
                </tr>
                <tr>
                    <th colspan="9" class="table-heading" id="message"></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User Id</th>
                    <th scope="col">Blog Title</th>
                    <th scope="col">Posts per Page</th>
                    <th scope="col">Blog Background Image</th>
                    <th scope="col">Blog Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Last Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <?php
            if ($result) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tbody>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['user_id'] ?></td>
                            <td><?= $row['blog_title'] ?></td>
                            <td>Not Defined.!</td>
                            <td>Not Selected.!</td>
                            <td><?= $row['blog_status'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td><?= $row['updated_at'] ?></td>
                            <td>
                                <button onclick="edit_blog(<?= $row['blog_id'] ?>)" class="activity-btns mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            </td>
                        </tr>
                    </tbody>
            <?php
                    $i++;
                }
            }
            ?>
        </table>
    </div>
<?php
}
// Create Blog Button
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'create_blog') {
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Create Blog</h3>
    </div>
    <div class="table-responsive">
        <form action="admin_panel_process.php" method="POST">
            <table class="table" border="1">
                <th>Blog Title</th>
                <td><input type="text" name="blog_title" id="blog_title" placeholder="Blog Title Here"></td>
                <th>Posts per Page</th>
                <td><input type="text" name="post-pr-page" id="post-pr-page" placeholder=" No Posts per Page"></td>
                <tr>
                    <th>Blog Background Image</th>
                    <td><input type="file" name="blog-bg-img" id="blog-bg-img"></td>
                    <th>Blog Status</th>
                    <td>
                        <select name="blog_status" id="blog_status">
                            <option value="">Active</option>
                            <option value="">In-active</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="create_blog" id="create_blog" value="Create Blog" class="activity-btns">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php
}
// Edit Blog 
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_blog') {
    $edit_query = "SELECT * FROM blog WHERE blog_id='" . $_REQUEST['blog_id'] . "'";
    $result = mysqli_query($connection, $edit_query);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Update Blog</h3>
    </div>
    <div class="table-responsive">
        <form action="admin_panel_process.php" method="POST">
            <table class="table" border="1">
                <?php
                if ($result) {
                    $blog_data = mysqli_fetch_assoc($result);
                ?>
                    <th>Blog Title</th>
                    <td><input type="text" name="blog_title" id="blog_title" value="<?= $blog_data['blog_title'] ?>"></td>
                    <th>Posts per Page</th>
                    <td><input type="text" name="post_pr_page" id="post_pr_page" value="Not Defined..!"></td>
                    <tr>
                        <th>Blog Background Image</th>
                        <td><input type="file" name="blog_bg_img" id="blog_bg_img" disabled></td>
                        <th>Blog Status</th>
                        <td>
                            <select name="blog_status" id="blog_status">
                                <option <?php
                                        if ($blog_data['blog_status'] == "active") {
                                            echo "selected";
                                        }
                                        ?> value="active">Active</option>
                                <option <?php
                                        if ($blog_data['blog_status'] == "in-active") {
                                            echo "selected";
                                        }
                                        ?> value="in-active">In-active</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="user_id" value="<?= $blog_data['user_id'] ?>"></td>
                        <td><input type="hidden" name="blog_id" value="<?= $blog_data['blog_id'] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="update_blog" id="update_blog" value="Update Blog" class="activity-btns">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
<?php
}
// Add Category Button
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_category') {
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Create Category</h3>
    </div>
    <div class="table-responsive">
        <table class="table" border="1">
            <tr>
                <th>Category Title</th>
                <td><input type="text" name="category_title" id="category_title" placeholder="Category Title Here"></td>
                <th>Add Description</th>
                <td>
                    <textarea name="category_description" id="category_description" cols="25" rows="1" placeholder="Write Category Description"></textarea>
                </td>
            <tr>
            </tr>
            <tr>
                <th>Category Status</th>
                <td colspan="3">
                    <select name="category_status" id="category_status">
                        <option value="active">Active</option>
                        <option value="in-active">In-active</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button onclick="create_Category()" type="submit" class="activity-btns" id="create_category"> Create Category</button>
                </td>
            </tr>
        </table>
    </div>
<?php
}
// Create Category Button
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'create_Category') {
    extract($_REQUEST);

    $insert_query = "INSERT INTO category (category_title,category_description,category_status,created_at)
    VALUES('" . $category_title . "','" . $category_description . "','" . $category_status . "',Now())";
    $result = mysqli_query($connection, $insert_query);
    if ($result) {
        $user_id = mysqli_insert_id($connection);
        echo "<p style='color:green;'>Category Added. </p>";
    } else {
        echo "<p style='color:red;'> Error Found!</p>";
    }
} //End Create Category
// Manage Categories
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage_category') {
    $select_query = "SELECT * FROM category ORDER BY category_id DESC";
    $result = mysqli_query($connection, $select_query);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Manage Categories</h3>
        <button onclick="add_category()" class="activity-btns mb-3 d-block float-end"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Category</button>
    </div>
    <div class="table-responsive float-start mx-2 mb-1">
        <table class="table" id="myTable">
            <thead class="bg-light text-dark">
                <tr>
                    <th colspan="7" class="table-heading">Categories</th>
                </tr>
                <tr>
                    <th colspan="7" class="table-heading" id="message"></th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Title</th>
                    <th scope="col">Meta Description</th>
                    <th scope="col">Category Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Last Updated At</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <?php
            if ($result) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tbody>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['category_title'] ?></td>
                            <td><?= $row['category_description'] ?></td>
                            <td><?= $row['category_status'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td><?= $row['updated_at'] ?></td>
                            <td>
                                <button onclick="edit_category(<?= $row['category_id'] ?>)" class="activity-btns mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            </td>
                        </tr>
                    </tbody>
            <?php
                    $i++;
                }
            }
            ?>
        </table>
    </div>
<?php
}
// Edit category 
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_category') {

    $edit_query = "SELECT * FROM category WHERE category_id='" . $_REQUEST['category_id'] . "'";
    $result = mysqli_query($connection, $edit_query);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Update Category</h3>
    </div>
    <div class="table-responsive">
        <form action="admin_panel_process.php" method="POST">
            <table class="table" border="1">
                <?php
                if ($result) {
                    $category_data = mysqli_fetch_assoc($result);
                ?>
                    <tr>
                        <th>Category Title</th>
                        <td><input type="text" name="category_title" id="category_title" value="<?= $category_data['category_title'] ?>"></td>
                        <th>Category Description</th>
                        <td>
                            <textarea name="category_description" id="category_description" cols="25" rows="1" placeholder="Write Category Description">
                        <?= $category_data['category_description'] ?>
                        </textarea>
                            <!-- <input type="text" name="category_description" id="category_description" value="<?= $category_data['category_description'] ?>"> -->
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">Category Status</th>
                        <td colspan="2">
                            <select name="category_status" id="category_status">
                                <option <?php
                                        if ($category_data['category_status'] == "active") {
                                            echo "selected";
                                        }
                                        ?> value="active">Active</option>
                                <option <?php
                                        if ($category_data['category_status'] == "in-active") {
                                            echo "selected";
                                        }
                                        ?> value="in-active">In-active</option>
                            </select>
                        </td>
                        <td><input type="hidden" name="user_id" value="<?= $_SESSION['user']['user_id'] ?>"></td>
                        <td><input type="hidden" name="category_id" value="<?= $category_data['category_id'] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="update_category" id="update_category" value="Update Category" class="activity-btns">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
<?php
}
// Manage Posts
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage_post') {
    $select_post = "SELECT * FROM post p INNER JOIN post_category pc ON p.post_id = pc.post_id INNER JOIN category c ON pc.category_id = c.category_id ORDER BY p.post_id DESC";
    $result = mysqli_query($connection, $select_post);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Manage Posts Activities</h3>
        <!-- Create Post btn -->
        <button onclick="add_post()" type="button" class="activity-btns mb-3">
            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Posts
        </button>
    </div>
    <div class="table-responsive w-100">
        <table class="table" id="myTable">
            <thead class="bg-light text-dark">
                <tr>
                    <th colspan="12" class="table-heading">Posts</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Blog Id</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Summary</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Post Status</th>
                    <th scope="col">Comment Allowed</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($result) {
                    // $data = mysqli_fetch_assoc($result);
                    $i = 1;
                    while ($row3 = mysqli_fetch_assoc($result)) {
                        // echo "<pre>";
                        // print_r($row3);
                ?>
                        <tr>
                            <td scope="row"><?= $i ?></td>
                            <th scope="row"><?= $row3['blog_id'] ?></th>
                            <th scope="row"><?= $row3['post_title'] ?></th>
                            <th scope="row"><img class="list_post_images" src="../<?php echo $row3['featured_image'] ?>"></th>
                            <th scope="row"><?= $row3['post_summary'] ?></th>
                            <th scope="row"><?= $row3['post_description'] ?></th>
                            <th scope="row"><?= $row3['category_title'] ?></th>
                            <th scope="row"><?= $row3['post_status'] ?></th>
                            <th scope="row"><?= $row3['is_comment_allowed'] ?></th>
                            <th scope="row"><?= $row3['created_at'] ?></th>
                            <th scope="row"><?= $row3['updated_at'] ?></th>
                            <td>
                                <button class="activity-btns mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} // Add Posts
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'add_post') {
    // Gettig Blogs List
    $select_blog = "SELECT * FROM blog WHERE user_id = '" . $_SESSION['user']['user_id'] . "' ";
    $result = mysqli_query($connection, $select_blog);

    // Getting Category List
    $select_category = "SELECT * FROM category";
    $result2 = mysqli_query($connection, $select_category);
?>
    <div class="activity-head">
        <h3 class="bg-light p-1 text-center">Add a new Post</h3>
        <p class="bg-secondary text-center text-white">Fill all fields carefully.</p>
    </div>
    <div class="table-responsive">
        <form action="admin_panel_process.php" method="POST" enctype="multipart/form-data">
            <table class="table" border="1">
                <tr>
                    <th>Select Blog Id</th>
                    <?php
                    if ($result) {
                    ?>
                        <td>
                            <select name="blog_id" id="blog_id">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option name="<?php echo $row['blog_id']; ?>" id="<?php echo $row['blog_id']; ?>" value="<?php echo $row['blog_id']; ?>"><?php echo $row['blog_title']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    <?php
                    }
                    ?>
                    <th>Select Category</th>
                    <?php
                    if ($result2) {
                    ?>
                        <td>
                            <select name="category_id" id="category_id">
                                <?php
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                ?>
                                    <option value="<?php echo $row2['category_id']; ?>"><?php echo $row2['category_title']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
                <tr>
                    <th>Post Title</th>
                    <td><input type="text" name="post_title" id="post_title" placeholder="Enter Post Title here.."></td>

                    <th>Post Summary</th>
                    <td>
                        <textarea rows="1" cols="22" id="post_summary" name="post_summary" placeholder="Post Summary"></textarea>
                    </td>
                </tr>
                <tr>
                    <th>Post Description</th>
                    <td>
                        <textarea rows="1" cols="22" id="post_description" name="post_description" placeholder="Post Description"></textarea>
                    </td>
                    <th>Featured Image</th>
                    <td>
                        <input type="file" name="featured_image" id="featured_image" accept="Image/*">
                    </td>
                </tr>
                <tr>
                    <th>Post Status</th>
                    <td colspan="">
                        <select name="post_status" id="post_status">
                            <option value="active">Active</option>
                            <option value="in-active">In-active</option>
                        </select>
                    </td>
                    <th>Comments</th>
                    <td colspan="">
                        <select name="comment_status" id="comment_status">
                            <option value="1">Allowed</option>
                            <option value="0">Not Allowed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Attachment Title</th>
                    <td>
                        <input type="text" name="attachment_title" id="attachment_title" placeholder="File Name">
                    </td>
                    <th>Post Attachment</th>
                    <td>
                        <input type="file" name="post_attachment" id="post_attachment" accept=".pdf, .doc, .docx, .xlsx, .xls, .csv">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="create_post" id="create_post" value="Create Create" class="activity-btns">
                    </td>
                </tr>
            </table>
        </form>
    </div>
<?php
}
// Manage Users
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage_user') {
    $select_user = "SELECT * FROM user WHERE is_approved='approved'";
    $result = mysqli_query($connection, $select_user);
?>
    <div class="activity-head float-end">
        <h3 class="bg-white p-1 text-center">Manage Users Activities</h3>
        <!-- User Requests Button -->
        <button class="activity-btns mb-3" onclick="user_request()"><i class="fa fa-question-circle-o" aria-hidden="true"></i> User Requests</button>

        <!-- Add user Form Model -->
        <!-- Button trigger modal -->
        <button type="button" class="activity-btns mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="fa fa-user-plus" aria-hidden="true"></i> Add User
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Add a User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="#" enctype="multipart/form-data">
                            <table border="0" cellspacing="0">
                                <?php
                                if (isset($_REQUEST['message'])) { ?>
                                    <tr>
                                        <td>
                                            <ul style="color:<?= $_REQUEST['color'] ?>">
                                                <?= $_REQUEST['message'] ?>
                                            </ul>
                                        </td>
                                    </tr>
                                <?php } ?> <tr>
                                    <td>First Name:</td>
                                    <td><input type="text" name="fisrt_name" id="fisrt_name" placeholder="Enter Name"></td>
                                    <td><span id="first_name_msg"></span></td>
                                    <td>Last Name: </td>
                                    <td><input type="text" name=" last_name" id=" last_name" placeholder="Enter Last Name"></td>
                                    <td><span id="last_name_msg"></span></td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td><input type="text" name="email" id="email" placeholder="abc@gmail.com"></td>
                                    <td><span id="email_msg"></span></td>
                                    <td>Password:</td>
                                    <td><input type="password" name="password" id="password" placeholder="1234"> </td>
                                    <td><span id="password_msg"></span></td>
                                </tr>
                                <tr>
                                    <td>Date of Birth:</td>
                                    <td><input type="date" name="date-of-birth" id="date-of-birth"></td>
                                    <td><span id="date-of-birth_msg"></span></td>
                                    <td>Gender:</td>
                                    <td>
                                        <input type="radio" name="gender" id="gender_male" value="Male"> Male
                                        <input type="radio" name="gender" id="gender_female" value="Female"> Female
                                    <td><span id="gender_msg"></span></td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><textarea name="address" id="address" cols="18" rows="1" placeholder="Address Here"></textarea></td>
                                    <td><span id="address_msg"></span></td>
                                    <td colspan="">Upload Profile:</td>
                                    <td colspan=""><input type="file" name="profile-img" id="profile-img"></td>
                                    <td><span id="Profile_img_msg"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input type="submit" name="register" id="" class="activity-btns" value="Add User">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="activity-btns" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Add User</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!--  Add User Form Model End   -->
    </div>
    <div class="table-responsive float-start">
        <table class="table display" id="myTable">
            <thead class="bg-light text-dark">
                <tr>
                    <th colspan="14" class="table-heading">User Information</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Gender</th>
                    <th scope="col">DoB</th>
                    <th scope="col">Profile Picture</th>
                    <th scope="col">Address</th>
                    <th scope="col">Account Status</th>
                    <th scope="col">User Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    // $data = mysqli_fetch_assoc($result);
                    // echo "<pre>";
                    // print_r($data);
                    // die;
                    $i = 1;
                    while ($user_row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $user_row['first_name'];
                                echo " ";
                                echo $user_row['last_name'] ?></td>
                            <td><?php echo $user_row['email'] ?></td>
                            <td><?php echo $user_row['password'] ?></td>
                            <td><?php echo $user_row['gender'] ?></td>
                            <td><?php echo $user_row['date_of_birth'] ?></td>
                            <td>
                                <img class="list_user_images" src="../<?= $user_row['user_image'] ?>" alt="">
                            </td>
                            <td><?= $user_row['address'] ?></td>
                            <td><?= $user_row['is_approved'] ?></td>
                            <td><?= $user_row['is_active'] ?></td>
                            <td><?= $user_row['created_at'] ?></td>
                            <td><?= $user_row['updated_at'] ?></td>
                            <td>
                                <!-- Edit Button  -->
                                <!-- Button trigger modal -->
                                <button type="button" class="activity-btns mb-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update User's Information</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Update Form Start -->
                                                <table border="0">
                                                    <tr>
                                                        <th scope="col">First Name</th>
                                                        <td>
                                                            <input type="text" name="fisrt_name" id="fisrt_name" placeholder="Enter Name" />
                                                        </td>

                                                        <th scope="col">Last Name</th>
                                                        <td>
                                                            <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Email</th>
                                                        <td>
                                                            <input type="text" name="email" id="email" placeholder="abc@gmail.com" />
                                                        </td>

                                                        <th scope="col">Password</th>
                                                        <td>
                                                            <input type="password" name="password" id="password" placeholder="122334" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Gender</th>
                                                        <td>
                                                            <input type="radio" name="gender" id="gender" /> Male
                                                            <input type="radio" name="gender" id="gender" /> Female
                                                        </td>

                                                        <th scope="col">DoB</th>
                                                        <td><input type="date" name="dob" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Profile Picture</th>
                                                        <td><input type="file" name="profile-img" id="profile-img" /></td>
                                                        <th scope="col">Address</th>
                                                        <td><input type="text" name="address" id="address" placeholder="Address here" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="col">Account Status</th>
                                                        <td>
                                                            <select name="is_approved" id="is_approved">
                                                                <option value="">Pending</option>
                                                                <option value="">Approved</option>
                                                                <option value="">Rejected</option>
                                                            </select>
                                                        </td>
                                                        <th scope="col">User Status</th>
                                                        <td>
                                                            <select name="is_active" id="is_active">
                                                                <option value="">Active</option>
                                                                <option value="">In-active</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <button class="activity-btns">Update User</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- Upate Form ends -->

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="activity-btns" data-bs-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit btn End -->
                                <!-- Remove user Btn -->
                                <!-- <button class="activity-btns"><i class="fa fa-retweet" aria-hidden="true"></i> change status</button> -->
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
// Manage User Requests
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'user_request') {
    $select_requests = "SELECT * FROM user WHERE is_approved='pending'";
    $result = mysqli_query($connection, $select_requests);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">List of User Requests</h3>
        <!-- <button class="activity-btns mb-3"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Posts</button> -->
    </div>
    <div class="table-responsive">
        <table class="table" id="myTable">
            <thead class="bg-light text-dark">
                <tr>
                    <th colspan="13" class="table-heading">User Requests</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Gender</th>
                    <th scope="col">DoB</th>
                    <th scope="col">Image</th>
                    <th scope="col">Address</th>
                    <th scope="col">Request Status</th>
                    <th scope="col">Account Status</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    $i = 1;
                    while ($request_row = mysqli_fetch_assoc($result)) {
                        // echo "<pre>";
                        // print_r($request_row);
                ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?= $request_row['first_name'] ?></td>
                            <td><?= $request_row['last_name'] ?></td>
                            <td><?= $request_row['email'] ?></td>
                            <td><?= $request_row['password'] ?></td>
                            <td><?= $request_row['gender'] ?></td>
                            <td><?= $request_row['date_of_birth'] ?></td>
                            <td>
                                <img class="list_post_images" src="../<?= $request_row['user_image'] ?>" alt="">
                            </td>
                            <td><?= $request_row['address'] ?></td>
                            <td><?= $request_row['is_approved'] ?></td>
                            <td><?= $request_row['is_active'] ?></td>
                            <td><?= $request_row['created_at'] ?></td>
                            <td>
                                <button class="activity-btns"><i class="fa fa-clock-o" aria-hidden="true"></i> Active</button>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

<?php
}


// Manage Comments
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage_comment') {
    $select_comment = "SELECT * FROM user_post_comment ORDER BY post_comment_id DESC";
    $result = mysqli_query($connection, $select_comment);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Manage Comments</h3>
    </div>
    <div class="table-responsive mx-2">

        <table class="table" id="myTable">
            <thead class="bg-light text-dark">
                <tr>
                    <th colspan="8" class="table-heading">All Comments</th>
                </tr>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post id</th>
                    <th scope="col">user id</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Comment Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result) {
                    // $data = mysqli_fetch_assoc($result);
                    // print_r($data);
                    // die;
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td scope="row"><?php echo $i ?></td>
                            <td><?= $row['post_id'] ?></td>
                            <td><?= $row['user_id'] ?></td>
                            <td><?= $row['comment'] ?></td>
                            <td><?= $row['is_active'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                            <td>
                                <button class="activity-btns mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            </td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
}
// Manage Feedback
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'manage_feedback') {
    $select_feedback = "SELECT * FROM user_feedback ORDER BY feedback_id DESC";
    $result = mysqli_query($connection, $select_feedback);
?>
    <div class="activity-head">
        <h3 class="bg-white p-1 text-center">Manage Feedbacks</h3>
    </div>
    <table class="table" id="myTable">
        <thead class="bg-light text-dark">
            <tr>
                <th colspan="8" class="table-heading">All Feedbacks</th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User id</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">Feedback</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // print_r($row);
                    // die;
            ?>
                    <tr>
                        <td scope="row"><?php echo $i ?></td>
                        <td><?= $row['user_id'] ?></td>
                        <td><?= $row['user_name'] ?></td>
                        <td><?= $row['user_email'] ?></td>
                        <td><?= $row['feedback'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td><?= $row['updated_at'] ?></td>
                        <td>
                            <button class="activity-btns mb-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                        </td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
<?php
}
// Edit User's Profile
elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit_admin_profile') {
    // print_r($_REQUEST);
    // die;
    $select_user = "SELECT * FROM user WHERE user_id='" . $_REQUEST['admin_id'] . "'";
    $result = mysqli_query($connection, $select_user);
    if ($result) {
        $user_info = mysqli_fetch_assoc($result);
        // echo "<pre>";
        // print_r($user_info);
        // die;
    }
?>
    <form action="admin_panel_process.php" method="post" enctype="multipart/form-data">
        <table class="table" border="1">
            <tr class="bg-light text-dark">
                <th colspan="8" class="table-heading"> Update Admin's Profile</th>
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
} else {
?>
    <h3>Data Not Found</h3>
<?php
}
?>