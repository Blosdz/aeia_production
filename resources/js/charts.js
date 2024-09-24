import ApexCharts from 'apexcharts';

document.addEventListener("DOMContentLoaded", function() {
    //   historial suscriptor
 

    // suscriptor
    // var data_porcentaje_sus = [porcentajeInvitados,100-porcentajeInvitados];
    // var data_porcentaje_sus = [80,100-80];

    // var porcentaje_subs = {
    //     series: data_porcentaje_sus,
    //     chart: {
    //         type: 'donut',
    //     },
    //     labels: ['Porcentaje Invitados', 'Total Users'],
    //     responsive: [{
    //         breakpoint: 480,
    //     }]   
    // };

    // var chart_porcentaje_Subs = new ApexCharts(document.querySelector("#porcentaje_subs"), porcentaje_subs);
    // chart_porcentaje_Subs.render();
    // console.log(data_porcentaje_sus);

    // var seriesDataSus = chartDataSus.map(function(data) {
    //     return {
    //         x: new Date(data.date),
    //         y: data.total_collected
    //     };
    // });
    // // console.log(chartDataSus);
    // var options_sus = {
    //     chart: {
    //         height: 350,
    //         type: 'area'
    //     },
    //     dataLabels: {
    //         enabled: false
    //     },
    //     series: [{
    //         name: "Total Recogido",
    //         data: seriesDataSus
    //     }],
    //     xaxis: {
    //         type: 'datetime'
    //     },
    //     tooltip: {
    //         x: {
    //             format: 'dd/MM/yy HH:mm'
    //         }
    //     },
    //     stroke: {
    //         curve: 'smooth'
    //     },
    //     colors: ['#00E396'] // Puedes ajustar el color aquí
    // };

    // var chart_sus = new ApexCharts(document.querySelector("#chart-sus"), options_sus);
    // chart_sus.render();

    // end suscriptor

    //  start client 
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



    // console.log(donaSeries); // Verifica que los datos se están pasando correctamente
    // var content_dona=donaSeries;
    var porcentaje_cliente ={
        series:donaSeries,
        chart:{
            type:'donut',
            width: 500,
            height: 500,
        },
        responsive:[{
            breakpoint:undefined,
            options:{},
        }],
        labels:['porcentaje de fondo','fondo total'],
    };
    var chartDona = new ApexCharts(document.querySelector('#chart-dona'),porcentaje_cliente);
    chartDona.render();

    var seriesData = [];
    var months = [];
    var monthNames = ["1 Enero", "2 Febrero", "3 Marzo", "4 Abril", "5 Mayo", "6 Junio", "7 Julio", "8 Agosto", "9 Septiembre", "10 Octubre", "11 Noviembre", "12 Diciembre"];
    Object.keys(planData).forEach(function(plan) {
        var planInfo = planData[plan];
        seriesData.push({
            name: plan.charAt(0).toUpperCase() + plan.slice(1), // Capitalizar el nombre del plan
            type: 'area',
            data: planInfo.data.map(Number) // Asegurarse de que los datos son números
        });

        if (months.length === 0) {
            months = planInfo.months.map(function(monthNumber) {
                return monthNames[monthNumber - 1]; // Convertir el número del mes a su nombre correspondiente
            });
        }

        // Crear gráficos individuales para cada plan
        var individualOptions = {
            series: [{
                name: plan.charAt(0).toUpperCase() + plan.slice(1),
                data: planInfo.data.map(Number)
            }],
            chart: {
                height: 350,
                width:600,
                type: 'area'
            },
            responsive:[{
                breakpoint:undefined,
                options:{},
            }],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: months
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var individualChart = new ApexCharts(document.querySelector("#chart_" + plan), individualOptions);
        individualChart.render();
    });

    // Crear el gráfico combinado
    var combinedOptions = {
        series: seriesData,
        chart: {
            height: 350,
            width: 600, 
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        responsive:[{
            breakpoint:undefined,
            options:{},
        }],
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            categories: months
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
        colors: ['#cd7f32', '#c0c0c0'] // Colores para los planes Bronce y Plata
    };

    var combinedChart = new ApexCharts(document.querySelector("#chart"), combinedOptions);
    combinedChart.render();
}); 