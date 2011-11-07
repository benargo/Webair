var destinationBristol = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="mapCheck();" ><option></option><option value="DUB">Dublin</option><option value="GLA">Glasgow</option><option value="MAN">Manchester</option><option value="NCL">Newcastle</option></select></div>';
var destinationDublin = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="mapCheck();" ><option></option><option value="BRS">Bristol</option><option value="GLA">Glasgow</option></select></div>';
var destinationGlasgow = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="mapCheck();" ><option></option><option value="BRS">Bristol</option><option value="NCL">Newcastle</option></select></div>';
var destinationManchester = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="mapCheck();" ><option></option><option value="BRS">Bristol</option></select></div>';
var destinationNewcastle = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="mapCheck();" ><option></option><option value="BRS">Bristol</option><option value="MAN">Manchester</option></select></div>';

$(document).load(function(){
$(".date").datepicker({
  dateFormat:"dd/mm/yy", firstDay: 1,
  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
});
});

function originChange(origval) {
	
	$("#destination").remove();
	
switch (origval){
	case "BRS":
		$("#origin").after(destinationBristol);
		$(".date").datepicker({
		  dateFormat:"dd/mm/yy", firstDay: 1,
		  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
		});
		break;
	case "DUB":
		$("#origin").after(destinationDublin);
		$(".date").datepicker({
		  dateFormat:"dd/mm/yy", firstDay: 1,
		  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
		});
		break;
	case "GLA":
		$("#origin").after(destinationGlasgow);
		$(".date").datepicker({
		  dateFormat:"dd/mm/yy", firstDay: 1,
		  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
		});
		break;
	case "MAN":
		$("#origin").after(destinationManchester);
		$(".date").datepicker({
		  dateFormat:"dd/mm/yy", firstDay: 1,
		  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
		});
		break;
	case "NCL":
		$("#origin").after(destinationNewcastle);
		$(".date").datepicker({
		  dateFormat:"dd/mm/yy", firstDay: 1,
		  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
		});
		break;
}

	mapCheck();
}

function mapCheck() {
	var originval = $("#origin select").val();
	var destinval = $("#destination select").val();
	var bothval = originval + destinval;
	bothval = bothval.toLowerCase();
	var valid = false;
	
	switch (bothval){
		case "brsdub": case "brsgla": case "brsman": case "brsncl": case "dubgla": case "glabrs": case "glancl": case "manbrs": case "nclbrs": case "nclman":
		valid = true;
		break;
		default:
		valid = false;
		break;
	}
	
	if (valid) {
		$("#mapimg").attr("src", "images/map/" + bothval + ".jpg");
	}
	else {
		$("#mapimg").attr("src", "images/map/none.jpg");
	}	
}
