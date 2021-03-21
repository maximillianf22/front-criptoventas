//
// Bars chart
//

var BarsChart = (function() {

	//
	// Variables
	//

	var $chart = $('#chart-bars2');


	//
	// Methods
	//

	// Init chart
	function initChart($chart) {

		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			data: {
				labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
				datasets: [{
					label: 'Calidad del Aire',
					data: [40, 42, 45, 47, 0, 0, 0, 0, 0, 0, 0, 0],
					backgroundColor: [
				'#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89',
                '#2dce89'
            ],
				}]
			}
		});

		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}


	// Init chart
	if ($chart.length) {
		initChart($chart);
	}

})();


//
// Bars chart
//

var BarsChart = (function() {

	//
	// Variables
	//

	var $chart = $('#chart-bars3');


	//
	// Methods
	//

	// Init chart
	function initChart($chart) {

		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
				datasets: [{
					label: '(PM2.5)',
					data: [1012, 1012, 1017, 1019, 1022, 1027, 1032, 1035, 1039, 1042, 1044, 1047, 1048, 1049, 1045, 1042, 1045, 1051, 1051, 1051, 1052, 1051, 1051, 1051],
					backgroundColor: [
				'#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#F2700B',
                '#E30C0C',
                '#E30C0C',
                '#E30C0C',
                '#E30C0C',
                '#E30C0C',
                '#E30C0C',
                '#E30C0C'
            ],
				}]
			}
		});

		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}


	// Init chart
	if ($chart.length) {
		initChart($chart);
	}

})();


//
// Bars chart
//

var BarsChart = (function() {

	//
	// Variables
	//

	var $chart = $('#chart-bars4');


	//
	// Methods
	//

	// Init chart
	function initChart($chart) {

		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
				datasets: [{
					label: '(PPM - CO)',
					data: [25, 24, 28, 27, 26, 28, 29, 23, 24, 26, 30, 31, 33, 34, 30, 25, 27, 29, 28, 24, 22, 21, 20, 25],
					backgroundColor: [
				'#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#006885',
                '#006885',
                '#006885',
                '#006885',
                '#006885',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4',
                '#0B9BC4'
            ],
				}]
			}
		});

		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}


	// Init chart
	if ($chart.length) {
		initChart($chart);
	}

})();



//
// Bars chart
//

var BarsChart = (function() {

	//
	// Variables
	//

	var $chart = $('#chart-bars5');


	//
	// Methods
	//

	// Init chart
	function initChart($chart) {

		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
				datasets: [{
					label: '(PPB - NO2)',
					data: [205, 204, 208, 210, 211, 211, 212, 209, 204, 206, 200, 201, 203, 204, 207, 205, 209, 211, 210, 204, 202, 201, 200, 205],
					backgroundColor: [
				'#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#A39506',
                '#A39506',
                '#A39506',
                '#A39506',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#A39506',
                '#A39506',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03',
                '#F4FF03'
            ],
				}]
			}
		});

		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}


	// Init chart
	if ($chart.length) {
		initChart($chart);
	}

})();



//
// Bars chart
//

var BarsChart = (function() {

	//
	// Variables
	//

	var $chart = $('#chart-bars6');


	//
	// Methods
	//

	// Init chart
	function initChart($chart) {

		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			data: {
				labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
				datasets: [{
					label: '(PPB - SO₂)',
					data: [130, 132, 134, 132, 135, 138, 140, 135, 145, 142, 150, 151, 152, 153, 151, 150, 140, 142, 145, 146, 150, 151, 148, 140],
					backgroundColor: [
				'#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#03940F',
                '#03940F',
                '#03940F',
                '#03940F',
                '#03940F',
                '#03940F',
                '#00F015',
                '#00F015',
                '#00F015',
                '#00F015',
                '#03940F',
                '#03940F',
                '#00F015',
                '#00F015'
            ],
				}]
			}
		});

		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}


	// Init chart
	if ($chart.length) {
		initChart($chart);
	}

})();



