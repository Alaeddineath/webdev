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

// Retrieve data from the hotel table
$sql = "SELECT * FROM hotel";
$result = $conn->query($sql);


// Delete hotel if delete button is clicked
if (isset($_GET['delete'])) {
    // Sanitize the hotel ID to prevent SQL injection
    $hotel_id = $_GET['id'];
    $hotel_id = $conn->real_escape_string($hotel_id);

    // Delete the hotel from the database
    $delete_sql = "DELETE FROM hotel WHERE hotel_id = $hotel_id";
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: hotels.php"); // Redirect to hotels.php
        exit();
    } else {
        echo "Error deleting hotel: " . $conn->error;
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
                    <a href="employees.php"><i class="fa fa-briefcase fa-3x"></i> EMPLOYEES</a>
                    </li>
                    <li>
                        <a  href="users.php"><i class="fa fa-user fa-3x"></i> USERS</a>
                    </li>
                    <li>
                    <a  class="active-menu" href="hotels.php"><i class="fa fa-bar-chart-o fa-3x"></i> HOTELS</a>

                    </li>
                    <li>
                        <a href="guides.php"><i class="fa fa-users fa-3x"></i> GUIDES</a>
                    </li>
                    <li>
                        <a  href="travelplans.php"><i class="fa fa-plane fa-3x"></i> TRAVEL PLANS</a>
                    </li>
                    <li>
                        <a href="destinations.php"><i class="fa fa-globe fa-3x"></i> DESTINATIONS</a>
                    </li>
                    <li>
                        <a  href="reservations.php"><i class="fa fa-book fa-3x"></i> RESERVATIONS</a>
                    </li>
                    <li>
                        <a href="activities.php"><i class="fa fa-tasks fa-3x"></i> ACTIVITIES</a>
                    </li>
                </ul>			
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>HOTELS</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <a href="hotel.create.php" class="btn btn-primary" style="background-color: transparent; border-color: transparent; color: #337ab7;">Create New Hotel</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Hotel ID</th>
                                        <th>Rating</th>
                                        <th>Hotel Name</th>
                                        <th>Hotel Location</th>
                                        <th>Phone Number</th>
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row['hotel_id'] . '</td>';
                                            echo '<td>' . $row['rating'] . '</td>';
                                            echo '<td>' . $row['hotel_name'] . '</td>';
                                            echo '<td>' . $row['hotel_location'] . '</td>';
                                            echo '<td>' . $row['phoneNum'] . '</td>';
                                            echo '<td>';
                                            echo '<button class="btn btn-primary">';
                                            echo '<a href="hotels.update.php?id=' . $row['hotel_id'] . '" class="text-light" style="border: none; background-color: transparent; color: white; cursor: pointer;">Update</a></button>';
                                            echo ' | ';
                                            echo '<form action="" method="GET" style="display: inline;">';
                                            echo '<input type="hidden" name="id" value="' . $row['hotel_id'] . '">';
                                            echo '<button type="submit" name="delete" style="border: none; background-color: transparent; color: red; cursor: pointer;">Delete</button>';
                                            echo '</form>';
                                            echo '</button>';
                                            echo '</td>';
                                            echo '</tr>';

                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No hotels found</td></tr>';
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
