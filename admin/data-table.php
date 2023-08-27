    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
    <!-- <script type="text/javascript" src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <div class="activity-head">
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
                        <table border="0" cellspacing="0">
                            <form enctype="">
                                <tr>
                                    <td colspan="4" id="msg"></td>
                                </tr>
                                <tr>
                                    <td>First Name:</td>
                                    <td><input type="text" name="fisrt_name" id="fisrt_name" placeholder="Enter Name"></td>
                                    <td>Last Name: </td>
                                    <td><input type="text" name=" last_name" id=" last_name" placeholder="Enter Last Name"></td>
                                </tr>
                                <tr>
                                    <td>Email: </td>
                                    <td><input type="text" name="email" id="email" placeholder="abc@gmail.com"></td>
                                    <td>Password:</td>
                                    <td><input type="password" name="password" id="password" placeholder="1234"> </td>
                                </tr>
                                <tr>
                                    <td>Date of Birth:</td>
                                    <td><input type="date" name="dob"></td>
                                    <td>Gender:</td>
                                    <td>
                                        <input type="radio" name="gender" id="gender"> Male
                                        <input type="radio" name="gender" id="gender"> Female
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Upload Profile:</td>
                                    <td colspan="2"><input type="file" name="profile-img" id="profile-img"></td>
                                </tr>
                                <tr>
                                    <td colspan="4"> <button class="activity-btns">Add User</button></td>
                                </tr>
                            </form>
                        </table>
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
    <table id="myTable">
        <thead>
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
            </tr>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        /*$(document).ready( function () {
            alert("Hello");
            // $('#table_id').DataTable();
        } );*/

        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>