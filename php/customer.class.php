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

	function createCustomer() {
		mysql_query("INSERT INTO customers (surname) VALUES (NULL)") or die(mysql_error());
		
		$customer = mysql_insert_id();
		
		updateField('customer', $customer);
		
		return $customer;
	}
	
	function returnCustomer() {
		$cookie = $_COOKIE['SessionID'];
		
		$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie);
		$session = mysql_fetch_array($sql_query);
		
		$sql_query = mysql_query("SELECT * FROM customers WHERE `ID` = ". $session['customer']);
		$customer = mysql_fetch_array($sql_query);
		
		return $customer;
	}

	function updateCustomer($customer, $surname, $forename, $address1, $address2, $address3, $city, $county, $postcode, $telephone, $mobile, $email, $marketing) {
	
		if($marketing == 'on') {
			$marketing = 1;
		} else {
			$marketing = 0;
		}
	
		$surname = mysql_real_escape_string($surname);
		$forename = mysql_real_escape_string($forename);
		$address1 = mysql_real_escape_string($address1);
		$address2 = mysql_real_escape_string($address2);
		$address3 = mysql_real_escape_string($address3);
		$city = mysql_real_escape_string($city);
		$county = mysql_real_escape_string($county);
		$postcode = mysql_real_escape_string($postcode);
		$telephone = mysql_real_escape_string($telephone);
		$mobile = mysql_real_escape_string($mobile);
		$email = mysql_real_escape_string($email);
	
		$newpostcode = checkPostcode($postcode);
	
		mysql_query("UPDATE customers SET surname = '$surname', forename = '$forename', address1 = '$address1', address2 = '$address2', address3 = '$address3', city = '$city', county = '$county', postcode = '$newpostcode', telephone = $telephone, mobile = $mobile, email = '$email', marketing = $marketing WHERE `ID` = $customer") or die(mysql_error());
		
		updateField('customer', $customer);
	}
	
	function checkPostcode($postcode) {
		return str_replace(' ', '', $postcode);
	}