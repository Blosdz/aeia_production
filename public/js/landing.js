// Función para generar datos diarios desde el 1 de noviembre hasta el 14 de noviembre con tendencia al alza
function generateDailyData() {
  const data = [];
  const startDate = new Date(new Date().getFullYear(), 10, 1); // 1 de noviembre
  const endDate = new Date(new Date().getFullYear(), 10, 14); // 14 de noviembre
  let currentDate = startDate;
  let lastValue = 100000; // Valor inicial de $100,000

  while (currentDate <= endDate) {
    // Generar un valor con un 80% de probabilidad de aumento
    const randomFactor = Math.random();
    if (randomFactor < 0.8) {
      lastValue += Math.floor(Math.random() * 1000); // Aumento entre 0 y 1000
    } else {
      lastValue -= Math.floor(Math.random() * 500); // Disminución entre 0 y 500
    }

    // Garantiza que el último valor esté por encima de $100,000
    if (currentDate.getTime() === endDate.getTime() && lastValue < 100000) {
      lastValue = 100000 + Math.floor(Math.random() * 1000); // Ajusta para mantener la tendencia
    }

    data.push([currentDate.getTime(), lastValue]);
    currentDate.setDate(currentDate.getDate() + 1); // Avanza al siguiente día
  }
  return data;
}

const initialData = generateDailyData();
let data = [...initialData]; // Copia para los datos que se mostrarán en el gráfico

var options = {
  series: [{
    data: data.slice()
  }],
  chart: {
    id: 'realtime',
    height: 350,
    type: 'line',
    background: '#000000', // Fondo negro
    animations: {
      enabled: true,
      easing: 'linear',
      dynamicAnimation: {
        speed: 1000
      }
    },
    toolbar: {
      show: false
    },
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
    width: 2,
    colors: ['#00ff00'] // Línea de color verde
  },
  fill: {
    type: 'gradient',
    gradient: {
      shade: 'dark',
      type: 'vertical',
      shadeIntensity: 0.5,
      opacityFrom: 0.5,
      opacityTo: 0,
      stops: [0, 100],
      colorStops: [
        {
          offset: 0,
          color: '#00ff00',
          opacity: 0.3
        },
        {
          offset: 100,
          color: '#00ff00',
          opacity: 0
        }
      ]
    }
  },
  grid: {
    show: false
  },
  markers: {
    size: 0
  },
  xaxis: {
    type: 'datetime',
    labels: {
      style: {
        colors: '#ffffff' // Color de las etiquetas en el eje x
      }
    }
  },
  yaxis: {
    labels: {
      style: {
        colors: '#ffffff' // Color de las etiquetas en el eje y
      }
    }
  },
  legend: {
    show: false
  }
};

var chart = new ApexCharts(document.querySelector(".chart-area"), options);
chart.render();

// Actualización dinámica cada segundo en bucle
let index = 0;
var interval = window.setInterval(function () {
  index++;

  // Si el índice supera la cantidad de datos, reinicia al inicio del array
  if (index >= initialData.length) {
    index = 0;
    data = [...initialData];
  }

  // Actualiza la serie en el gráfico para mostrar datos hasta el índice actual
  chart.updateSeries([{
    data: data.slice(0, index + 1)
  }]);
}, 4000);
