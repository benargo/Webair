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
 
	function updateOptionals($id, $amount) {
		$cookie = $_COOKIE['SessionID'];
		@mysql_query("UPDATE sessions SET ". $id ." = ". $amount ." WHERE `ID` = ". $cookie);
	}
	
	function getOptionalPrice($id) {
		$sql_query = mysql_query("SELECT * FROM 'optionals' WHERE `ID` = ". $id);
		$extra = mysql_fetch_array($sql_query);
		
		return $extra['Price'];
	}
?>