<?php 
define('WebAirFW', true);
require("php/framework.php");

if($_POST) {
	if(login($_POST['type'], $_POST['username'], $_POST['password']) == true) {
		if($_POST['type'] == 'customer') {
			updateField('customer', $_POST['username']);
			header('location: choose.php');
		} else {
			updateField('flight', $_POST['username']);
			$booking = getFlight($_POST['username']);
			updateField('outRoute', $booking['outRoute']);
			updateField('retRoute', $booking['retRoute']);
			updateField('outDate', $booking['outDate']);
			updateField('retDate', $booking['retDate']);
			updateField('passengers', $booking['passengers']);
			updateField('insurance', $booking['insurance']);
			updateField('carbon', $booking['carbon']);
			updateField('luggage', $booking['luggage']);
			updateField('priority', $booking['priority']);
			updateField('customer', $booking['customer']);
			header('location: book.php');
		}
	}
}
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | Login</title>
    <link type="text/css" href="styles/main.css" rel="stylesheet" />
    <link type="text/css" href="styles/nav.css" rel="stylesheet" />
	<link rel="stylesheet" href="styles/jqueryui.css" type="text/css" />
	
	<script src="js/jquery.lib.js" type="text/javascript"></script>
	<script src="js/jqueryui.lib.js" type="text/javascript"></script>
    <script type="text/javascript">
		$("html").removeClass("nojs");

    </script>
      <style>
		/* I'm sorry. */
		#maincontent {
			margin-top:-7px;
		}
		
		#maincontent {
			float:none;
			margin: 0 auto;
			width:700px;
		}
		
		.mainbox {
			width:706px;
		}
		h2 {
			width:708px;
		}
	</style>
	<script src="js/forms.js" type="text/javascript"></script>
</head>

<body>
	<div id="contall"> 
    	<div id="mainheader">
        	<div id="mainlogo">
            	<a href="index.php"><h1>flywebair.com</h1></a>
			</div><!--mainlogo-->
            <div id="mainnav">
        	<ul>
				<li class="home"><a href="index.php">Home</a></li>
				<li class="about"><a href="about.php">About</a></li>
				<li class="book"><a href="book.php">Book</a></li>
				<li class="login"><a href="login.php">Login</a></li>
			</ul>
            </div><!--mainnav-->
        </div> <!--mainheader-->
        <div id="maincontent">
        	            
			<h2>Choose your login method</h2>

            <div class="mainbox">
                        <p>Please select to log in using your one-time booking number and security code or your username and password (if you've previously created an account on WebAir.)
				<div id="unregistered">
                <form id="login_unregistered" method="post" action="login.php">
                	<input type="hidden" name="type" value="booking" />
                    <span>Booking number: </span>
                    <input type="text" name="username" maxlength="8"/>
                    <span>Security code: </span>
                    <input type="text" name="password" maxlength="8"/>
            		<input type="submit" value="Login" name="submit_registered" />
                </form>
                </div>
                <div id="registered">
                <form id="login_registered" method="post" action="login.php">
                	<input type="hidden" name="type" value="customer" />
                    <span>Username: </span>
                    <input type="text" name="username"/>
                    <span>Password: </span>
                    <input type="password" name="password"/>
            		<input type="submit" value="Login" name="submit_unregistered" />
                </form>
                </div>
                    
			</div><!--mainbox-->
                
            
        </div><!--maincontent-->
        

        

	</div><!--contall-->
            <div id="mainfooter">
        <p><a href="about.php">about us</a> | <a href="contact.php">contact us</a> | <a href="terms.php">terms and conditions</a></p>
        </div><!--mainfooter-->
</body>
</html>
