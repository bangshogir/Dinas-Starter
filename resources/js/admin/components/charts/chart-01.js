import ApexCharts from "apexcharts";

// ===== chartOne
const chart01 = () => {
    const chartSelector = document.querySelectorAll("#chartOne");

    if (chartSelector.length) {
        const chartElement = document.querySelector("#chartOne");
        
        let categories = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let seriesData = [168, 385, 201, 298, 187, 195, 291, 110, 215, 390, 280, 112];
        let seriesName = "Sales";

        if (chartElement.dataset.categories) {
            try {
                categories = JSON.parse(chartElement.dataset.categories);
            } catch (e) {
                console.error("Error parsing categories", e);
            }
        }
        if (chartElement.dataset.series) {
            try {
                seriesData = JSON.parse(chartElement.dataset.series);
                seriesName = "Visitors"; 
            } catch (e) {
                console.error("Error parsing series", e);
            }
        }

        const chartOneOptions = {
            series: [{
                name: seriesName,
                data: seriesData,
            }, ],
            colors: ["#465fff"],
            chart: {
                fontFamily: "Outfit, sans-serif",
                type: "bar",
                height: 180,
                toolbar: {
                    show: false,
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "39%",
                    borderRadius: 5,
                    borderRadiusApplication: "end",
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 4,
                colors: ["transparent"],
            },
            xaxis: {
                categories: categories,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            legend: {
                show: true,
                position: "top",
                horizontalAlign: "left",
                fontFamily: "Outfit",

                markers: {
                    radius: 99,
                },
            },
            yaxis: {
                title: false,
            },
            grid: {
                yaxis: {
                    lines: {
                        show: true,
                    },
                },
            },
            fill: {
                opacity: 1,
            },

            tooltip: {
                x: {
                    show: false,
                },
                y: {
                    formatter: function(val) {
                        return val;
                    },
                },
            },
        };

        const chartFour = new ApexCharts(
            document.querySelector("#chartOne"),
            chartOneOptions,
        );
        chartFour.render();
    }
};

export default chart01;
