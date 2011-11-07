<?php
/* WebAir Framework
 * @author Ben Argo
 * @website http://www.benargo.com
 * @created 22 January 2011
 * @version 1.1
 * @updated 28 March 2011
 * **/
 
// Check to see if we've been called properly
defined('WebAirFW') or die('Restricted Access');

	function getFlight($id) {
		$sql_query = mysql_query("SELECT * FROM bookings WHERE `ID` = ". $id);
		
		return mysql_fetch_array($sql_query);
	}

	function setNumberOfPassengers($input) {
		$cookie = $_COOKIE['SessionID'];
		
		mysql_query("UPDATES 'sessions' SET passengers = ". $input ." WHERE `ID` = ". $cookie);
	}
	
	function getNumberOfPassengers() {
		$cookie = $_COOKIE['SessionID'];
		
		$sql_query = mysql_query("SELECT * FROM 'sessions' WHERE `ID` = ". $cookie ." LIMIT 0, 1"); 
		$session = mysql_fetch_array($sql_query);
		
		return $session['passengers'];
	}
	
	function generateSecurityCode() {
		return substr(md5(uniqid(time())), 0, 8);
	}
	
	function prePopBooking() {
		$cookie = $_COOKIE['SessionID'];
			
		$security_code = substr(generateSecurityCode(), 0, 8);
		
		mysql_query("INSERT INTO bookings (`security`) VALUES ('". $security_code ."')") or die(1 . mysql_error());
		
		$id = mysql_insert_id();
		
		mysql_query("UPDATE sessions SET flight = ". $id ." WHERE `ID` = ". $cookie) or die(2 . mysql_error());
		
		return $id;
	}

	function bookFlight($flight) {
		$cookie = $_COOKIE['SessionID'];
		$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie); 
		$session = mysql_fetch_array($sql_query);
		
		mysql_query("UPDATE bookings SET customer = ". $session['customer'] .", outRoute = '". $session['outRoute'] ."', retRoute = '". $session['retRoute'] ."', outDate = '". $session['outDate'] ."', retDate = '". $session['retDate'] ."', passengers = ". $session['passengers'] .", insurance = ". $session['insurance'] .", carbon = ". $session['carbon'] .", luggage = ". $session['luggage'] .", priority = ". $session['priority'] .", status = 1 WHERE `ID` = ". $flight) or die(3 . mysql_error());
		
		$flightid = getFlight($flight);
		$customer = returnCustomer();
		
		$body = <<<END
Thank you for choosing to fly with Web Air!
		
Your booking number is: {$flight} and your individual security code is {$flightid['security']}. Please look after this email carefully, you will need it to amend your booking online and when you check in at the airport.
		
Yours sincerely,
Web Air
END;
		
		$headers = 'From: noreply@flywebair.com';

		mail($customer['email'], "Thank you for booking", $body, $headers) or die('problem sending email');
	}