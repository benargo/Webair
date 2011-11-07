<?php 
define('WebAirFW', true);
require("php/framework.php");

$session = returnSession();

if($_POST['update']) {
	updateOptionals('luggage', $_POST['luggage']);
	updateOptionals('insurance', $_POST['insurance']);
	updateOptionals('priority', $_POST['priority']);
	updateOptionals('carbon', $_POST['carbon']);
} elseif($_POST['continue']) {
	header('location: customerdetails.php');
}
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | Booking | Optional extras</title>
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
            
			<h2>Enhance your journey with WebAir</h2>
            <div class="mainbox">
				<h3>Do you want to choose any optional extras?</h3>
                <p>Enhance your journey with WebAir by choosing from a range of optional extras!</p>  
			</div><!--mainbox-->
            
            <h2>Add luggage</h2>
            <form action="optional.php" method="post">
            <input type="hidden" name="update" value="1" />
            <div class="mainbox">
            	<div class="price">
                <h4>£15</h4><h5>per bag</h5>
                </div>
                <div class="infoboxtext">
                <p>The default webAir fare includes one piece of carry-on hand luggage. If you require additional hold luggage you'll need to purchase it here. You can add a maximum of 8 bags per booking - any person in your party can share this limit.</p>
                
                <span>Add </span>
                <select class="amount" name="luggage">
               			<option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">2</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                    
                    <span>bags</span> <br /><input id="submitluggage" type="submit" name="submitluggage" value="Add bags" />
                
                </div><!--infoboxtext-->
			</div><!--mainbox-->    
            
            
            <h2>Add travel insurance</h2>
            <div class="mainbox">
            	<div class="price">
                <h4>£5</h4><h5>per person</h5>
                </div>
                <div class="infoboxtext">
                <p>Why risk it? Most European and world wide travel insurances don't cover travel within the UK. If you lose your luggage or personal belongings you're not covered. WebAir has partnered up with the insurance providers FatCatz Inc. to provide the best UK-wide travel insurance money can buy. </p>
                
                <p>Get peace of mind for only £5 per person per way!</p>
                                 
                	<span>Add </span>
                <select class="amount" name="insurance">
               			<option value="0" selected="selected">0x</option>
                        <option value="1">1x</option>
                        <option value="2">2x</option>
                        <option value="3">3x</option>
                        <option value="4">4x</option>
                        <option value="5">5x</option>
                        <option value="6">6x</option>
                        <option value="7">7x</option>
                        <option value="8">8x</option>
                    </select>
                    
                    <span> travel insurance policies</span> <br /><input id="submitinsurance" type="submit" name="submitinsurance" value="Add travel insurance" />
                
                </div><!--infoboxtext-->
			</div><!--mainbox-->   
            
            
        <h2>Add speedy boarding</h2>
            <div class="mainbox">
            	<div class="price">
                <h4>£7.50</h4><h5>per person</h5>
                </div>
                <div class="infoboxtext">
                <p>Be the first to board the flight! Ensure you get your favourite seat, beat the queues, and sit next to your travelling companions. We also have dedicated check-in desks for speedy boarding passengers at all our airports. Time is money, after all.</p>
               
                <span>Add </span>
                <select class="amount" name="priority">
               			<option value="0" selected="selected">0x</option>
                        <option value="1">1x</option>
                        <option value="2">2x</option>
                        <option value="3">2x</option>
                        <option value="4">4x</option>
                        <option value="5">5x</option>
                        <option value="6">6x</option>
                        <option value="7">7x</option>
                        <option value="8">8x</option>
                    </select>
                    
                    <span>speedy boarding passes</span> <br /><input id="submitspeedyboarding" type="submit" name="submitspeedybarding" value="Add speedy boardings" />
                
                </div><!--infoboxtext-->
			</div><!--mainbox-->  
           
           <h2>Add carbon offsetting</h2>
            <div class="mainbox">
            	<div class="price">
                <h4>£1</h4><h5>per person</h5>
                </div>
                <div class="infoboxtext">
                <p>Reduce the impact of the carbon emissions from your flights on the environment through UN certified emission reduction projects. This scheme has no middle men and WebAir doesn't make any profits from carbon emission offsetting.</p>
                
                <span>Offset carbon emissions for  </span>
                <select class="amount" name="carbon">
               			<option value="0" selected="selected">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">2</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                    
                    <span>people</span> <br /><input id="submitcarbon" type="submit" name="submitcarbon" value="Add carbon emission offsetting" />
                
                </div><!--infoboxtext-->
			</div><!--mainbox-->  
			</form>
            
        </div><!--maincontent-->
        
		<div id="sidecontent">
        	<h2 class="flightbox">Flight summary</h2>
        	<div class="altbox flightbox">  
            
            <form id="summary" name="summary" method="post" action="optional.php">
            	<input type="hidden" name="continue" value="1" />
            	<input type="hidden" name="luggage" value="<?php echo($session['luggage']); ?>">
                <input type="hidden" name="insurance" value="<?php echo($session['insurance']); ?>">
                <input type="hidden" name="speedyboarding" value="<?php echo($session['priority']); ?>">
                <input type="hidden" name="carbon" value="<?php echo($session['carbon']); ?>">

            
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
                <p><span id="luggagecount">8</span> bags</p>
                <p><span id="insurancecount">8</span> travel insurance policies</p>
                <p><span id="speedyboardingcount">8</span> speedy boarding passes</p>
                <p>Carbon emission offsetting for <span id="carboncount">8</span> people</p><br />
                
                <p>Flight price:</p> <span id="flightprice"><?php echo(@getRoutePrice('out') + @getRoutePrice('ret')); ?></span>
                <p>Extras price:</p> <span id="extrasprice"><?php echo(getOptionsPrice()); ?></span>
                <p>Total price:</p> <span id="totalprice"><?php echo(@getRoutePrice('out') + @getRoutePrice('ret') + getOptionsPrice()); ?></span>

            </div><!--flightsummary-->
            	<input type="submit" name="summarycontbtn" value="Continue booking" >
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
