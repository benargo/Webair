<?php 
define('WebAirFW', true);
require("php/framework.php");

$session = returnSession();

if($_POST) {
	if($session['flight'] == 00000000) {
		$flight = prePopBooking();
	} else {
		$flight = $session['flight'];
	}	

	bookFlight($flight);

	header('location: confirm.php');
}
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | Booking | Payment</title>
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
                    
           <h2>Payment details</h2>
            <div class="mainbox">
                <form id="paymentform" method="post" action="payment.php">
                <span>Card name:</span>
               	<input type="text" name="cardname" />
                <span>Card number (no spaces):</span>
               	<input type="text" name="number" maxlength="16" />
                <span>Start date (MMYY): </span>
               	<input type="text" name="startdate" maxlength="4"/>
                <span>Expiry date (MMYY): </span>
               	<input type="text" name="expirydate" maxlength="4"/>
                <span>Issue number (Maestro/Solo only):</span>
               	<input type="text" name="issuenumber" maxlength="4"/>
                <span>Security code</span>
               	<input type="text" name="securitycode" maxlength="4" />
                <input type="submit" name="submitform" value="Pay" />               	
                </form>
			</div><!--mainbox-->
            
        </div><!--maincontent-->
        
		<div id="sidecontent">
        	<h2 class="flightbox">Flight summary</h2>
        	<div class="altbox flightbox">  
            
            <form id="summary" name="summary">
            	<input type="hidden" name="luggage" value="<?php echo($session['luggage']); ?>">
                <input type="hidden" name="insurance" value="<?php echo($session['insurance']); ?>">
                <input type="hidden" name="speedyboarding" value="<?php echo($session['priority']); ?>">
                <input type="hidden" name="carbon" value="<?php echo($session['carbon']); ?>">
            </form>
            
            <div id="flightsummary">
                <div>
                	<?php
                		$origin = substr($session['outRoute'], 0, 3);
                		$origin = returnAirport($origin);
                		$destination = substr($session['outRoute'], 3);
                		$destination = returnAirport($destination);
                		
                	?>
                	<span class="airport" id="airportdest"><?php echo($origin); ?></span> to 
                	<span class="airport" id="airportarr"><?php echo($destination); ?></span>
                </div>
                
            	<h5 class="il">Travellers:</h5>
                <span id="passengercount"><?php echo($session['passengers']); ?></span>
                
                <h5>Optional extras selected: </h5>
                <p><span id="luggagecount"><?php echo($session['luggage']); ?></span> bags</p>
                <p><span id="insurancecount"><?php echo($session['insurance']); ?></span> travel insurance policies</p>
                <p><span id="speedyboardingcount"><?php echo($session['priority']); ?></span> speedy boarding passes</p>
                <p>Carbon emission offsetting for <span id="carboncount"><?php echo($session['carbon']); ?></span> people</p><br />
                
                <p>Flight price:</p> <span id="flightprice"><?php echo(@getRoutePrice('out') + @getRoutePrice('ret')); ?></span>
                <p>Extras price:</p> <span id="extrasprice"><?php echo(getOptionsPrice()); ?></span>
                <p>Total price:</p> <span id="totalprice"><?php echo(@getRoutePrice('out') + @getRoutePrice('ret') + getOptionsPrice()); ?></span>
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
