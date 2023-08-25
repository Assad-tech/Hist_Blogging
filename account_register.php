<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new Account</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    span {
        color: red;
    }
</style>

<body>
    <div class="container-fluid ">
        <div class="row mt-4 shadow  register-account">
                <!-- form side div -->
                <div class="col-lg-5 register-side-img">
                    <img class="img-fluid" src="images/registration-img-2-no-bg.png" alt="">
                </div>
                <!-- registraion form div -->
                <div class="col-lg-7 bg-light register-main-div table-responsive">
                    <legend class="text-center">Registration Form</legend>
                    <form method="POST" action="register_process.php" onsubmit="return validation()" enctype="multipart/form-data">
                        <table class="table ">
                            <?php
                            if (isset($_REQUEST['message'])) { ?>
                                <tr>
                                    <td>
                                        <ul style="color:<?=$_REQUEST['color']?>">
                                            <?= $_REQUEST['message'] ?>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3"> Note: Required Fields are marked with <span>*</span></td>
                            </tr>
                            <tr>
                                <td>First Name: <span>*</span> </td>
                                <td><input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name"></td>
                                <td><span id="first_name_msg"></span></td>
                            </tr>
                            <tr>
                                <td>Last Name: </td>
                                <td><input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name"></td>
                                <td><span id="last_name_msg"></span></td>
                            </tr>
                            <tr>
                                <td>Email:<span>*</span> </td>
                                <td><input type="text" name="email" id="email" class="form-control" placeholder="Email abc@gmail.com"></td>
                                <td><span id="email_msg"></span></td>
                            </tr>
                            <tr>
                                <td>Password:<span>*</span> </td>
                                <td><input type="password" name="password" id="password" class="form-control" placeholder="Enter Password"></td>
                                <td><span id="password_msg"></span></td>
                            </tr>

                            <tr>
                                <td>Date of Birth:<span>*</span> </td>
                                <td><input type="date" name="date-of-birth" id="date-of-birth" class="form-control" required></td>
                                <td><span id="date-of-birth_msg"></span></td>
                            </tr>
                            <tr>
                                <td>Gender:<span>*</span> </td>
                                <td>
                                    <input type="radio" name="gender" id="gender_male" value="male" checked="Male"> Male
                                    <input type="radio" name="gender" id="gender_female" value="female"> Female
                                </td>
                                <td><span id="gender_msg"></span></td>
                            </tr>
                            <tr>
                                <td>Address:<span>*</span></td>
                                <td>
                                    <textarea name="address" id="address" cols="17" rows="3" class="form-control" placeholder="Enter Address">This is Addres Example, can be rest.</textarea>
                                </td>
                                <td><span id="address_msg"></span></td>
                            </tr>
                            <tr>
                                <td>Upload Photo:<span>*</span> </td>
                                <td><input type="file" name="profile_img" id="profile_img" accept="Image/*"></td>
                                <td><span id="Profile_img_msg"></span></td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <input type="submit" name="register" class="btn register-btn w-100" value="Create Account">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Having an account?
                                </td>
                                <td>
                                    <a href="login.php" class="btn register-btn w-25">Login</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- registration form end -->
        </div>
    </div>
            	<!-- footer -->
	<div class="py-4 px-4 px-xl-5 login-footer">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">
			Copyright © 2020. All rights reserved.
		</div>
	</div>

</body>
<!-- JS Files -->
<script src="js/admin.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
</html>