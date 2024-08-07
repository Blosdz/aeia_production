import ApexCharts from 'apexcharts';

document.addEventListener("DOMContentLoaded", function() {
    //   historial suscriptor
 

    // suscriptor
    var data_porcentaje_sus = [porcentajeInvitados,100-porcentajeInvitados];
    // var data_porcentaje_sus = [80,100-80];

    var porcentaje_subs = {
        series: data_porcentaje_sus,
        chart: {
            type: 'donut',
        },
        labels: ['Porcentaje Invitados', 'Total Users'],
        responsive: [{
            breakpoint: 480,
        }]   
    };

    var chart_porcentaje_Subs = new ApexCharts(document.querySelector("#porcentaje_subs"), porcentaje_subs);
    chart_porcentaje_Subs.render();
    console.log(data_porcentaje_sus);

    var seriesDataSus = chartDataSus.map(function(data) {
        return {
            x: new Date(data.date),
            y: data.total_collected
        };
    });
    // console.log(chartDataSus);
    var options_sus = {
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            name: "Total Recogido",
            data: seriesDataSus
        }],
        xaxis: {
            type: 'datetime'
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            }
        },
        stroke: {
            curve: 'smooth'
        },
        colors: ['#00E396'] // Puedes ajustar el color aquí
    };

    var chart_sus = new ApexCharts(document.querySelector("#chart-sus"), options_sus);
    chart_sus.render();
    var optionsDemo = {
        chart: {
            height: 280,
            type: "area"
        },
        dataLabels: {
            enabled: false
        },
        series: [
            {
                name: "Plan Bronce",
                data: [45, 52, 38, 45, 19, 43, 40]
            },
            {
                name: "Plan Plata",
                data: [50, 40, 35, 50, 70, 130, 200]
            },
            {
                name: "Plan Oro",
                data: [80, 30, 50, 30, 80, 100, 120]
            }
        ],
        colors: ['#cd7f32', '#c0c0c0', '#ffd700'], // Colores para los planes Bronce, Plata y Oro
        // fill: {
        //     opacity: 1 // Opacidad completa para colores sólidos
        // },
        xaxis: {
            categories: [
                "01 Jan",
                "02 Jan",
                "03 Jan",
                "04 Jan",
                "05 Jan",
                "06 Jan",
                "07 Jan"
            ]
        }
    };
    
    var chartDemo = new ApexCharts(document.querySelector("#chart-demo"), optionsDemo);
    
    chartDemo.render();
    
    var optionsDonaDemo = {
        series: [20, 15, 30, 35], // Porcentajes de los planes en el gráfico de dona
        chart: {
            type: 'donut',
        },
        labels: ['Plan Bronce', 'Plan Plata', 'Plan Oro', 'Otros'], // Etiquetas para el gráfico de dona
        responsive: [{
            breakpoint: 480,
        }]
    };

    var chartDonaDemo = new ApexCharts(document.querySelector("#chart-demo-dona"), optionsDonaDemo);
    chartDonaDemo.render();
});