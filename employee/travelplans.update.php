<?php

session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['password']) || !isset($_SESSION['role'])) {
    header("location: ../adminlogin.php");
    exit();
}


    $conn = mysqli_connect("localhost", "root", "", "rihlate");

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated travel plan information from the form
        $name = $_POST['name'];
        $date = $_POST['date'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $availability = isset($_POST['availability']) ? 1 : 0;
        $description = $_POST['description'];
        $guide_id = $_POST['guide_id'];
        $hotel_id = $_POST['hotel_id'];
        $destination = $_POST['destination'];
        $travel_id = $_GET['id'];

        // Update the travel plan information in the database
        $sql = "UPDATE travel_plan SET name='$name', date='$date', price='$price', duration='$duration', availability='$availability', description='$description', guide_id='$guide_id', hotel_id='$hotel_id', destination='$destination' WHERE travel_id='$travel_id'";
        
        if ($conn->query($sql) === true) {
            // Redirect back to the travel plans page
            header('Location: travelplans.php');
            exit();
        } else {
            echo "Error updating travel plan: " . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
                        <a href="users.php"><i class="fa fa-user fa-3x"></i> USERS</a>
                    </li>
                    <li>
                    <a href="hotels.php"><i class="fa fa-bar-chart-o fa-3x"></i> HOTELS</a>

                    </li>
                    <li>
                        <a href="guides.php"><i class="fa fa-users fa-3x"></i> GUIDES</a>
                    </li>
                    <li>
                        <a class="active-menu" href="travelplans.php"><i class="fa fa-plane fa-3x"></i> TRAVEL PLANS</a>
                    </li>
                    <li>
                        <a href="destinations.php"><i class="fa fa-globe fa-3x"></i> DESTINATIONS</a>
                    </li>
                    <li>
                        <a href="reservations.php"><i class="fa fa-book fa-3x"></i> RESERVATIONS</a>
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
                    <h2>UPDATE TRAVEL PLAN</h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <div class="row">
                <div class="col-md-12">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" >
                            </div>
                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" name="date" >
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" step="0.01" class="form-control" name="price" >
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration:</label>
                                <input type="number" class="form-control" name="duration" >
                            </div>
                            <div class="form-group">
                                <label for="availability">Availability:</label>
                                <input type="checkbox" class="form-check-input" name="availability">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" name="description" rows="5" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="guide_id">Guide ID:</label>
                                <input type="number" class="form-control" name="guide_id"  placeholder="Please enter a valid ID">
                            </div>
                            <div class="form-group">
                                <label for="hotel_id">Hotel ID:</label>
                                <input type="number" class="form-control" name="hotel_id" placeholder="Please enter a valid ID">
                            </div>
                            <div class="form-group">
                                <label for="destination">Destination:</label>
                                <textarea class="form-control" name="destination" rows="5"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Update">
                        </form>
                        </div>
            </div>
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->    
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
