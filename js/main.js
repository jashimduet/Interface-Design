// console.log("Main.js file working");

// Get and read from the JSON file -> chartData
$file = "../chartData/readership_per_country.json";

// Get the files and Generate the the COUNTRYS ['DE' , 'DK' ... and so on]
// ALSO Generate the values of how many numbers of pageviews there has been
$.getJSON($file, function(json){
	var labels = json.map(function(entry){
		return entry.country
	});
	// console.log(labels);

	var dataPoints = json.map(function(entry){
		return entry.views;
	});
	//console.log(dataPoints);

	var lineCHART = document.getElementById("lineChart");
	// console.log(CHART);

	var lineChart = new Chart(lineCHART, {
		type: "line",
		data: {
			labels: labels,
			datasets: [
				{
					label: "Number of page views per country",
					data: dataPoints,
					backgroundColor: "rgba(46, 204, 113, 0.3)",
					fill: true,
					lineTension: 0,
					borderColor: "rgba(46, 204, 113, 1.0)",
					borderWidth: 1,
					pointBackgroundColor: "rgba(46, 204, 113, 1.0)",
					pointRadius: 2,
					pointHitRadius: 0
				}
			]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
});


// Bar chart of the readership_monthly in total
$file = "../chartData/readership_monthly_total.json";

$.getJSON($file, function(json){
	var monthlyLabels = json.map(function(entry){
		return entry.month
	});
	// console.log(monthlyLabels);

	var montlyDatapoints = json.map(function(entry){
		return entry.number_of_page_views
	});
	// console.log(montlyDatapoints);

	var barCHART = document.getElementById("barChart");
	// console.log(CHART);

	var barChart = new Chart(barCHART, {
		type: "bar",
		data: {
			labels: monthlyLabels,
			datasets: [
				{
					label: "Readership monthly in total",
					data: montlyDatapoints,
					backgroundColor: "rgba(241, 196, 15, 0.3)",
					fill: true,
					lineTension: 0,
					borderColor: "rgba(241, 196, 15, 1.0)",
					borderWidth: 1,
				}
			]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
});

// --------------------------------------- //

// Save as pdf

function genPDF() {
	html2canvas(document.getElementById("ShowLike"), {
		onrendered: function(canvas) {
			var img = canvas.toDataURL("image/JPEG");
			var doc = new jsPDF('1','pt','a4');
			doc.addImage(img, 'JPEG', 65,25);
			doc.save('Chart.pdf');
		}
	});
}
