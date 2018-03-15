var bar_chart = $("#bar-chart");
var myBarChart = new Chart(bar_chart, {
	type: 'horizontalBar',
  data: {
    labels: [],
    datasets: [
    	{
	      label: "% Avance",
	      backgroundColor: "rgba(0, 112, 153, 1)",
	      borderColor: "rgba(0, 112, 153, 1)",
	      data: [],
    	},
    	{
	      label: "% Restante",
	      backgroundColor: "rgba(213, 213, 213, 1)",
	      borderColor: "rgba(213, 213, 213, 1)",
	      data: [],
    	}
    ],
  },
  options: {
  	responsive: true,
		maintainAspectRatio: true,
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
        	beginAtZero: true,
          maxTicksLimit: 15,
          callback: function(val) {
          	val = Math.round(val*100);
          	return val+" %";
          }
        },
        scaleLabel: {
        	display: true
        },
        stacked: true,
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 15000,
          maxTicksLimit: 15
        },
        gridLines: {
          display: true
        },
        stacked: true,
      }],
    },
	  tooltips: {
	  	enabled: true,
	  	callbacks: {
	  		label: function( tooltipItem, data ) {
	  			var val_per = (tooltipItem.xLabel*100).toFixed(2);
	  			var label = tooltipItem.datasetIndex;
	  			if( tooltipItem.datasetIndex==0 ) label="% Avance";
	  			else label="% Restante";
	  			return label+" "+val_per+" %";
	  		}
	  	}
	  },
    legend: {
      display: true,
      position: "bottom",
    }
  }
});

var line_chart = $("#linear-chart");
var myLineChart = new Chart(line_chart, {
	type: 'line',
	data: {
		labels: [],
		datasets: [
				{
				label: "Total diario",
				lineTension: 0,
				backgroundColor: "rgba(2,117,216,0)",
				borderColor: "rgba(0, 112, 153, 1)",
				pointRadius: 5,
				pointBackgroundColor: "rgba(0, 112, 153, 1)",
				pointBorderColor: "rgba(255,255,255,0.8)",
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "rgba(0, 112, 153, 1)",
				pointHitRadius: 20,
				pointBorderWidth: 2,
				data: [],
			},
				{
				label: "Promedio",
				lineTension: 0,
				backgroundColor: "rgba(250,119,25,0)",
				borderColor: "rgba(213, 213, 213, 1)",
				pointRadius: 0,
				pointBackgroundColor: "rgba(213, 213, 213, 1)",
				pointBorderColor: "rgba(255,255,255,0.8)",
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "rgba(213, 213, 213, 1)",
				pointHitRadius: 20,
				pointBorderWidth: 2,
				data: [],
			},
		]
	},
	options: {
		scales: {
			xAxes: [{
				time: {
					unit: 'date'
				},
				gridLines: {
					display: false
				},
				ticks: {
					maxTicksLimit: 7
				}
			}],
			yAxes: [{
				ticks: {
					min: 0,
					max: 0,
					maxTicksLimit: 5
				},
				gridLines: {
					color: "rgba(0, 0, 0, .125)",
				}
			}],
		},
		legend: {
			display: true,
			position: "bottom",
		}
	}
});

var pie_chart = $("#pie-chart");
var myCircleChart = new Chart(pie_chart, {
  type: 'pie',
  data: {
    labels: ["Avance","restante"],
    datasets: [{
      data: [],
      backgroundColor: ["rgba(0, 112, 153, 1)", "rgba(213, 213, 213, 1)"],
    }],
  },
	options: {
		legend: {
			display: true,
			position: "bottom",
		}
	},
});