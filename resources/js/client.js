import ApexCharts from 'apexcharts';
document.addEventListener('DOMContentLoaded', function() {
    // const options = {
    //     chart: {
    //         type: 'line',
    //         height:300,
    //     },
    //     series: [{
    //         name: 'Example Series',
    //         data: [10, 20, 30, 40, 50]
    //     }],
    //     xaxis: {
    //         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May']
    //     }
    // };

    // const chart_one = new ApexCharts(document.querySelector("#chart_client"), options);
    // chart_one.render();

    var seriesDataClient = chartDataClient.map(item => parseFloat(item.ganancia));
    var categoriesDataClient = chartDataClient.map(item => item.date);


    var options_client = {
      series: [{
      name: 'series1',
      data: seriesDataClient
    } 
    ],
      chart: {
      height: 350,
      type: 'area'
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth'
    },
    xaxis: {
      type: 'datetime',
      categories: categoriesDataClient
    },
    tooltip: {
      x: {
        format: 'dd/MM/yy HH:mm'
      },
    },
    };

    var chart_client = new ApexCharts(document.querySelector("#chart_client_test"), options_client);
    chart_client.render();

 
});
 