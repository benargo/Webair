<?php 
define('WebAirFW', true);
require("php/framework.php");

$session = returnSession();
$flight = getFlight($session['flight']);
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | Booking | Confirmation</title>
    <link type="text/css" href="styles/main.css" rel="stylesheet" />
    <link type="text/css" href="styles/nav.css" rel="stylesheet" />
	<link rel="stylesheet" href="styles/jqueryui.css" type="text/css" />
	
	<script src="js/jquery.lib.js" type="text/javascript"></script>
	<script src="js/jqueryui.lib.js" type="text/javascript"></script>
	<script>
	$(document).load(function(){
		$(".date").datepicker({
	  dateFormat:"dd/mm/yy", firstDay: 1,
	  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
	  });
	});
	  </script>
    	<style>
		/* I'm sorry. */
		#maincontent {
			margin-top:-7px;
		}
	</style>
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
                    
           <h2>Thank you for booking a flight with WebAir!</h2>
            <div class="mainbox">
            <p>Your booking number is <?php echo($session['flight']); ?>. You individual security code is <?php echo($flight['security']); ?>.</p>
            <p>A confirmation email has been sent to the email address you provided.</p>
			</div><!--mainbox-->
            
        </div><!--maincontent-->
        
		<div id="sidecontent">
        	<h2 class="flightbox">Flight summary</h2>
        	<div class="altbox flightbox">  
            
            <form id="summary" name="summary">
            	<input type="hidden" name="luggage" value="0">
                <input type="hidden" name="insurance" value="0">
                <input type="hidden" name="speedyboarding" value="0">
                <input type="hidden" name="carbon" value="0">
            </form>
            
            <div id="flightsummary">
                <div>
                	<span class="airport" id="airportdest">Airport 1</span> to 
                	<span class="airport" id="airportarr">Airport 2</span>
                </div>
                
            	<h5 class="il">Travellers:</h5>
                <span id="passengercount">1</span>
                
                <h5>Optional extras selected: </h5>
                <p><span id="luggagecount">8</span> bags</p>
                <p><span id="insurancecount">8</span> travel insurance policies</p>
                <p><span id="speedyboardingcount">8</span> speedy boarding passes</p>
                <p>Carbon emission offsetting for <span id="carboncount">8</span> people</p><br />
                
                <p>Flight price:</p> <span id="flightprice">£50</span>
                <p>Extras price:</p> <span id="extrasprice">£20</span>
                <p>Total price:</p> <span id="totalprice">£70</span>
            </div><!--flightsummary-->
            
            </div><!--altbox-->
            

            <!--<div class="advert">
            	<img src="images/ads/sidead1.jpg">
            </div>-->
            <!--advert-->
          
            
        </div><!--sidecontent-->
        

	</div><!--contall-->
            <div id="mainfooter">
        <p><a href="about.php">about us</a> | <a href="contact.php">contact us</a> | <a href="terms.php">terms and conditions</a></p>
        </div><!--mainfooter-->
</body>
</html>
