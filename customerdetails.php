<?php 
define('WebAirFW', true);
require("php/framework.php");

$session = returnSession();

if($session['customer'] == 00000000) {
	$customer = createCustomer();
} else {
	$customer = returnCustomer();
}

if($_POST) {
	
	print($customer['ID']);

	updateCustomer($customer['ID'], $_POST['surname'], $_POST['forename'], $_POST['address1'], $_POST['address2'], $_POST['address3'], $_POST['city'], $_POST['county'], $_POST['postcode'], $_POST['telephone'], $_POST['mobile'], $_POST['email'], $_POST['marketing']);	
	
	if($_POST['redirect'] == 'Proceed to Payment') {
		header('location: payment.php');
	} elseif($_POST['redirect'] == 'Edit Optional Extras') {
		header('location: optional.php');
	} else {
		header('location: payment.php');
	}
	
	
}
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | Booking | Confirm your customer details</title>
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
            
			<h2>Finalise your booking</h2>
            <div class="mainbox">
				<h3>Please confirm your details</h3>
                <p>You're almost done! All you need to do is enter the personal details of the person booking the flight, pay and you're good to go!</p>  
			</div><!--mainbox-->
           
           <h2>Customer details</h2>
            <div class="mainbox">
            	<?php if($customer != 'none') { ?>
            		
            	<form id="customerdetailsform" method="post" action="customerdetails.php">
                <span>Surname:</span>
               	<input type="text" name="surname" value="<?php echo($customer['surname']); ?>" />
                <span>Forename:</span>
               	<input type="text" name="forename" value="<?php echo($customer['forename']); ?>" />
                <span>Address (line 1):</span>
               	<input type="text" name="address1" value="<?php echo($customer['address1']); ?>" />
                <span>Address (line 2):</span>
               	<input type="text" name="address2" value="<?php echo($customer['address2']); ?>" />
                <span>Address (line 3):</span>
               	<input type="text" name="address3" value="<?php echo($customer['address3']); ?>" />
                <span>City:</span>
               	<input type="text" name="city" value="<?php echo($customer['city']); ?>" />
                <span>County:</span>
               	<input type="text" name="county" value="<?php echo($customer['county']); ?>" />
                <span>Postcode:</span>
               	<input type="text" name="postcode" value="<?php echo($customer['postcode']); ?>" maxlength="8" />
                <span>Telephone number:</span>
               	<input type="text" name="telephone" value="<?php echo($customer['telephone']); ?>" maxlength="11" />
                <span>Mobile number:</span>
               	<input type="text" name="mobile" value="<?php echo($customer['mobile']); ?>" maxlength="11" />
                <span>Email:</span>
               	<input type="text" name="email" value="<?php echo($customer['email']); ?>" />
                <span>Would you like to receive promotional material from time to time?</span> <input type="checkbox" name="marketing" checked="checked" class="check">
                <input type="submit" name="redirect" value="Proceed to Payment" />               	
                </form>
            		
            	<?php } else { ?>
            
                <form id="customerdetailsform" method="post" action="customerdetails.php">
                <span>Surname:</span>
               	<input type="text" name="surname" />
                <span>Forename:</span>
               	<input type="text" name="forename" />
                <span>Address (line 1):</span>
               	<input type="text" name="address1" />
                <span>Address (line 2):</span>
               	<input type="text" name="address2" />
                <span>Address (line 3):</span>
               	<input type="text" name="address3" />
                <span>City:</span>
               	<input type="text" name="city" />
                <span>County:</span>
               	<input type="text" name="county" />
                <span>Postcode:</span>
               	<input type="text" name="postcode" maxlength="8" />
                <span>Telephone number:</span>
               	<input type="text" name="telephone" maxlength="11" />
                <span>Mobile number:</span>
               	<input type="text" name="mobile" maxlength="11" />
                <span>Email:</span>
               	<input type="text" name="email" />
                <span>Would you like to receive promotional material from time to time?</span> <input type="checkbox" name="marketing" checked="checked" class="check">
                <input type="submit" name="redirect" value="Proceed to Payment" />               	
                </form>
                
                <?php } ?>
                
			</div><!--mainbox-->
            
        </div><!--maincontent-->
        
		<div id="sidecontent">
        	<h2 class="flightbox">Flight summary</h2>
        	<div class="altbox flightbox">  
            
            <form id="summary" name="summary" method="post" action="customerdetails.php">
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
                
                <p>Flight price:</p> <span id="flightprice"><?php echo(getRoutePrice('out') + @getRoutePrice('ret')); ?></span>
                <p>Extras price:</p> <span id="extrasprice"><?php echo(getOptionsPrice()); ?></span>
                <p>Total price:</p> <span id="totalprice"><?php echo(getRoutePrice('out') + @getRoutePrice('ret') + getOptionsPrice()); ?></span>
            </div><!--flightsummary-->
            <form id="summarycont" name="summarycont" action="customerdetails.php" method="post">
            	<input type="submit" name="redirect" value="Proceed to Payment">
            	<input type="submit" name="redirect" value="Edit Optional Extras" >
            </form>
            
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
