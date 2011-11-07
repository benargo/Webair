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

function returnSession() {
	$cookie = $_COOKIE['SessionID'];

	// Query the database to get the session
	$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie);
		
	return mysql_fetch_array($sql_query);
}
 
function checkExistingSession()
{
	$cookie = $_COOKIE["SessionID"];
	
	if(isset($cookie)) {
	
		// Check to see if it matches something in the database
		$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie);
		
		if($sql_query) // There is something there!
		{
			// Add the query to an array
			$session_array = mysql_fetch_array($sql_query);
			
			// Check to see if it's expired.
			if(checkExpired() == true) // It hasn't expired
			{
				// Update the expired timer
				updateExpired();
			}
			else // It has expired
			{
				destroySession();
			}
		}
		else
		{
			createSession();
		}
	}
	else {
		createSession();
	}	
} // </Function SESSION.1>



function createSession()
{
	// Sets expiration timer for 1800 seconds (30 minutes)
	$expires = time() + 1800;
	
	mysql_query("INSERT INTO sessions (Created, Expires) VALUES (". time() .", ". $expires .")");
	
	// Get the session ID that was just generated
	$sessionID = mysql_insert_id();
	
	// Set the session ID to a cookie that expires in 1 year (See note cookie_durations.txt)
	setcookie('SessionID', $sessionID, time() + (365 * 24 * 60 * 60), '/', 'www.flywebair.com');
	
} // </Function SESSION.2>



function checkExpired()
{
	$cookie = $_COOKIE['SessionID'];

	// Query the database to get the session
	$sql_query = mysql_query("SELECT * FROM sessions WHERE `ID` = ". $cookie);
	
	$session_array = mysql_fetch_array($sql_query);
	 
	// If the current time is greater than or equal to the expiration time on the database (i.e. it has expired)
	if(time() >= $session_array['Expires'])
	{
		return false; // Yes it has expired, return false
	}
	else // It hasn't expired
	{
		return true;  // It hasn't expired, return true
	}
	
} // </Function SESSION.3>

/* <Function SESSION.4>
 * @name:	 Update Expired Timer
 * @purpose: Update the session so the timer is increased.
 * @created: 11 February 2011
 * @in:      Session ID
 * @out:     Updated session
 * **/
function updateExpired()
{
	$session = $_COOKIE['SessionID'];
	
	// Calcualte what the new timer will be
	$newtime = time() + 1800;
	
	// Update the session field in the database
	mysql_query("UPDATE sessions SET Expires = ". $newtime ." WHERE `ID` = ". $session);
	
} // </Function SESSION.4>

/* <Function SESSION.5>
 * @name:	 Update Expired Timer
 * @purpose: Update the session so the timer is increased.
 * @created: 11 February 2011
 * @in:      Session ID
 * @out:     Updated session
 * **/
function updateField($field, $value)
{
	$cookie = $_COOKIE['SessionID'];
	// Update the session field in the database
	mysql_query("UPDATE sessions SET ". $field ." = '". $value ."' WHERE `ID` = ". $cookie);
	
} // </Function SESSION.5>

/* <Function SESSION.6>
 * @name:	 Destroy session
 * @purpose: Destroy the selected session
 * @created: 11 February 2011
 * @in:      Session ID
 * @out:     Delete session
 * **/
function destroySession()
{
	$cookie = $_COOKIE['SessionID'];
	// Set the session's active state to 0
	mysql_query("UPDATE sessions SET `Active` = 0 WHERE `ID` = ". $cookie);
	
	// Destroy the cookie
	destroyCookie();
	
} // </Function SESSION.6>

/* <Function SESSION.7>
 * @name:	 Destroy Cookie
 * @purpose: Destroy the cookie which was associated with a now expired session.
 * @created: 10 February 2011
 * @in:      NULL;	
 * @out:     A new cookie that has no value and expires after 5 seconds.
 * **/
function destroyCookie()
{
	// Destroy the cookie
	setcookie('SessionID', 0, time() + 1); // This basically sets it's value to 0, and makes it expire in 5 seconds from now.
	
	printSessionExpiredNotice();
		
} // </Function SESSION.7>

function printSessionExpiredNotice() {
	echo('<div class="error"><p>Sorry! The session has expired. Please start the <a href="book">booking process again.</a></p></div>');
	
	createSession();	
}
?>