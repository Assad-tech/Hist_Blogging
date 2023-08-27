<?php
    	mysqli_report(MYSQLI_REPORT_OFF);

        define("host", "localhost");
        define("username", "root");
        define("password", "");
        define("database_name", "17837_asadullah");

        $connection = mysqli_connect(host,username,password,database_name);
        if(!$connection)
        {
            echo "Error No: ".mysqli_connect_errno()."<br />";
            echo "Error Message: ".mysqli_connect_error()."<br />";
            die("Database Connection Failed!.....");
        }
        // echo "<pre>";
        // print_r($connection);
        // echo "</pre>";
?>