
    // Transformar JSON a datos para ApexCharts
    let initialData = [];
    let firstAmount = null; // Primer valor encontrado
    let lastRevenue = null; // Última rentabilidad encontrada

    // Procesar datos
    Object.keys(jsonData).forEach(month => {
        Object.keys(jsonData[month]).forEach(day => {
            jsonData[month][day].forEach((entry, index) => {
                if (firstAmount === null) firstAmount = entry.amount; // Guardar el primer valor
                lastRevenue = entry.revenue_percentage; // Actualizar la última rentabilidad

                // Generar formato para ApexCharts
                initialData.push({
                    x: new Date(2025, month - 1, day, index, 0).getTime(), // Fecha
                    y: entry.amount // Valor
                });
            });
        });
    });

    // Configuración del gráfico
    var options = {
        series: [{ data: initialData.slice(0, 1) }], // Iniciar con el primer dato
        chart: {
            id: 'realtime',
            height: 350,
            type: 'line',
            background: '#000000',
            animations: {
                enabled: true,
                easing: 'linear',
                dynamicAnimation: {
                    speed: 1000
                }
            },
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        dataLabels: { enabled: false },
        stroke: {
            curve: 'smooth',
            width: 2,
            colors: ['#00ff00']
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                type: 'vertical',
                opacityFrom: 0.5,
                opacityTo: 0,
                stops: [0, 100],
                colorStops: [
                    { offset: 0, color: '#00ff00', opacity: 0.3 },
                    { offset: 100, color: '#00ff00', opacity: 0 }
                ]
            }
        },
        grid: { show: false },
        markers: { size: 0 },
        xaxis: {
            type: 'datetime',
            labels: { style: { colors: '#ffffff' } }
        },
        yaxis: {
            labels: { style: { colors: '#ffffff' } }
        },
        legend: { show: false }
    };

    var chart = new ApexCharts(document.querySelector(".chart-area"), options);
    chart.render();

    // Mostrar valores iniciales
    document.querySelector(".transparency-value").textContent = `$${firstAmount.toLocaleString()}`;
    document.querySelector(".rentability-value").textContent = `${lastRevenue}%`;

    // Actualización dinámica cada 4 segundos
    let index = 0;
    var interval = window.setInterval(function () {
        index++;

        // Si el índice supera la cantidad de datos, reinicia al inicio del array
        if (index >= initialData.length) {
            clearInterval(interval); // Detener al finalizar los datos
        } else {
            // Actualiza la serie en el gráfico para mostrar datos hasta el índice actual
            chart.updateSeries([{ data: initialData.slice(0, index + 1) }]);
        }
    }, 4000);

