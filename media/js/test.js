/************************************************************************
 Product    : Home information
 Date       : 2013-04-19
 Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : Den Kjeholtska licensmodellen
 ---------------------------------------------------------
 File       : media/js/test.js
 Version    : 0.6.1
 Author     : Bjorn Kjeholt
 *************************************************************************/

function test() {
	
}

function showDiffTime(sampleTime,divId) {
//	document.getElementById("mod_homeinfo_sensor_data_time").innerHTML = "Testing";

	var aaa = document.getElementById(divId);
	var d = new Date();
	var timeString = new String();
	var functionName = new String("showDiffTime");

	if (aaa != null) {
		var currTime = new Number(d.getTime()/1000);
			
		var diffTime = new Number();
		diffTime = currTime.toFixed(0) - sampleTime;
		aaa.innerHTML = diffTime;
	
		var resultString = new String("");
		if (diffTime < 300) {
			aaa.innerHTML = resultString.concat("(",diffTime, " sekunder gammal)");
		} else {
			var diffTimeMinutes = new Number();
			diffTimeMinutes = diffTime/60;
			aaa.innerHTML = resultString.concat("(",diffTimeMinutes.toFixed(0), " minuter gammal)");
		}
	
		timeString = functionName.concat("(", sampleTime, ")");

		setTimeout(timeString,1000);
	} 
}
