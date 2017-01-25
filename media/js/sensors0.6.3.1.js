/************************************************************************
 Product    : Home information
 Date       : 2013-05-22
 Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : Den Kjeholtska licensmodellen
 ---------------------------------------------------------
 File       : media/js/sensors.js
 Version    : 0.6.3.1
 Author     : Bjorn Kjeholt
 *************************************************************************/

function addSensor(divId) {
	
}


function createSensorInfoTable(divId) {
	
}

/**
 * 
 * @param divId String
 * @param serverUrlPath String
 * @return void
 */
function getSensorList(divId,serverUrlPath) {
	var xmlDivIdPtr = document.getElementById(divId);

	/*
	 * Clear the sub-document
	 */
//	var xmlChildNodes = xmlDivPtr.childNodes;
	
//	for (xmlNode in xmlChildNodes) {
//		xmlDivPtr.removeChild(xmlNode);
//	}
	
	
	xmlDivIdPtr.innerHTML = 'Updating in progress'; 
	
	/*
	 * Get a request object
	 */
	if (window.XMLHttpRequest) {
		XMLHttpRequestObject = new XMLHttpRequest();
	} else if (window.ActiveXObject){
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	if (XMLHttpRequestObject) {
		var url = serverUrlPath;

		XMLHttpRequestObject.open("POST", url, true);
		XMLHttpRequestObject.setRequestHeader('Content-Type','text/xml');
		XMLHttpRequestObject.overrideMimeType("text/xml");
		
		XMLHttpRequestObject.onreadystatechange = function() {
			if (XMLHttpRequestObject.readyState == 4 &&
				XMLHttpRequestObject.status == 200) {
				var xmlResponse = XMLHttpRequestObject.responseXML;
				
				if (xmlResponse) {
					var sensorList = xmlResponse.getElementsByTagName('sensor');
					var sensorNumber = new Number();
					
					if (sensorList.length >= 0) {
						/*
						 * the list contains at least one entry, therefore add a table header
						 */
						var tableFields = {
								id	: 'Id',
								name : 'Sensor name',
								type : 'Sensor type' };
						
						var table = document.createElement('table');
						var	thead = document.createElement('thead');
						var	theadTr = document.createElement('tr');
						
						for (tableField in tableFields) {
							var	theadTrTh = document.createElement('th');
							theadTrTh.innerHTML = tableFields[tableField];
							theadTr.appendChild(theadTrTh);
						}
						thead.appendChild(theadTr);

						var tbody = document.createElement('tbody');
						
						for (sensorNumber = 0; sensorNumber < sensorList.length; sensorNumber = sensorNumber+1) {
							/*
							 * Use the received information from the server to populate the table
							 */
							
							var tr = document.createElement('tr');
							for (field in tableFields) {
								var td = document.createElement('td');
								td.innerHTML = sensorList[sensorNumber].getAttribute(field);
								tr.appendChild(td);
							}
							tbody.appendChild(tr);
						}
						
						table.appendChild(thead);
						table.appendChild(tbody);
						xmlDivIdPtr.appendChild(table);
						xmlDivIdPtr.innerHTML = ''; 
					}
				}
			}
		};
		
		XMLHttpRequestObject.send(null);		
	}
}	

