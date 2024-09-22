import ApexCharts from 'apexcharts';

document.addEventListener('DOMContentLoaded', function () {
    // Obtener la primera ID de los fondos disponibles
    let firstFondoId = Object.keys(fondosChartData)[0];

    let chartOptions = {
        series: [{
            data: fondosChartData[firstFondoId] // Usar la data desde el controlador Blade
        }],
        chart: {
            type: 'candlestick',
            height: 250
        },
        title: {
            text: 'Historial de Fondo',
            align: 'left'
        },
        xaxis: {
            type: 'datetime' // Para manejar fechas correctamente
        },
        yaxis: {
            tooltip: {
                enabled: true
            }
        },
        plotOptions: {
            candlestick: {
                colors: {
                    upward: '#00B746',  // Verde para subidas
                    downward: '#EF403C' // Rojo para bajadas
                },
                wick: {
                    useFillColor: true  // Las mechas tendrán el mismo color que el cuerpo de la vela
                }
            }
        },
        stroke: {
            width: 1, // Controla el grosor de las velas
        },
        tooltip: {
            shared: true,
            custom: function({ series, seriesIndex, dataPointIndex, w }) {
                var o = w.globals.seriesCandleO[seriesIndex][dataPointIndex],
                    h = w.globals.seriesCandleH[seriesIndex][dataPointIndex],
                    l = w.globals.seriesCandleL[seriesIndex][dataPointIndex],
                    c = w.globals.seriesCandleC[seriesIndex][dataPointIndex];
                return (
                    '<div class="apexcharts-tooltip-candlestick">' +
                    '<span>Open: <b>' + o + '</b></span><br/>' +
                    '<span>High: <b>' + h + '</b></span><br/>' +
                    '<span>Low: <b>' + l + '</b></span><br/>' +
                    '<span>Close: <b>' + c + '</b></span>' +
                    '</div>'
                );
            }
        }
    };

    let chart = new ApexCharts(document.querySelector("#fondoChart"), chartOptions);
    chart.render();

    // Función para actualizar el gráfico cuando se selecciona un fondo
    window.showFondoData = function (fondoId) {
        let data = fondosChartData[fondoId];
        chart.updateSeries([{
            data: data
        }]);

        // Actualizar también la información adicional del fondo
        let selectedFondo = fondos.find(f => f.id == fondoId);
        document.getElementById('fondoName').textContent = selectedFondo.name;
        document.getElementById('fondoDate').textContent = new Date(selectedFondo.created_at).toLocaleDateString();
        document.getElementById('fondoComisiones').textContent = selectedFondo.total_comisiones;
    };
});
