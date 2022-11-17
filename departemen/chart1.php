<!DOCTYPE HTML>
<html>
<head>  
<script type="text/javascript">
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	title:{
		text: "Data Mahasiswa Informatika UDNIP"
	},
	axisY: {
		title: "Mahasiswa",
		includeZero: true
	},
	legend: {
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	toolTip: {
		shared: true,
		content: toolTipFormatter
	},
	data: [{
		type: "bar",
		showInLegend: true,
		name: "Aktif",
		color: "rgb(51, 222, 91",
		dataPoints: [
			{ y: 0, label: "2018" },
			{ y: 1, label: "2019" },
			{ y: 1, label: "2020" },
			{ y: 1, label: "2021" },
			{ y: 1, label: "2022" }
		]
	},
	{
		type: "bar",
		showInLegend: true,
		name: "Tidak Aktif",
		color: "rgb(245, 78, 66)",
		dataPoints: [
			{ y: 0, label: "2018" },
			{ y: 0, label: "2019" },
			{ y: 0, label: "2020" },
			{ y: 0, label: "2021" },
			{ y: 0, label: "2022" }
		]
	}]
});
chart.render();

function toolTipFormatter(e) {
	var str = "";
	var total = 0 ;
	var str3;
	var str2 ;
	for (var i = 0; i < e.entries.length; i++){
		var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		total = e.entries[i].dataPoint.y + total;
		str = str.concat(str1);
	}
	str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
	str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
	return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer1" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>