// Data retrieved https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature
Highcharts.chart("container", {
    chart: {
        type: "spline",
    },
    title: {
        text: "Monthly Average Document Transaction",
    },
    // subtitle: {
    //     text:
    //         "Source: " +
    //         '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
    //         'target="_blank">Wikipedia.com</a>',
    // },
    xAxis: {
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ],
        accessibility: {
            description: "Months of the year",
        },
    },
    yAxis: {
        title: {
            text: "Document",
        },
        labels: {
            formatter: function () {
                return this.value + "";
            },
        },
    },
    tooltip: {
        crosshairs: true,
        shared: true,
    },
    plotOptions: {
        spline: {
            marker: {
                radius: 4,
                lineColor: "#666666",
                lineWidth: 1,
            },
        },
    },
    series: [
        {
            name: "Requested",
            marker: {
                symbol: "square",
            },
            data: [
                5.2,
                5.7,
                8.7,
                13.9,
                18.2,
                21.4,
                13.0,
                {
                    y: 26.4,
                    // marker: {
                    //     symbol: "url(https://www.highcharts.com/samples/graphics/sun.png)",
                    // },
                    accessibility: {
                        description:
                            "Sunny symbol, this is the warmest point in the chart.",
                    },
                },
                22.8,
                17.5,
                12.1,
                7.6,
            ],
        },
        {
            name: "Signed",
            marker: {
                symbol: "diamond",
            },
            data: [
                {
                    y: 9.5,
                    // marker: {
                    //     symbol: "url(https://www.highcharts.com/samples/graphics/snow.png)",
                    // },
                    accessibility: {
                        description:
                            "Snowy symbol, this is the coldest point in the chart.",
                    },
                },
                7.6,
                3.3,
                5.9,
                10.5,
                13.5,
                20.5,
                14.4,
                11.5,
                8.7,
                4.7,
                15.9,
            ],
        },
    ],
});
