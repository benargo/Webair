var destinationBristol = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="destinationChange(this.value);" ><option></option><option value="DUB">Dublin</option><option value="GLA">Glasgow</option><option value="MAN">Manchester</option><option value="NCL">Newcastle</option></select></div>';
var destinationDublin = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="destinationChange(this.value);" ><option></option><option value="BRS">Bristol</option><option value="GLA">Glasgow</option></select></div>';
var destinationGlasgow = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="destinationChange(this.value);" ><option></option><option value="BRS">Bristol</option><option value="NCL">Newcastle</option></select></div>';
var destinationManchester = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="destinationChange(this.value);" ><option></option><option value="BRS">Bristol</option></select></div>';
var destinationNewcastle = '<div id="destination"><span>Flying to:</span><select class="destination" name="destination" onchange="destinationChange(this.value);" ><option></option><option value="BRS">Bristol</option><option value="MAN">Manchester</option></select></div>';
var outDate = '<div id="outdate"><span>Date:</span><input class="outdate date" type="text" name="outdate" value="" onchange="outDateChange(this.value);" /></div>';
var returnCheck = '<div id="returncheck"><input class="returncheck" type="checkbox" name="returncheck" value="" onchange="returnCheckChange(this.checked);" /><span>Return flight?</span></div>';
var returnDate = '<div id="returndate"><span>Return Date:</span><input class="returndate date" type="text" name="returndate" value="" onchange="returnDateChange(this.value);" /></div>';
var submit = '<div id="submit">Number of Passengers:<input type="text" name="passnums" /><br/><input class="submit" type="submit" name="submit" value="Book Flight" /></div>';

var returndisabled = false;

// $(".date").datepicker({dateFormat:"dd/mm/yy", firstDay: 1});

function originChange(origval) {
	
	$("#destination").remove();
	$("#outdate").remove();
	$("#returncheck").remove();
	$("#returndate").remove();
	$("#submit").remove();

switch (origval){
	case "BRS":
		$("#origin").after(destinationBristol);
		break;
	case "DUB":
		$("#origin").after(destinationDublin);
		break;
	case "GLA":
		$("#origin").after(destinationGlasgow);
		break;
	case "MAN":
		$("#origin").after(destinationManchester);
		break;
	case "NCL":
		$("#origin").after(destinationNewcastle);
		break;
}

//if (origval != "") {
//	if (origval != "BRS") {
//		$("#origin").after(destinationFixed);
//		$("#destination").after(outDate);
//		$(".date").datepicker({
//		  dateFormat:"dd/mm/yy", firstDay: 1,
//		  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
//		});
//	}
//	else {
//		$("#origin").after(destinationOptions);
//	}
//}
}

function destinationChange(destval) {

	$("#outdate").remove();
	$("#destination").after(outDate);	
	$(".date").datepicker({
	  dateFormat:"dd/mm/yy", firstDay: 1,
	  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
	});
}

function outDateChange(outdval) {
	$("#returncheck").remove();
	$("#outdate").after(returnCheck);
	$("#submit").remove();
	$("#returndate").remove();
	$("#returncheck").after(submit);
}

function returnCheckChange(checkval) {
	if (checkval) {
		$("#submit").attr("value","Book Flights");
		if (returndisabled) {
			$("input.returndate").removeAttr("disabled");
			returndisabled = false;
		}
		else {
			$("input.returndate").remove();
			$("#returncheck").after(returnDate);
			$(".date").datepicker({
			  dateFormat:"dd/mm/yy", firstDay: 1,
			  beforeShowDay: function(date){ return [date.getDay() != 0, ""]}
			});
		}
	}
	else {
		returndisabled = true;
		$("input.returndate").attr("disabled", "true");
		$("#submit").attr("value","Book Flight");
	}
}





