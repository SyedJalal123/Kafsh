"use strict";
var KTGeneralApexCharts = {
    init: function () {
        var e, t, a, s, i, o, r;
        (e = document.getElementById("kt_apexcharts_1")),
        (t = parseInt(KTUtil.css(e, "height"))),
        (a = KTUtil.getCssVariableValue("--bs-gray-500")),
        (s = KTUtil.getCssVariableValue("--bs-gray-200")),
        (i = KTUtil.getCssVariableValue("--bs-primary")),
        (o = KTUtil.getCssVariableValue("--bs-gray-300")),
        (r = KTUtil.getCssVariableValue("--bs-danger")),
        e &&
            new ApexCharts(e, {
                series: [
                    {
                        name: "Net Profit",
                        data: [
                            44, 55, 57, 56, 61, 58, 43, 56, 65, 41, 55, 66,
                        ],
                    },
                    {
                        name: "Cost",
                        data: [
                            32, 34, 52, 46, 27, 60, 41, 49, 13, 11, 44, 33,
                        ],
                    },
                    {
                        name: "Revenue",
                        data: [
                            76, 85, 101, 98, 87, 105, 87, 99, 75, 82, 91,
                            89,
                        ],
                    },
                ],
                chart: {
                    fontFamily: "inherit",
                    type: "bar",
                    height: t,
                    toolbar: { show: !1 },
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: ["40%"],
                        endingShape: "rounded",
                    },
                },
                legend: { show: !1 },
                dataLabels: { enabled: !1 },
                stroke: { show: !0, width: 2, colors: ["transparent"] },
                xaxis: {
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
                    axisBorder: { show: !1 },
                    axisTicks: { show: !1 },
                    labels: { style: { colors: a, fontSize: "12px" } },
                },
                yaxis: {
                    labels: { style: { colors: a, fontSize: "12px" } },
                },
                fill: { opacity: 1 },
                states: {
                    normal: { filter: { type: "none", value: 0 } },
                    hover: { filter: { type: "none", value: 0 } },
                    active: {
                        allowMultipleDataPointsSelection: !1,
                        filter: { type: "none", value: 0 },
                    },
                },
                tooltip: {
                    style: { fontSize: "12px" },
                    y: {
                        formatter: function (e) {
                            return "$" + e + " thousands";
                        },
                    },
                },
                colors: [i, r, o],
                grid: {
                    borderColor: s,
                    strokeDashArray: 4,
                    yaxis: { lines: { show: !0 } },
                },
            }).render(),
        (function () {
            var e = document.getElementById("kt_apexcharts_2"),
                t = parseInt(KTUtil.css(e, "height")),
                a = KTUtil.getCssVariableValue("--bs-gray-500"),
                s = KTUtil.getCssVariableValue("--bs-gray-200"),
                i = KTUtil.getCssVariableValue("--bs-warning"),
                o = KTUtil.getCssVariableValue("--bs-gray-300");
            e &&
                new ApexCharts(e, {
                    series: [
                        {
                            name: "Net Profit",
                            data: [44, 55, 57, 56, 61, 58],
                        },
                        {
                            name: "Revenue",
                            data: [76, 85, 101, 98, 87, 105],
                        },
                    ],
                    chart: {
                        fontFamily: "inherit",
                        type: "bar",
                        height: t,
                        toolbar: { show: !1 },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: !0,
                            columnWidth: ["30%"],
                            endingShape: "rounded",
                        },
                    },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                    xaxis: {
                        categories: [
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                        ],
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        labels: { style: { colors: a, fontSize: "12px" } },
                    },
                    yaxis: {
                        labels: { style: { colors: a, fontSize: "12px" } },
                    },
                    fill: { opacity: 1 },
                    states: {
                        normal: { filter: { type: "none", value: 0 } },
                        hover: { filter: { type: "none", value: 0 } },
                        active: {
                            allowMultipleDataPointsSelection: !1,
                            filter: { type: "none", value: 0 },
                        },
                    },
                    tooltip: {
                        style: { fontSize: "12px" },
                        y: {
                            formatter: function (e) {
                                return "$" + e + " thousands";
                            },
                        },
                    },
                    colors: [i, o],
                    grid: {
                        borderColor: s,
                        strokeDashArray: 4,
                        yaxis: { lines: { show: !0 } },
                    },
                }).render();
        })(),
        (function () {
            var e = document.getElementById("kt_apexcharts_3"),
                t = parseInt(KTUtil.css(e, "height")),
                a = KTUtil.getCssVariableValue("--bs-gray-500"),
                s = KTUtil.getCssVariableValue("--bs-gray-200"),
                i = KTUtil.getCssVariableValue("--bs-info"),
                o = KTUtil.getCssVariableValue("--bs-light-info");
            e &&
                new ApexCharts(e, {
                    series: [
                        {
                            name: "Net Profit",
                            data: [30, 40, 40, 90, 90, 70, 70],
                        },
                    ],
                    chart: {
                        fontFamily: "inherit",
                        type: "area",
                        height: t,
                        toolbar: { show: !1 },
                    },
                    plotOptions: {},
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    fill: { type: "solid", opacity: 1 },
                    stroke: {
                        curve: "smooth",
                        show: !0,
                        width: 3,
                        colors: [i],
                    },
                    xaxis: {
                        categories: [
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                        ],
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        labels: { style: { colors: a, fontSize: "12px" } },
                        crosshairs: {
                            position: "front",
                            stroke: { color: i, width: 1, dashArray: 3 },
                        },
                        tooltip: {
                            enabled: !0,
                            formatter: void 0,
                            offsetY: 0,
                            style: { fontSize: "12px" },
                        },
                    },
                    yaxis: {
                        labels: { style: { colors: a, fontSize: "12px" } },
                    },
                    states: {
                        normal: { filter: { type: "none", value: 0 } },
                        hover: { filter: { type: "none", value: 0 } },
                        active: {
                            allowMultipleDataPointsSelection: !1,
                            filter: { type: "none", value: 0 },
                        },
                    },
                    tooltip: {
                        style: { fontSize: "12px" },
                        y: {
                            formatter: function (e) {
                                return "$" + e + " thousands";
                            },
                        },
                    },
                    colors: [o],
                    grid: {
                        borderColor: s,
                        strokeDashArray: 4,
                        yaxis: { lines: { show: !0 } },
                    },
                    markers: { strokeColor: i, strokeWidth: 3 },
                }).render();
        })(),
        (function () {
            var e = document.getElementById("kt_apexcharts_4"),
                t = parseInt(KTUtil.css(e, "height")),
                a = KTUtil.getCssVariableValue("--bs-gray-500"),
                s = KTUtil.getCssVariableValue("--bs-gray-200"),
                i = KTUtil.getCssVariableValue("--bs-success"),
                o = KTUtil.getCssVariableValue("--bs-light-success"),
                r = KTUtil.getCssVariableValue("--bs-warning"),
                l = KTUtil.getCssVariableValue("--bs-light-warning");
            e &&
                new ApexCharts(e, {
                    series: [
                        {
                            name: "Net Profit",
                            data: [60, 50, 80, 40, 100, 60],
                        },
                        {
                            name: "Revenue",
                            data: [70, 60, 110, 40, 50, 70],
                        },
                    ],
                    chart: {
                        fontFamily: "inherit",
                        type: "area",
                        height: t,
                        toolbar: { show: !1 },
                    },
                    plotOptions: {},
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    fill: { type: "solid", opacity: 1 },
                    stroke: { curve: "smooth" },
                    xaxis: {
                        categories: [
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                        ],
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        labels: { style: { colors: a, fontSize: "12px" } },
                        crosshairs: {
                            position: "front",
                            stroke: { color: a, width: 1, dashArray: 3 },
                        },
                        tooltip: {
                            enabled: !0,
                            formatter: void 0,
                            offsetY: 0,
                            style: { fontSize: "12px" },
                        },
                    },
                    yaxis: {
                        labels: { style: { colors: a, fontSize: "12px" } },
                    },
                    states: {
                        normal: { filter: { type: "none", value: 0 } },
                        hover: { filter: { type: "none", value: 0 } },
                        active: {
                            allowMultipleDataPointsSelection: !1,
                            filter: { type: "none", value: 0 },
                        },
                    },
                    tooltip: {
                        style: { fontSize: "12px" },
                        y: {
                            formatter: function (e) {
                                return "$" + e + " thousands";
                            },
                        },
                    },
                    colors: [i, r],
                    grid: {
                        borderColor: s,
                        strokeDashArray: 4,
                        yaxis: { lines: { show: !0 } },
                    },
                    markers: {
                        colors: [o, l],
                        strokeColor: [o, l],
                        strokeWidth: 3,
                    },
                }).render();
        })(),
        (function () {
            var e = document.getElementById("kt_apexcharts_5"),
                t = parseInt(KTUtil.css(e, "height")),
                a = KTUtil.getCssVariableValue("--bs-gray-500"),
                s = KTUtil.getCssVariableValue("--bs-gray-200"),
                i = KTUtil.getCssVariableValue("--bs-primary"),
                o = KTUtil.getCssVariableValue("--bs-light-primary"),
                r = KTUtil.getCssVariableValue("--bs-info");
            e &&
                new ApexCharts(e, {
                    series: [
                        {
                            name: "Net Profit",
                            type: "bar",
                            stacked: !0,
                            data: [40, 50, 65, 70, 50, 30],
                        },
                        {
                            name: "Revenue",
                            type: "bar",
                            stacked: !0,
                            data: [20, 20, 25, 30, 30, 20],
                        },
                        {
                            name: "Expenses",
                            type: "area",
                            data: [50, 80, 60, 90, 50, 70],
                        },
                    ],
                    chart: {
                        fontFamily: "inherit",
                        stacked: !0,
                        height: t,
                        toolbar: { show: !1 },
                    },
                    plotOptions: {
                        bar: {
                            stacked: !0,
                            horizontal: !1,
                            endingShape: "rounded",
                            columnWidth: ["12%"],
                        },
                    },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: {
                        curve: "smooth",
                        show: !0,
                        width: 2,
                        colors: ["transparent"],
                    },
                    xaxis: {
                        categories: [
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                        ],
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        labels: { style: { colors: a, fontSize: "12px" } },
                    },
                    yaxis: {
                        max: 120,
                        labels: { style: { colors: a, fontSize: "12px" } },
                    },
                    fill: { opacity: 1 },
                    states: {
                        normal: { filter: { type: "none", value: 0 } },
                        hover: { filter: { type: "none", value: 0 } },
                        active: {
                            allowMultipleDataPointsSelection: !1,
                            filter: { type: "none", value: 0 },
                        },
                    },
                    tooltip: {
                        style: { fontSize: "12px" },
                        y: {
                            formatter: function (e) {
                                return "$" + e + " thousands";
                            },
                        },
                    },
                    colors: [i, r, o],
                    grid: {
                        borderColor: s,
                        strokeDashArray: 4,
                        yaxis: { lines: { show: !0 } },
                        padding: { top: 0, right: 0, bottom: 0, left: 0 },
                    },
                }).render();
        })(),
        (function () {
            var e = document.getElementById("kt_apexcharts_6"),
                t = parseInt(KTUtil.css(e, "height")),
                a = KTUtil.getCssVariableValue("--bs-primary"),
                s = KTUtil.getCssVariableValue("--bs-success"),
                i = KTUtil.getCssVariableValue("--bs-info");
            if (e) {
                var o = {
                    series: [
                        {
                            name: "Bob",
                            data: [
                                {
                                    x: "Design",
                                    y: [
                                        new Date("2019-03-05").getTime(),
                                        new Date("2019-03-08").getTime(),
                                    ],
                                },
                                {
                                    x: "Code",
                                    y: [
                                        new Date("2019-03-02").getTime(),
                                        new Date("2019-03-05").getTime(),
                                    ],
                                },
                                {
                                    x: "Code",
                                    y: [
                                        new Date("2019-03-05").getTime(),
                                        new Date("2019-03-07").getTime(),
                                    ],
                                },
                                {
                                    x: "Test",
                                    y: [
                                        new Date("2019-03-03").getTime(),
                                        new Date("2019-03-09").getTime(),
                                    ],
                                },
                                {
                                    x: "Test",
                                    y: [
                                        new Date("2019-03-08").getTime(),
                                        new Date("2019-03-11").getTime(),
                                    ],
                                },
                                {
                                    x: "Validation",
                                    y: [
                                        new Date("2019-03-11").getTime(),
                                        new Date("2019-03-16").getTime(),
                                    ],
                                },
                                {
                                    x: "Design",
                                    y: [
                                        new Date("2019-03-01").getTime(),
                                        new Date("2019-03-03").getTime(),
                                    ],
                                },
                            ],
                        },
                        {
                            name: "Joe",
                            data: [
                                {
                                    x: "Design",
                                    y: [
                                        new Date("2019-03-02").getTime(),
                                        new Date("2019-03-05").getTime(),
                                    ],
                                },
                                {
                                    x: "Test",
                                    y: [
                                        new Date("2019-03-06").getTime(),
                                        new Date("2019-03-16").getTime(),
                                    ],
                                },
                                {
                                    x: "Code",
                                    y: [
                                        new Date("2019-03-03").getTime(),
                                        new Date("2019-03-07").getTime(),
                                    ],
                                },
                                {
                                    x: "Deployment",
                                    y: [
                                        new Date("2019-03-20").getTime(),
                                        new Date("2019-03-22").getTime(),
                                    ],
                                },
                                {
                                    x: "Design",
                                    y: [
                                        new Date("2019-03-10").getTime(),
                                        new Date("2019-03-16").getTime(),
                                    ],
                                },
                            ],
                        },
                        {
                            name: "Dan",
                            data: [
                                {
                                    x: "Code",
                                    y: [
                                        new Date("2019-03-10").getTime(),
                                        new Date("2019-03-17").getTime(),
                                    ],
                                },
                                {
                                    x: "Validation",
                                    y: [
                                        new Date("2019-03-05").getTime(),
                                        new Date("2019-03-09").getTime(),
                                    ],
                                },
                            ],
                        },
                    ],
                    chart: {
                        type: "rangeBar",
                        fontFamily: "inherit",
                        height: t,
                        toolbar: { show: !1 },
                    },
                    colors: [a, i, s],
                    plotOptions: {
                        bar: { horizontal: !0, barHeight: "80%" },
                    },
                    xaxis: { type: "datetime" },
                    stroke: { width: 1 },
                    fill: { type: "solid", opacity: 1 },
                    legend: { position: "top", horizontalAlign: "left" },
                };
                new ApexCharts(e, o).render();
            }
        })();
    },
};
KTUtil.onDOMContentLoaded(function () {
    KTGeneralApexCharts.init();
});
