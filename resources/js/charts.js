import ApexCharts from 'apexcharts';

document.addEventListener("DOMContentLoaded", function() {
      
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

    console.log(planData); // Verificar los datos en charts.js
    console.log("thisdonadata".donaData);

    var seriesData = [];
    var months = [];

    Object.keys(planData).forEach(function(plan) {
        var planInfo = planData[plan];
        seriesData.push({
            name: plan,
            type: 'area',
            data: planInfo.data
        });

        if (months.length === 0) {
            months = planInfo.months;
        }
    });

    function getChartOptions(theme) {
        return {
            series: seriesData,
            chart: {
                height: 400,
                width: '100%',
                type: 'area',
                foreColor: theme === 'dark' ? '#fff' : '#000'
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: 0.3
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                tickPlacement:'between',
                categories: months,
                labels: {
                    style: {
                        colors: theme === 'dark' ? '#fff' : '#000'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Ganancia',
                },
                labels: {
                    formatter: function (value) {
                        return value.toFixed(2); // Formato con dos decimales para las etiquetas del eje Y
                    },
                    style: {
                        colors: theme === 'dark' ? '#fff' : '#000'
                    }
                }
            },
        };
    }

    var currentTheme = localStorage.getItem("theme") || "light";
    var chart = new ApexCharts(document.querySelector("#chart"), getChartOptions(currentTheme));
    chart.render();

    var options_dona = {
        series: donaSeries,
        chart: {
            width: 380,
            type: 'donut',
            foreColor: currentTheme === 'dark' ? '#fff' : '#000'
        },
        labels: ['Inversión del Cliente', 'Resto del Fondo'],
        dataLabels: {
            enabled: false
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    show: false
                }
            }
        }],
        legend: {
            position: 'right',
            offsetY: 0,
            height: 230,
            labels: {
                colors: currentTheme === 'dark' ? '#fff' : '#000'
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            fontSize: '44px',
                            color: currentTheme === 'dark' ? '#fff' : '#000'
                        },
                        value: {
                            fontSize: '44px',
                            color: currentTheme === 'dark' ? '#fff' : '#000',
                            formatter: function (val) {
                                return val.toFixed(2) + "%";
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            color: currentTheme === 'dark' ? '#fff' : '#000',
                            formatter: function (w) {
                                // Mostrar 100% como el total
                                return "100%";
                            }
                        }
                    }
                }
            }
        }
    };
    var chart_dona = new ApexCharts(document.querySelector("#chart_dona"), options_dona);
    chart_dona.render();

    Object.keys(planData).forEach(function(plan) {
        var planInfo = planData[plan];

        var planOptions = {
            series: [{
                name: plan,
                type: 'area',
                data: planInfo.data
            }],
            chart: {
                height: 400,
                width: '100%',
                type: 'area',
                stacked: false,
                toolbar: {
                    show: false
                },
                foreColor: currentTheme === 'dark' ? '#fff' : '#000'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: [1],
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: 0.3
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(2) + " units"; // Formato con dos decimales
                        }
                        return y;
                    }
                }
            },
            xaxis: {
                tickPlacement: 'between',
                categories: planInfo.months,
                labels: {
                    style: {
                        colors: currentTheme === 'dark' ? '#fff' : '#000'
                    }
                }
            },
            yaxis: {
                title: {
                    text: 'Ganancia',
                },
                labels: {
                    formatter: function (value) {
                        return value.toFixed(2); // Formato con dos decimales para las etiquetas del eje Y
                    },
                    style: {
                        colors: currentTheme === 'dark' ? '#fff' : '#000'
                    }
                }
            },

        };
        var planChart = new ApexCharts(document.querySelector("#chart_" + plan), planOptions);
        planChart.render();
    });

    window.addEventListener('themeChanged', function() {
        var newTheme = localStorage.getItem("theme") || "light";
        chart.updateOptions(getChartOptions(newTheme));
        chart_dona.updateOptions({
            chart: {
                foreColor: newTheme === 'dark' ? '#fff' : '#000'
            },
            legend: {
                labels: {
                    colors: newTheme === 'dark' ? '#fff' : '#000'
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            name: {
                                color: newTheme === 'dark' ? '#fff' : '#000'
                            },
                            value: {
                                color: newTheme === 'dark' ? '#fff' : '#000'
                            },
                            total: {
                                color: newTheme === 'dark' ? '#fff' : '#000'
                            }
                        }
                    }
                }
            }
        });

        Object.keys(planData).forEach(function(plan) {
            var planInfo = planData[plan];
            var planOptions = {
                chart: {
                    foreColor: newTheme === 'dark' ? '#fff' : '#000'
                },
                xaxis: {
                    labels: {
                        style: {
                            colors: newTheme === 'dark' ? '#fff' : '#000'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: newTheme === 'dark' ? '#fff' : '#000'
                        }
                    }
                }
            };
            var planChart = new ApexCharts(document.querySelector("#chart_" + plan), planOptions);
            planChart.updateOptions(planOptions);
        });
    });


    
    // Object.keys(planData).forEach(function(plan) {
    //     var planInfo = planData[plan];

    //     var planOptions = {
    //         series: [{
    //             name: plan,
    //             type: 'area',
    //             data: planInfo.data
    //         }],
    //         chart: {
    //             height: 400,
    //             width: '100%',
    //             type: 'area',
    //             stacked: false,
    //             toolbar: {
    //                 show: false
    //             }
    //         },
    //         dataLabels:{
    //             enabled:false
    //         },
    //         stroke: {
    //             width: [1],
    //             curve: 'smooth'
    //         },
    //         fill: {
    //             type: 'solid',
    //             opacity: 0.3
    //         },
    //         tooltip: {
    //             shared: true,
    //             intersect: false,
    //             y: {
    //                 formatter: function (y) {
    //                     if (typeof y !== "undefined") {
    //                         return y.toFixed(2) + " units"; // Formato con dos decimales
    //                     }
    //                     return y;
    //                 }
    //             }
    //         },
    //         xaxis: {
    //             categories: planInfo.months,

    //         },
    //         yaxis: {
    //             title: {
    //                 text: 'Ganancia',
    //            },
    //             labels: {
    //                 formatter: function (value) {
    //                     return value.toFixed(2); // Formato con dos decimales para las etiquetas del eje Y
    //                 },
    //             }
    //         }

    //     };
    //     var planChart = new ApexCharts(document.querySelector("#chart_" + plan), planOptions);
    //     planChart.render();
    // });


    var donaData = [porcentajeInvitados, 100 - porcentajeInvitados];

    var porcentaje_subs = {
        series: donaData,
        chart: {
            width: 380,
            type: 'donut',
        },
        labels: ['Porcentaje Invitados', 'Total Users'],
        dataLabels: {
            enabled: false
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    show: false
                }
            }
        }],
        legend: {
            position: 'right',
            offsetY: 0,
            height: 230,

        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,

                        value: {
                            fontSize: '44px',
                            formatter: function (val) {
                                return val.toFixed(2) + "%";
                            }
                        },
                        total: {
                            show: true,
                            label: 'Total',
                        }
                    }
                }
            }
        }   
    };

    var chart_porcentaje_Subs = new ApexCharts(document.querySelector("#porcentaje_subs"), porcentaje_subs);
    chart_porcentaje_Subs.render();

    var planOptions = {
        series: [{
            name: 'Monto Generado',
            type: 'line',
            data: chartValues
        }],
        chart: {
            height: 400,
            width: '100%',
            type: 'line',
            stacked: false,
            toolbar: {
                show: false
            }
        },
        colors: ['#1C305C'], // Color de la línea
        stroke: {
            width: [3],
            curve: 'smooth'
        },
        markers: {
            size: 6,
            colors: ['#0000000'], // Color de los marcadores
            strokeColors: ['#333'],
            strokeWidth: 2
        },
        fill: {
            type: 'solid',
            colors: ['#1C305C'], // Color del área bajo la línea
            opacity: 0.3
        },
        tooltip: {
            theme: 'dark',
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(2) + " units"; // Formato con dos decimales
                    }
                    return y;
                }
            }
        },
        xaxis: {
            categories: chartLabels,
            labels: {
                style: {
                    colors: '#000000' // Color de las etiquetas del eje X
                }
            }
        },
        yaxis: {
            title: {
                text: 'Ganancia',
                style: {
                    color: '#000000'
                }
            },
            labels: {
                formatter: function (value) {
                    return value.toFixed(2); // Formato con dos decimales para las etiquetas del eje Y
                },
                style: {
                    colors: '#000000' // Color de las etiquetas del eje Y
                }
            }
        },
        legend: {
            labels: {
                colors: '#000000' // Color de las etiquetas de la leyenda
            }
        }
    };

    var planChart = new ApexCharts(document.querySelector("#chart_monto_generado"), planOptions);
    planChart.render();




});
