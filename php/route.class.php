<?php
/* WebAir Framework
 * @author Ben Argo
 * @website http://www.benargo.com
 * @created 22 January 2011
 * @version 1.1
 * @updated 09 February 2011
 * **/

// Check to see if we've been called properly
defined('WebAirFW') or die('Restricted Access');

	/* ** <TABLE OF CONTENTS> **
	 * 1. Return Routes
	 * 2. Adds Flights to the Session Record
	 * 3. Update number of Available Seats
	 * 4. Update Flights Table
	 * ** </TABLE OF CONTENTS> **/
	 
	/* <Function ROUTE.1>
	 * @name:    Select Route
	 * @purpose: Returns the selected route from the database
	 * @created: 11 February 2011
	 * @in:      Origin, Destination
	 * @out:     Route ID Number
	 * **/
	function returnAvailable($origin, $destination)
	{
		// Query the database to see if there are available routes
		$sql_query = mysql_query("SELECT * FROM routes WHERE Origin = '". $origin ."' AND Destination = '". $destination ."'");
		
		// If there are (there should be, but even so, better to be safe!)
		if($sql_query) // Yes there was a route
		{
			// Add the record to an array
			$routes = mysql_fetch_array($sql_query);
			
			return $routes;
			
		}
		else // No route exists
		{
			return false;
		}
	} // </Function ROUTE.1>
	
	function returnAirport($airport) {
		$sql_query = mysql_query("SELECT * FROM airports WHERE `ID` = '". $airport ."' LIMIT 0, 1");
		$route = mysql_fetch_array($sql_query);
		
		return $route['Name'];

	}
	
	function getRoutePrice($type) {
		$cookie = $_COOKIE['SessionID'];
		
		// Start by querying the database to get our particular session
		$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie) or die(mysql_error()); 
		$session = mysql_fetch_array($sql_query);
		
		$input = $session[$type .'Route'];
		
		$sql_query = mysql_query("SELECT * FROM routes WHERE `ID` = '". $input ."'") or die(mysql_error()); 
		$route = mysql_fetch_array($sql_query);
		
		$price = $route['Price'] * $session['passengers'];
		
		return $price;
	}
	
	function getOptionsPrice() {
		$cookie = $_COOKIE['SessionID'];
		
		// Start by querying the database to get our particular session
		$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie); 
		$session = mysql_fetch_array($sql_query);
		
		$luggage = $session['luggage'] * 15;
		$insurance = $session['insurance'] * 5;
		$priority = $session['priority'] * 7;
		$carbon = $session['carbon'];
		
		$price = $luggage + $insurance + $priority + $carbon;
		
		return $price;
	}
	
?>