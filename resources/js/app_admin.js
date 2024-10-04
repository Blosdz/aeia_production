import ApexCharts from 'apexcharts';
import { first } from 'lodash';

document.addEventListener('DOMContentLoaded', function () {
    // Obtener la primera ID de los fondos disponibles
    let firstFondoId = Object.keys(fondosChartData)[0];

    // let chartOptions = {
    //     series: [{
    //         data: fondosChartData[firstFondoId] // Usar la data desde el controlador Blade
    //     }],
    //     chart: {
    //         type: 'line',
    //         height: 250
    //     },
    //     title: {
    //         text: 'Historial de Fondo',
    //         align: 'left'
    //     },
    //     xaxis: {
    //         type: 'datetime' // Para manejar fechas correctamente
    //     },
    //     yaxis: {
    //         tooltip: {
    //             enabled: true
    //         }
    //     },

    //     stroke: {
    //         width: 1, // Controla el grosor de las velas
    //     },
        
    // };
    var chartOptions = {
        series: [
            {
                data: fondosChartData[firstFondoId]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#77B6EA', '#545454'],
        dataLabels: {
            enabled: true,
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            align: 'left'
        },
        grid: {
            borderColor: '#e7e7e7',
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        markers: {
            size: 1
        },
        xaxis: {
            type: 'datetime', // Mover a esta ubicación
            title: {
                text: 'Fecha',
            },
            labels: {
                // Configurar cómo se mostrarán las fechas en las etiquetas
                datetimeFormatter: {
                    month: 'MM',
                    day: 'dd',
                },
                formatter: function(value, timestamp) {
                    return new Date(timestamp).toLocaleDateString('en-US', {
                        month: 'short',   // Muestra "Jan", "Feb", etc.
                        day: 'numeric',   // Muestra el día del mes
                    });
                }
            }
        },
        yaxis: {
            tooltip: { enabled: true }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
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
})    