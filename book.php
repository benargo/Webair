<?php 
define('WebAirFW', true);
require("php/framework.php");

$session = returnSession();

// handle the speedbook
if($_POST) {

	// Variables
	$origin = mysql_real_escape_string($_POST['origin']);
	$destination = mysql_real_escape_string($_POST['destination']);

	$outdate = substr(mysql_real_escape_string($_POST['outdate']), 6, 4) .'-'. substr(mysql_real_escape_string($_POST['outdate']), 3, 2) .'-'. substr(mysql_real_escape_string($_POST['outdate']), 0, 2);
	$returndate = substr(mysql_real_escape_string($_POST['returndate']), 6, 4) .'-'. substr(mysql_real_escape_string($_POST['returndate']), 3, 2) .'-'. substr(mysql_real_escape_string($_POST['returndate']), 0, 2);
	
	$passengers = mysql_real_escape_string($_POST['passnums']);
	
	// Update the session
	
	updateField('outDate', $outdate);
	
	if(isset($_POST['returncheck'])) {
		updateField('retDate', $returndate);
	}
	
	// Second handle the number of passengers
	updateField('passengers', $passengers);
	
	if(mysql_real_escape_string($_POST['origin']) == 'MAN' && mysql_real_escape_string($_POST['desination']) == 'BRS') {
		header('location: choose.php?o='. $outbound['Origin'] .'&d='. $outbound['Destination']);
	}
	
	// Calculate the routes
	$outbound = returnAvailable($origin, $destination);
	updateField('outRoute', $outbound['ID']);
	
	if(isset($_POST['returncheck'])) {
		$return = returnAvailable($destination, $origin);
		updateField('retRoute', $return['ID']);
	}
	
	header('location: optional.php');
}
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | Create booking</title>
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
	<script src="js/jquery.validate.js" type="text/javascript"></script>
	<script type="text/javascript">$("#slowbook").validate();</script>
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
            
			<h2>Our locations</h2>
            <div class="mainbox">
				<img id="mapimg" src="images/map/none.jpg" />                    
			</div><!--mainbox-->
                
            
        </div><!--maincontent-->
        
		<div id="sidecontent">
        	<h2>Book a flight</h2>
        	<div class="altbox">               
				<form id="slowbook" method="post" action="book.php">
                    <div id="origin">
                    <span>Flying from:</span>
                    <select class="origin required" name="origin" onchange="originChange(this.value);">
                        <option></option>
                        <?php if(substr($session['outRoute'], 0, 3) == 'BRS') {
                        	echo('<option value="BRS" selected="selected">Bristol</option>');
                        } ?>
                        <option value="BRS">Bristol</option>
                        <?php if(substr($session['outRoute'], 0, 3) == 'DUB') {
                        	echo('<option value="DUB" selected="selected">Dublin</option>');
                        } else { ?>
                        <option value="DUB">Dublin</option>
                        <?php }
                        if(substr($session['outRoute'], 0, 3) == 'GLA') {
                        	echo('<option value="GLA" selected="selected">Glasgow</option>');
                        } else { ?>
                        <option value="GLA">Glasgow</option>
                        <?php } 
                        if(substr($session['outRoute'], 0, 3) == 'MAN') {
                        	echo('<option value="MAN" selected="selected">Manchester</option>');
                        } else { ?>
                        <option value="MAN">Manchester</option>
                        <?php } 
                        if(substr($session['outRoute'], 0, 3) == 'NCL') {
                        	echo('<option value="NCL" selected="selected">Newcastle</option>');
                        } else { ?>
                        <option value="NCL">Newcastle</option>
                        <?php } ?>
                    </select>
                    </div>
                    <div id="destination"><span>Flying to:</span><select class="destination required" name="destination">
                    <option></option>
                        <?php if(substr($session['retRoute'], 0, 3) == 'BRS') {
                        	echo('<option value="BRS" selected="selected">Bristol</option>');
                        } ?>
                        <option value="BRS">Bristol</option>
                        <?php if(substr($session['retRoute'], 0, 3) == 'DUB') {
                        	echo('<option value="DUB" selected="selected">Dublin</option>');
                        } else { ?>
                        <option value="DUB">Dublin</option>
                        <?php }
                        if(substr($session['retRoute'], 0, 3) == 'GLA') {
                        	echo('<option value="GLA" selected="selected">Glasgow</option>');
                        } else { ?>
                        <option value="GLA">Glasgow</option>
                        <?php } 
                        if(substr($session['retRoute'], 0, 3) == 'MAN') {
                        	echo('<option value="MAN" selected="selected">Manchester</option>');
                        } else { ?>
                        <option value="MAN">Manchester</option>
                        <?php } 
                        if(substr($session['retRoute'], 0, 3) == 'NCL') {
                        	echo('<option value="NCL" selected="selected">Newcastle</option>');
                        } else { ?>
                        <option value="NCL">Newcastle</option>
                        <?php } ?>
                    </select>
                    <div id="outdate"><span>Date (dd/mm/yyyy):</span><input class="outdate date required" type="text" name="outdate" value="<?php echo($session['outDate']); ?>"/></div>
                    <div id="returncheck"><input class="returncheck" type="checkbox" name="returncheck" value="" <?php if(isset($session['retRoute'])) { echo('checked="checked"'); } ?> /><span>Return flight?</span></div>
                    <div id="returndate"><span>Return Date:</span><input class="returndate date" type="text" name="returndate" value="<?php echo($session['retDate']); ?>" /></div>
                    <div id="numpassenger"><span>Number of passengers:</span>
                    <input class="required" type="text" name="passnums" value="<?php echo($session['passengers']); ?>"/><br />
                    <span><a href="contact.php">Booking for a larger group? Contact us</a></span>
                    </div>
                    
                    <input id="submit" type="submit" name="submit" value="Book Flight(s)" />
				</form>
            </div><!--altbox-->
            

            <div class="advert">
            	<img src="images/ads/sidead1.jpg">
            </div><!--advert-->
            
        </div><!--sidecontent-->
        

	</div><!--contall-->
            <div id="mainfooter">
        <p><a href="about.php">about us</a> | <a href="contact.php">contact us</a> | <a href="terms.php">terms and conditions</a></p>
        </div><!--mainfooter-->
</body>
</html>
