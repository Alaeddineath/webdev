<?php

session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['password']) || !isset($_SESSION['role'])) {
    header("location: ../adminlogin.php");
    exit();
}


// Create a connection to the database
$conn = mysqli_connect("localhost", "root", "", "rihlate");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data from the "user" table
$sql = "SELECT * FROM destination";
$result = $conn->query($sql);

if (isset($_GET['delete'])) {
    // Sanitize the destination name and city to prevent SQL injection
    $name_destination = $_GET['name_destination'];
    $name_destination = $conn->real_escape_string($name_destination);
    
    $city = $_GET['city'];
    $city = $conn->real_escape_string($city);

    // Delete the destination from the database
    $sql1 = "DELETE FROM destination WHERE name_destination = '$name_destination' AND city = '$city'";
    if ($conn->query($sql1) === TRUE) {
        header('Location: destinations.php');
    } else {
        echo "Error deleting destination: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <style>
    /* CSS rule to set the color of the update text */
    a.update-link {
        color: blue;
    }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 100">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.PHP">RIHLAT-E admin</a> 
            </div>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;"><a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> 
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
                    </li>
                    <li>
                        <a href="index.PHP"><i class="fa fa-dashboard fa-3x"></i> Dashboard </a>
                    </li>
                    <li>
                        <a  href="users.php"><i class="fa fa-user fa-3x"></i> USERS</a>
                    </li>
                    <li>
                    <a  href="hotels.php"><i class="fa fa-bar-chart-o fa-3x"></i> HOTELS</a>

                    </li>
                    <li>
                        <a  href="guides.php"><i class="fa fa-users fa-3x"></i> GUIDES</a>
                    </li>
                    <li>
                        <a  href="travelplans.php"><i class="fa fa-plane fa-3x"></i> TRAVEL PLANS</a>
                    </li>
                    <li>
                        <a class="active-menu" href="destinations.php"><i class="fa fa-globe fa-3x"></i> DESTINATIONS</a>
                    </li>
                    <li>
                        <a  href="reservations.php"><i class="fa fa-book fa-3x"></i> RESERVATIONS</a>
                    </li>
                    <li>
                        <a href="activities.php"><i class="fa fa-tasks fa-3x"></i> ACTIVITIES</a>
                    </li>					
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="wrapper">
        <!-- navigation code -->
        <div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>DESTINATIONS</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <a href="destinations.create.php" class="btn btn-primary" style="background-color: transparent; border-color: transparent; color: #337ab7;">Create New Distination</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Description</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row['name_destination'] . '</td>';
                                            echo '<td>' . $row['city'] . '</td>';
                                            echo '<td>' . $row['description'] . '</td>';
                                            echo '<td>';
                                            echo '<button class="btn btn-primary">
                                            <a href="destinations.update.php?name_destination=' . $row['name_destination'] . '&city=' . $row['city'] . '" class="text-light" style="border: none; background-color: transparent; color: white; cursor: pointer;";">Update</a></button>';                                            echo ' | ';
                                            echo '<form action="" method="GET" style="display: inline;">';
                                            echo '<input type="hidden" name="name_destination" value="' . $row['name_destination'] . '">';
                                            echo '<input type="hidden" name="city" value="' . $row['city'] . '">';
                                            echo '<input type="submit" name="delete" value="Delete" style="border: none; background-color: transparent; color: red; cursor: pointer;">';
                                            echo '</form>';
                                            echo '</td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">No destinations found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTTOM TO REDUCE THE LOAD TIME -->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="assets/js/jquery.metisMenu.js"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="assets/js/dataTables/jquery.dataTables.js"></script>
<script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>

         <!-- CUSTOM SCRIPTS -->
         <script src="assets/js/custom.js"></script>  
</body>
</html>
