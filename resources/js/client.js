import ApexCharts from 'apexcharts';
document.addEventListener('DOMContentLoaded', function() {
  function renderChartsForYear(year) {
    // Obtener los datos correspondientes al año seleccionado
    var yearData = anualData[year] || {};

    // Limpiar los contenedores de gráficos existentes
    document.querySelector("#graph-" + year).innerHTML = "";
    document.querySelector("#graph-individual-" + year).innerHTML = "";

    // Datos para el gráfico combinado
    var seriesData = [];
    var months = [];
    var monthNames = ["1 Enero", "2 Febrero", "3 Marzo", "4 Abril", "5 Mayo", "6 Junio", "7 Julio", "8 Agosto", "9 Septiembre", "10 Octubre", "11 Noviembre", "12 Diciembre"];

    Object.keys(yearData).forEach(function(plan) {
        var planInfo = yearData[plan];
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
                type: 'area'
            },
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

        var individualChart = new ApexCharts(document.querySelector("#graph-individual-" + year), individualOptions);
        individualChart.render();
    });

    // Crear el gráfico combinado
    var combinedOptions = {
        series: seriesData,
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
            categories: months
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
        colors: ['#cd7f32', '#c0c0c0'] // Colores para los planes Bronce y Plata
    };

    var combinedChart = new ApexCharts(document.querySelector("#graph-" + year), combinedOptions);
    combinedChart.render();
}

// Renderizar gráficos para el primer año al cargar la página
var firstYear = Object.keys(anualData)[0];
if (firstYear) {
    renderChartsForYear(firstYear);
}

// Escuchar cambios en los tabs
document.querySelectorAll('a[data-toggle="tab"]').forEach(function(tab) {
    tab.addEventListener('shown.bs.tab', function(event) {
        var year = event.target.getAttribute('aria-controls');
        renderChartsForYear(year);
    });
});
 
});
 