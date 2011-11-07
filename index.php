<?php 
define('WebAirFW', true);
require("php/framework.php");

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
	
	header('location: customerdetails.php');
}
?>
<!DOCTYPE html>
<html class="nojs">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WebAir | home</title>
    <link type="text/css" href="styles/main.css" rel="stylesheet" />
    <link type="text/css" href="styles/nav.css" rel="stylesheet" />
	<link rel="stylesheet" href="styles/jqueryui.css" type="text/css" />
	
	<script src="js/jquery.lib.js" type="text/javascript"></script>
	<script src="js/jqueryui.lib.js" type="text/javascript"></script>
    <script type="text/javascript">
		$("html").removeClass("nojs");

    </script>
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
        <?php 
        $cookie = $_COOKIE['SessionID'];
        if(!isset($cookie)) { 
				printSessionExpiredNotice();
		} ?>
        <div id="maincontent">
        	<div class="advert">
				<img src="images/ads/ad1.jpg" alt="Should've flown WebAir..." />
            </div><!--advert-->
            
			<h2>Why, hello there you handsome devil.</h2>
            <div class="mainbox">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc urna mauris, tristique id tincidunt ac, laoreet sed tellus. Sed elementum ante risus, nec viverra neque. Donec tristique placerat eros, et aliquam magna cursus nec. Sed volutpat consectetur venenatis. Aliquam ut lorem sagittis orci aliquam condimentum. Phasellus vitae eleifend quam. Curabitur. </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sed ante et libero lobortis pellentesque at sed mauris. Cras ac augue quam, sit amet scelerisque nisi. Cras porttitor vehicula enim vel pellentesque. Donec turpis ipsum, facilisis in lacinia et, facilisis non nibh. Aenean eros leo, feugiat sed interdum in, ullamcorper. </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis, ante et venenatis scelerisque, diam nibh lousy porttitor lacus, non tincidunt massa elit quis dolor. Integer in erat molestie turpis bibendum porttitor. Phasellus nulla risus, auctor vitae pellentesque a, blandit id est. Maecenas adipiscing neque eget ipsum imperdiet in tempor ante. </p>
                    
			</div><!--mainbox-->
                
            
        </div><!--maincontent-->
        
		<div id="sidecontent">
        	<h2>Book a flight</h2>
        	<div class="altbox">
                <form id="speedbook" method="post" action="index.php">
                	<input type="hidden" name="speed" value="true"/>
                    <div id="origin">
                    <span>Flying from:</span>
                    <select class="origin" name="origin" onchange="originChange(this.value);">
                        <option value=""></option>
                        <option value="BRS">Bristol</option>
                        <option value="DUB">Dublin</option>
                        <option value="GLA">Glasgow</option>
                        <option value="MAN">Manchester</option>
                        <option value="NCL">Newcastle</option>
                    </select>
                    </div>
            
                </form>
                
				<form id="slowbook" method="post" action="index.php">
                    <div id="origin">
                    <span>Flying from:</span>
                    <select class="origin" name="origin" onchange="originChange(this.value);" <?php if($errorOrigin = true) { echo('class="error"'); } ?>>
                        <option></option>
                        <option value="BRS">Bristol</option>
                        <option value="DUB">Dublin</option>
                        <option value="GLA">Glasgow</option>
                        <option value="MAN">Manchester</option>
                        <option value="NCL">Newcastle</option>
                    </select>
                    </div>
                    <div id="destination"><span>Flying to:</span><select class="destination" name="destination"><option></option><option value="DUB">Dublin</option><option value="GLA">Glasgow</option><option value="MAN">Manchester</option><option value="NCL">Newcastle</option></select></div>
                    <div id="outdate"><span>Date (dd/mm/yyyy):</span><input class="outdate date" type="text" name="outdate" value="<?php echo($_POST['outdate']); ?>"/></div>
                    <div id="returncheck"><input class="returncheck" type="checkbox" name="returncheck" value="" /><span>Return flight?</span></div>
                    <div id="returndate"><span>Return Date:</span><input class="returndate date" type="text" name="returndate" value="<?php echo($_POST['returndate']); ?>" /></div>
                    <div id="numpassenger"><span>Number of passengers:</span>
                    <input type="text" name="passnums" value="<?php echo($passengers); ?>"/><br />
                    <span><a href="contact.php">Booking for a larger group? Contact us</a></span>
                    </div>
                    <input id="submit" type="submit" name="submit" value="Book Flight(s)" />
				</form>
            </div><!--altbox-->
            
            <h2>Amend your details</h2>
            <div class="altbox">
            	<form id="amendbooking" method="post" action="book.php">
                    <span>Booking number: </span>
                    <input type="text" name="bookingnumber" maxlength="8"/>
                    <span>Security code: </span>
                    <input type="text" name="securitycode" maxlength="8"/>
            		<input type="submit" value="Amend booking!" />
                    <span>Eventually, if you've created an account when you booked, you can <a href="login.php">log in here</a>.</span>
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
<?php ob_end_flush(); ?>