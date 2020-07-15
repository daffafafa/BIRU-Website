/*
 * charts/chart_filled_blue.js
 *
 * Demo JavaScript used on charts-page for "Filled Chart (Blue)".
 */

"use strict";

$(document).ready(function(){

	// Sample Data1
	var d1 = [
	[1262304000000, 750],
	[1264982400000, 1000], 
	[1267401600000, 1250], 
	[1270080000000, 1500], 
	[1272672000000, 1750], 
	[1275350400000, 2000], 
	[1277942400000, 2250], 
	[1280620800000, 2500], 
	[1283299200000, 2750], 
	[1285891200000, 3000], 
	[1288569600000, 3250], 
	[1291161600000, 3500]
	];

	// Sample Data2
	var d2 = [
	[1262304000000, 750],
	[1264982400000, 750], 
	[1267401600000, 750], 
	[1270080000000, 750], 
	[1272672000000, 750], 
	[1275350400000, 750], 
	[1277942400000, 750], 
	[1280620800000, 750], 
	[1283299200000, 750], 
	[1285891200000, 750], 
	[1288569600000, 750], 
	[1291161600000, 750]
	];

	var data1 = [
		{ label: "Realized", data: d1, color: App.getLayoutColorCode('red') },
		{ label: "Target", data: d2, color: App.getLayoutColorCode('blue') }
	];

	$.plot("#chart_filled_yellow", data1, $.extend(true, {}, Plugins.getFlotDefaults(), {
		xaxis: {
			min: (new Date(2009, 12, 1)).getTime(),
			max: (new Date(2010, 11, 2)).getTime(),
			mode: "time",
			tickSize: [1, "month"],
			monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			tickLength: 0
		},
		series: {
			lines: {
				fill: true,
				lineWidth: 1.5
			},
			points: {
				show: true,
				radius: 2.5,
				lineWidth: 1.1
			},
			grow: { active: true, growings:[ { stepMode: "maximum" } ] }
		},
		grid: {
			hoverable: true,
			clickable: true
		},
		tooltip: true,
		tooltipOpts: {
			content: '%s: %y'
		}
	}));

});