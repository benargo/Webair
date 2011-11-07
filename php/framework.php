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
 
ob_start();

error_reporting(E_ALL ^ E_NOTICE);

// 1. Database
require(dirname(__FILE__) .'/db.class.php');

// 2. Sessions
require(dirname(__FILE__) .'/session.class.php');

// 3. Flights & Routes
require(dirname(__FILE__) .'/route.class.php');

// 4. Optional Extras
require(dirname(__FILE__) .'/optionals.class.php');

// 5. Booking System
require(dirname(__FILE__) .'/book.class.php');

// 6. Logins
require(dirname(__FILE__) .'/login.class.php');

// 7. Customers
require(dirname(__FILE__) .'/customer.class.php');

db_connect();
checkExistingSession();
?>