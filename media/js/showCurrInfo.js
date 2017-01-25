/************************************************************************
 Product    : Home information
 Date       : 2013-05-21
 Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : Den Kjeholtska licensmodellen
 ---------------------------------------------------------
 File       : media/js/showCurrInfo.js
 Version    : 0.6.2
 Author     : Bjorn Kjeholt
 *************************************************************************/

var updatePeriod = new Number(60000); // Update the sensorValue every minute
var timeForNextUpdate = new Number(0);

var updatedTime = 0; // Time in milliseconds

function updateCurrValue(sensorId, valueDivId, timeDivId,serverUrlPath) {
	/*
	 * Get current time in milliseconds
	 */
	var d = new Date();
	var currTime = new Number(d.getTime());

	var currValueDocument = document.getElementById(valueDivId);
	var currTimeDocument  = document.getElementById(timeDivId);


	if (currTime > timeForNextUpdate) {
		/*
		 * Time to update the sensor value from the server
		 */
		
		timeForNextUpdate = currTime + updatePeriod; // Calculate next time for update
		
		/*
		 * Get the latest value from the server
		 */

		currTimeDocument.innerHTML = '(Updating in progress)'; // State that the info is updating instead of time to next update
		
		if (window.XMLHttpRequest) {
			XMLHttpRequestObject = new XMLHttpRequest();
		} else if (window.ActiveXObject){
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		if (XMLHttpRequestObject) {
			var url = serverUrlPath + "&sensor_id=" + sensorId;

			XMLHttpRequestObject.open("GET", url, true);
			XMLHttpRequestObject.setRequestHeader('Content-Type','text/xml');
			XMLHttpRequestObject.overrideMimeType("text/xml");
			
			XMLHttpRequestObject.onreadystatechange = function() {
				if (XMLHttpRequestObject.readyState == 4 &&
					XMLHttpRequestObject.status == 200) {
					
					/*
					 * A response has been received from the server
					 * XML response from the server:
					 * <?xml version="1.0"?>
					 * <msg><sample sensorid="xx" time="xxxxxx">xxx.x</sample></msg>
					 */
/*					
					var serverResponseText = XMLHttpRequestObject.responseText;
					
					var parser = new DOMParser();
					var xmlDocument = parser.parseFromString(serverResponseText, "application/xml");
*/					
					var xmlDocument = XMLHttpRequestObject.responseXML;
				
					if (xmlDocument) {
						var samples = xmlDocument.getElementsByTagName("sample");

						if (samples.length > 0) {
//							currValueDocument.innerHTML = samples[0].innerHTML;
							currValueDocument.innerHTML = samples[0].textContent;
						}
					
					}
					
					/*
					 * 
					 */
					var timeLeftInSeconds = new Number();
					
					timeLeftInSeconds = (timeForNextUpdate - currTime)/1000;
					
					currTimeDocument.innerHTML = "(Next update in " + timeLeftInSeconds.toFixed(0) + " seconds)";

				}
			};
		
			XMLHttpRequestObject.send(null);
		}
		
	} else {
		/*
		 * 
		 */
		
		var timeLeftInSeconds = new Number();
		
		timeLeftInSeconds = (timeForNextUpdate - currTime)/1000;
		
		currTimeDocument.innerHTML = "(Next update in " + timeLeftInSeconds.toFixed(0) + " seconds)";
	}

	/*
	 * 
	 */
	
	var funcString = "updateCurrValue(\"" + sensorId + "\", \"" + valueDivId + "\", \"" + timeDivId + "\", \"" + serverUrlPath + "\")";

	setTimeout(funcString,1000);
}
