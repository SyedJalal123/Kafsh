@extends('backend.app')

@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center py-1">
        
    </div>
    <!--end::Actions-->
@endsection
@section('content')
    <div class="">
        <!--begin::Mixed Widget 2-->
        <h1 class="my-5 mx-2">Views</h1>
        <div class="card">
            <div class="card card-bordered">
                <div class="card-body main-card-body">
                    <div>
                        <button class="tag-button-1">
                            <input onchange="submit_filter()" type="text" id="kt_datepicker_7" class="b-none outline-none w-100" placeholder="Today" max="{{date('Y-m-d')}}">
                        </button>
                    </div>
                    <div id="kt_apexcharts_3" style="height: 250px;"></div>
                </div>
            </div>
            {{-- @foreach ($views as $view)
                {{Location::get($view->collection)->cityName}}<br>
            @endforeach --}}
        </div>
        <h1 class="my-5 mx-2">Orders</h1>
        <div class="card">
            <div class="card card-bordered">
                <div class="card-body main-card-body-2">
                    <div>
                        <button class="tag-button-1">
                            <input onchange="submit_filter_orders()" type="text" id="kt_datepicker_8" class="b-none outline-none w-100" placeholder="Today" max="{{date('Y-m-d')}}">
                        </button>
                    </div>
                    <div id="kt_apexcharts_4" style="height: 250px;"></div>
                </div>
            </div>
        </div>
        <!--end::Mixed Widget 2-->
    </div>
@endsection

@section('scripts')
    {{-- <script src="{{asset('frontend/js/apexcharts.js')}}"></script> --}}
    <script>
        // Visitors Chart /////////////////////////////////////////////////
            var element = document.getElementById('kt_apexcharts_3');
            var categories = @json($categories);
            var data = @json($data);
            
            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

            // if (!element) {
            //     return;
            // }

            var options = {
                series: [{
                    name: 'Visitors',
                    data: data
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: categories,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: baseColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                },
                colors: [lightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    strokeColor: baseColor,
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        // Visitors Chart /////////////////////////////////////////////////
        // Orders Chart /////////////////////////////////////////////////
            var element = document.getElementById('kt_apexcharts_4');
            var categories = @json($categories);
            var data = @json($order_data);
            
            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-info');
            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

            // if (!element) {
            //     return;
            // }

            var options = {
                series: [{
                    name: 'Orders',
                    data: data
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: categories,
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: baseColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: {
                        enabled: true,
                        formatter: undefined,
                        offsetY: 0,
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function (val) {
                            return val
                        }
                    }
                },
                colors: [lightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                markers: {
                    strokeColor: baseColor,
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        // Orders Chart /////////////////////////////////////////////////

        $("#kt_datepicker_7").flatpickr({
            altInput: false,
            altFormat: "F j, Y",
            dateFormat: "d-m-Y",
            mode: "range",
            maxDate: "today"
        });
        $("#kt_datepicker_8").flatpickr({
            altInput: false,
            altFormat: "F j, Y",
            dateFormat: "d-m-Y",
            mode: "range",
            maxDate: "today"
        });

        function submit_filter_orders(){
            if(!$('.flatpickr-calendar').hasClass('open')){
                var date = $('#kt_datepicker_8').val();
                $.ajax({
                    url: PR_URL+"/backend/chart_filter_2",
                    type: "POST",
                    data:{ 
                        date: date,
                    },
                    success: function(response){
                        // console.log(response);
                        // Visitors Chart /////////////////////////////////////////////////
                            $('#kt_apexcharts_4').remove();
                            $('.main-card-body-2').append('<div id="kt_apexcharts_4" style="height: 250px;"></div>');
                            var element = document.getElementById('kt_apexcharts_4');
                            
                            var height = parseInt(KTUtil.css(element, 'height'));
                            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                            var baseColor = KTUtil.getCssVariableValue('--bs-info');
                            var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

                            var options = {
                                series: [{
                                    name: 'Orders',
                                    data: response[1]
                                }],
                                chart: {
                                    fontFamily: 'inherit',
                                    type: 'area',
                                    height: height,
                                    toolbar: {
                                        show: false
                                    }
                                },
                                plotOptions: {},
                                legend: {
                                    show: false
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                fill: {
                                    type: 'solid',
                                    opacity: 1
                                },
                                stroke: {
                                    curve: 'smooth',
                                    show: true,
                                    width: 3,
                                    colors: [baseColor]
                                },
                                xaxis: {
                                    categories: response[0],
                                    axisBorder: {
                                        show: false,
                                    },
                                    axisTicks: {
                                        show: false
                                    },
                                    labels: {
                                        style: {
                                            colors: labelColor,
                                            fontSize: '12px'
                                        }
                                    },
                                    crosshairs: {
                                        position: 'front',
                                        stroke: {
                                            color: baseColor,
                                            width: 1,
                                            dashArray: 3
                                        }
                                    },
                                    tooltip: {
                                        enabled: true,
                                        formatter: undefined,
                                        offsetY: 0,
                                        style: {
                                            fontSize: '12px'
                                        }
                                    }
                                },
                                yaxis: {
                                    labels: {
                                        style: {
                                            colors: labelColor,
                                            fontSize: '12px'
                                        }
                                    }
                                },
                                states: {
                                    normal: {
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    },
                                    hover: {
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    },
                                    active: {
                                        allowMultipleDataPointsSelection: false,
                                        filter: {
                                            type: 'none',
                                            value: 0
                                        }
                                    }
                                },
                                tooltip: {
                                    style: {
                                        fontSize: '12px'
                                    },
                                    y: {
                                        formatter: function (val) {
                                            return val
                                        }
                                    }
                                },
                                colors: [lightColor],
                                grid: {
                                    borderColor: borderColor,
                                    strokeDashArray: 4,
                                    yaxis: {
                                        lines: {
                                            show: true
                                        }
                                    }
                                },
                                markers: {
                                    strokeColor: baseColor,
                                    strokeWidth: 3
                                }
                            };

                            var chart = new ApexCharts(element, options);
                            chart.render();
                        // Visitors Chart /////////////////////////////////////////////////
                    }
                });
            }
        }
        function submit_filter(){
            if(!$('.flatpickr-calendar').hasClass('open')){
                var date = $('#kt_datepicker_7').val();
                $.ajax({
                    url: PR_URL+"/backend/chart_filter",
                    type: "POST",
                    data:{ 
                        date: date,
                    },
                    success: function(response){
                    // Visitors Chart /////////////////////////////////////////////////
                        $('#kt_apexcharts_3').remove();
                        $('.main-card-body').append('<div id="kt_apexcharts_3" style="height: 250px;"></div>');
                        var element = document.getElementById('kt_apexcharts_3');
                        
                        var height = parseInt(KTUtil.css(element, 'height'));
                        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                        var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                        var baseColor = KTUtil.getCssVariableValue('--bs-info');
                        var lightColor = KTUtil.getCssVariableValue('--bs-light-info');

                        // if (!element) {
                        //     return;
                        // }

                        var options = {
                            series: [{
                                name: 'Visitors',
                                data: response[1]
                            }],
                            chart: {
                                fontFamily: 'inherit',
                                type: 'area',
                                height: height,
                                toolbar: {
                                    show: false
                                }
                            },
                            plotOptions: {},
                            legend: {
                                show: false
                            },
                            dataLabels: {
                                enabled: false
                            },
                            fill: {
                                type: 'solid',
                                opacity: 1
                            },
                            stroke: {
                                curve: 'smooth',
                                show: true,
                                width: 3,
                                colors: [baseColor]
                            },
                            xaxis: {
                                categories: response[0],
                                axisBorder: {
                                    show: false,
                                },
                                axisTicks: {
                                    show: false
                                },
                                labels: {
                                    style: {
                                        colors: labelColor,
                                        fontSize: '12px'
                                    }
                                },
                                crosshairs: {
                                    position: 'front',
                                    stroke: {
                                        color: baseColor,
                                        width: 1,
                                        dashArray: 3
                                    }
                                },
                                tooltip: {
                                    enabled: true,
                                    formatter: undefined,
                                    offsetY: 0,
                                    style: {
                                        fontSize: '12px'
                                    }
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        colors: labelColor,
                                        fontSize: '12px'
                                    }
                                }
                            },
                            states: {
                                normal: {
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                },
                                hover: {
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                },
                                active: {
                                    allowMultipleDataPointsSelection: false,
                                    filter: {
                                        type: 'none',
                                        value: 0
                                    }
                                }
                            },
                            tooltip: {
                                style: {
                                    fontSize: '12px'
                                },
                                y: {
                                    formatter: function (val) {
                                        return val
                                    }
                                }
                            },
                            colors: [lightColor],
                            grid: {
                                borderColor: borderColor,
                                strokeDashArray: 4,
                                yaxis: {
                                    lines: {
                                        show: true
                                    }
                                }
                            },
                            markers: {
                                strokeColor: baseColor,
                                strokeWidth: 3
                            }
                        };

                        var chart = new ApexCharts(element, options);
                        chart.render();
                    // Visitors Chart /////////////////////////////////////////////////
                    }
                });
            }
        }
    </script>
@show
