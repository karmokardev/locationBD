import ApexCharts from "apexcharts";

export const initCustomerChart = () => {
    const chartElement = document.querySelector('#customerChartData');

    if (chartElement) {
        const chartOptions = {
            series: [
                {
                    name: "Customers",
                    data: customerData,
                },
                {
                    name: "Subscriptions",
                    data: subscribedUsersData,
                }
            ],
            chart: {
                type: "area",
                height: 200,
                toolbar: { show: false },
            },
            colors: ["#465FFF", "#22C55E"],
            stroke: { curve: "smooth", width: 2 },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            tooltip: {
                y: [
                    {
                        formatter: val => val.toLocaleString()
                    },
                    {
                        formatter: val => val.toLocaleString()
                    }
                ]
            }
        };


        const chart = new ApexCharts(chartElement, chartOptions);
        chart.render();
        return chart;
    }
};

export default initCustomerChart;
