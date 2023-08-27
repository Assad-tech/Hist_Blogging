    <!-- Footer Starts -->
    <div class="container-fluid footerDiv bg-light">
        <div class="row ">
        <div class="col-lg-6 col-md-6">
            <div class="card text-center">
                    <ul class="list-group ">
                        <li class="list-group-item bg-light"><a href="#"><i class="fa fa-address-card-o" aria-hidden="true"></i> About Us</a></li>
                        <li class="list-group-item bg-light"><a href="#"><i class="fa fa-fw fa-envelope"></i> Contact Us</a></li>
                        <li class="list-group-item bg-light"><a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Categories</a></li>
                    </ul>
                </div>
            </div>    
        <div class="col-lg-6 col-md-6">
                <div class="card text-center footer_Card" >
                    <ul class="list-group">
                        <li class="list-group-item bg-light"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                        <li class="list-group-item bg-light"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                        <li class="list-group-item bg-light"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i> Linkedin</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row text-center footerCopyRights">
            <p>copyright &copy; 2022 all rights reserved</p>
        </div>
    </div>
        <!-- Data table Script -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <!-- Js Files -->
    <script type="text/javascript" src="js/admin.js"></script>
    <script type="text/javascript" src="js/user.js"></script>
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
</body>

</html>