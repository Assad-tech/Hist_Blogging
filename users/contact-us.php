<?php
include("include/header.php");
?>
<div class="container-fluid row">
    <!-- Feedback Form -->
    <div class="col-lg-6 col-md-6 col-sm-12 sideBar ">
        <div class="card rounded-0 border-0 mt-3 mb-3">
            <div class="card-header rounded-0 border-0 h4">
                WHAT SHOULD WE IMPROVE
            </div>
            <div class="card-body">
                <p class="card-text">Send Us Feedback So that we could improve our Blog's Quality</p>
            </div>
            <form method="POST" action="user_panel_process.php" class="">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="name" name="user_name" class="form-control" id="exampleInputName1" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Example textarea</label>
                    <textarea name="feedback" class="form-control" id="exampleFormControlTextarea1" rows="7" placeholder="Your Message Here"></textarea>
                </div>
                <div class="form-check">
                </div>
                <button type="submit" name="feedback_btn" class="activity-btns rounded-0 border-0">Submit</button>
            </form>

        </div>
    </div>
    <!-- Contact us Emails of Admins and Address -->
    <div class="col-lg-6 col-md-6 col-sm-12 activity-area">
        <div class="card rounded-0 border-0 mt-3 mb-3">
            <div class="card-header rounded-0 border-0 h4">
                Admin Help
            </div>
            <div class="card-body">
                <p class="card-text">This is Example Text With supporting text below as a natural lead-in to additional content.</p>
                <div class="admin-email-nd-phone">
                    <!-- Admin Emails and Phone -->
                    <div class="card mb-3 rounded-0 border-0">
                        <div class="row no-gutters">
                            <div class="col-md-4 col-sm-4 col-xsm-4 m-0 blogger-img">
                                <img class="rounded-circle w-50 h-75 ms-5 mt-4" src="../images/blogger-1.jpg" alt="...">
                            </div>
                            <div class="col-md-8 col-sm-8 col-xsm-8 p-0 m-0">
                                <div class="card-body blogger-contact">
                                    <h5 class="card-title">Robert Denory</h5>
                                    <p class="card-text text-primary p-0 m-0">robertD@gmail.com</p>
                                    <p class="card-text"><small class="text-muted">+92 315 1234567</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Admin Emails and Phone -->
                    <div class="admin-email-nd-phone">
                    <div class="card mb-3 rounded-0 border-0">
                        <div class="row no-gutters">
                            <div class="col-md-4 col-sm-4 col-xsm-4 blogger-img">
                                <img class="rounded-circle w-50 h-75 ms-5 mt-4" src="../images/blogger-2.jpg" alt="...">
                            </div>
                            <div class="col-md-8 col-sm-8 col-xsm-8 p-0 m-0">
                                <div class="card-body blogger-contact">
                                    <h5 class="card-title">Mark Otto</h5>
                                    <p class="card-text text-primary p-0 m-0">ottoMark@gmail.com</p>
                                    <p class="card-text"><small class="text-muted">+92 315 1234567</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Address now -->
                    <div class="card rounded-0 border-0">
                        <div class="card-body">
                            <h5 class="card-title bg-light p-2 ">Office Address</h5>
                            <h6 class="card-subtitle mb-2 text-muted">14 Sweet Laurel Street, Las Vegas,nv, 89138 United States</h6>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php
include("include/footer.php");
?>