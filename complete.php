<!DOCTYPE html>
<html>
<head>

	<title>Webb</title>
	
	<link rel="stylesheet" href="styles/forms.css" type="text/css" />
	<link rel="stylesheet" href="styles/jqueryui.css" type="text/css" />

</head>
<body>
<div id="contain">
	<form id="speedbook" method="post" action="#">
		<div id="origin">
		<span>Flying from:</span>
		<select class="origin" name="origin" onchange="originChange(this.value);">
			<option></option>
			<option value="BRS">Bristol</option>
			<option value="DUB">Dublin</option>
			<option value="GLA">Glasgow</option>
			<option value="MAN">Manchester</option>
			<option value="NCL">Newcastle</option>
		</select>
		</div>
		<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="destinationChange(this.value);" ><option></option><option value="DUB">Dublin</option><option value="GLA">Glasgow</option><option value="MAN">Manchester</option><option value="NCL">Newcastle</option></select></div>
		<div id="outdate"><span>Date:</span><input class="outdate date" type="text" name="outdate" value="" onchange="outDateChange(this.value);" /></div>
		<div id="returncheck"><input class="returncheck" type="checkbox" name="returncheck" value="" onchange="returnCheckChange(this.checked);" /><span>Return flight?</span></div>
		<div id="returndate"><span>Return Date:</span><input class="returndate date" type="text" name="returndate" value="" onchange="returnDateChange(this.value);" /></div>
		<input id="submit" type="submit" name="submit" value="Book Flight" />
	</form>
	</div>


	<script type="text/javascript">
	
		$(".date").datepicker({dateFormat:"dd/mm/yy"});
		
	
	
	</script>


</body>
</html>