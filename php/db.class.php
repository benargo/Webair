<?php
/* WebAir Framework
 * @author Ben Argo
 * @website http://www.benargo.com
 * @created 22 January 2011
 * @version 1.1
 * @updated 11 February 2011
 * **/
 
// Check to see if we've been called properly
defined('WebAirFW') or die('Restricted Access');

	function db_connect()
	{
		mysql_connect('flywebair.db.7818863.hostedresource.com', 'flywebair', 'Webb1.0#db'); // host, username, password
		mysql_select_db('flywebair'); // database name	
		
	}