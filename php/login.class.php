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
 

	function login($type, $username, $password) {
		// If logging in with booking no.
		if($type == 'booking') {
		
			$username = mysql_real_escape_string($username);
			
			$sql_query = mysql_query("SELECT * FROM bookings WHERE `ID` = $username");
			$booking = mysql_fetch_array($sql_query);
			
			if($booking['security'] == $password) {
				$_SESSION['login'] = true;
				return true;
			}
			else {
				return false;
			}
		}
		elseif($type == 'customer') {
			
			$sql_query = mysql_query("SELECT * FROM 'customers' WHERE email = $username LIMIT 0, 1");
			$customer = mysql_fetch_array($sql_query);
			
			if($customer['password'] == md5($password)) {
				$_SESSION['login'] = true;
				return true;
			}
			else {
				return false;
			}
		}
		else {
			die("PHP Error in login.class.php, function login");
		}
	}
	
	function logout() {
		$_SESSION['login'] = false;
		header('location: index.php?msg=loggedout');
	}
	
	function https() {
		if(!$_SERVER['HTTPS']) {
			header('location: https://isa.cems.uwe.ac.uk'. $_SERVER['REQUEST_URI']);
		}
	}