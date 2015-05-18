<?php
include_once './session.php';
?>
<!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Online Bill Management</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
                
                <script src="charts/Chart.js"></script>
                <script src="lightbox/js/jquery-1.11.0.min.js"></script>
                <script src="lightbox/js/lightbox.min.js"></script>
                <link href="lightbox/css/lightbox.css" rel="stylesheet" />
                
                <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="index.php">OBM</a></h1>
                                <?php
                                    if(!empty($_SESSION['name']))
                                    {
                                    ?>
                                    <div style="text-align: center;"><i class="fa fa-user"></i> <?php echo $_SESSION['name']?></div>
                                    <?php
                                        } 
                                    else {
                                        ?>
                                    <?php
                                    }
                                ?>
				<nav id="nav">
					<ul>
                                            <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                                            <?php
                                            if(!empty($_SESSION['name']))
                                            {
                                            ?>
						<li><a href="add_bill.php"><i class="fa fa-plus"></i> Add bill</a></li>
                                                <li><a href="bills.php"><i class="fa fa-money"></i> Bills</a></li>
						<li><a href="stats.php"><i class="fa fa-area-chart"></i> My stats</a></li>
                                                <li><a href="logout.php" class="button special">Logout</a></li>
                                                <?php
                                            } 
                                            else {
                                                ?>
						<li><a href="login.php" class="button special">Login</a></li>
                                               <?php
                                            } 
                                                ?> 
					</ul>
				</nav>
			</header>
                