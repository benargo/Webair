<?php 
define('WebAirFW', true);
require("php/framework.php");

$routes = returnAvailable($_GET['o'], $_GET['d']);
?>

<!-- Start HTML -->

<form action="choose.php" method="post">
	<?php 
		$i = 0;
		foreach($routes as $route) { ?>
	<input type="radio" name="choice" value="<?php echo($route[$i]['ID']); ?>" />
	<?php 
		$i++;
	} ?>
</form>