<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['password']) || !isset($_SESSION['role'])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

// Create a connection to the database
$conn = mysqli_connect("localhost", "root", "", "rihlate");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the counts from the database
$userCountQuery = "SELECT COUNT(*) AS userCount FROM user";
$travelPlanCountQuery = "SELECT COUNT(*) AS travelPlanCount FROM travel_plan";
$hotelCountQuery = "SELECT COUNT(*) AS hotelCount FROM hotel";
$reservationCountQuery = "SELECT COUNT(*) AS reservationCount FROM reservation";
$commentCountQuery = "SELECT COUNT(*) AS commentCount FROM comment";
$reviewCountQuery = "SELECT COUNT(*) AS reviewCount FROM review";
$destinationCountQuery = "SELECT COUNT(*) AS destinationCount FROM destination";
$requestCountQuery = "SELECT COUNT(*) AS requestCount FROM request";
$activityCountQuery = "SELECT COUNT(*) AS activityCount FROM activity";
$paymentCountQuery = "SELECT COUNT(*) AS paymentCount FROM payment";
$transportCountQuery = "SELECT COUNT(*) AS transportCount FROM transport";

$userCountResult = $conn->query($userCountQuery);
$travelPlanCountResult = $conn->query($travelPlanCountQuery);
$hotelCountResult = $conn->query($hotelCountQuery);
$reservationCountResult = $conn->query($reservationCountQuery);
$commentCountResult = $conn->query($commentCountQuery);
$reviewCountResult = $conn->query($reviewCountQuery);
$destinationCountResult = $conn->query($destinationCountQuery);
$requestCountResult = $conn->query($requestCountQuery);
$activityCountResult = $conn->query($activityCountQuery);
$paymentCountResult = $conn->query($paymentCountQuery);
$transportCountResult = $conn->query($transportCountQuery);

$userCount = $userCountResult->fetch_assoc()["userCount"];
$travelPlanCount = $travelPlanCountResult->fetch_assoc()["travelPlanCount"];
$hotelCount = $hotelCountResult->fetch_assoc()["hotelCount"];
$reservationCount = $reservationCountResult->fetch_assoc()["reservationCount"];
$commentCount = $commentCountResult->fetch_assoc()["commentCount"];
$reviewCount = $reviewCountResult->fetch_assoc()["reviewCount"];
$destinationCount = $destinationCountResult->fetch_assoc()["destinationCount"];
$requestCount = $requestCountResult->fetch_assoc()["requestCount"];
$activityCount = $activityCountResult->fetch_assoc()["activityCount"];
$paymentCount = $paymentCountResult->fetch_assoc()["paymentCount"];
$transportCount = $transportCountResult->fetch_assoc()["transportCount"];

$conn->close();
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
                        <a class="active-menu" href="index.PHP"><i class="fa fa-dashboard fa-3x"></i> Dashboard </a>
                    </li>

                    <li>
                        <a  href="users.php"><i class="fa fa-user fa-3x"></i> USERS</a>
                    </li>
                    <li>
                    <a  href="hotels.php"><i class="fa fa-bar-chart-o fa-3x"></i> HOTELS</a>

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
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <?php echo $_SESSION['name'] ?>, Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                 <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $userCount; ?></p>
                                <p class="text-muted">Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-plane"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $travelPlanCount; ?></p>
                                <p class="text-muted">Travel Plans</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class="fa fa-bar-chart-o"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $hotelCount; ?></p>
                                <p class="text-muted">Hotels</p>
                            </div>
                        </div>
                    </div>
                    <!-- ... -->
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-comments"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $commentCount; ?></p>
                                <p class="text-muted">Comments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-star"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $reviewCount; ?></p>
                                <p class="text-muted">Reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class="fa fa-globe"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $destinationCount; ?></p>
                                <p class="text-muted">Destinations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-brown set-icon">
                                <i class="fa fa-bookmark"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $reservationCount; ?></p>
                                <p class="text-muted">Reservations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-purple set-icon">
                                <i class="fa fa-file"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $requestCount; ?></p>
                                <p class="text-muted">Requests</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-orange set-icon">
                                <i class="fa fa-tasks"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $activityCount; ?></p>
                                <p class="text-muted">Activities</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-pink set-icon">
                                <i class="fa fa-credit-card"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $paymentCount; ?></p>
                                <p class="text-muted">Payments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-darken set-icon">
                                <i class="fa fa-train"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?php echo $transportCount; ?></p>
                                <p class="text-muted">Transports</p>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
</div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
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
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable();
    });
</script>

    
   
</body>
</html>
