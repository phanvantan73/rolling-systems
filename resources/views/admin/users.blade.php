@extends('adminlte::page')

@section('content_header')
    <h1>Quản lý nhân viên</h1>
    {{ Breadcrumbs::render('staffs') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý nhân viên</h3>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('staffs.export') }}">
                        <i class="fa fa-fw fa-download"></i>
                        Xuất file xlsx
                    </a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Mã nhân viên</th>
                                <th>Vai trò</th>
                                <th>Chi tiết</th>
                            </tr>
                            @foreach ($staffs as $staff)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->name }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->user->email }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->id }}</td>
                                    <td style="vertical-align: middle;">{{ $staff->user->role }}</td>
                                    <td>
                                        <a class="btn" title="Chi tiết" href="{{ route('staffs.show', $staff->id) }}">
                                            <i class="fa fa-fw fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Biểu đồ</h3>
                    <div class="box-tools pull-right">
                        <div class="select-box" style="display: inline-block; width: 200px;">
                            Chọn năm
                            <select class="select2e" name="select-year" id="select-year" data-url="{{ route('get_data_by_year') }}">
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020" selected>2020</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="user-chart" data-chart={{ json_encode($data) }}></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function () {
        let barChartData = $('#user-chart').data('chart');

        $(document).on('change', '#select-year', function () {
            $.ajax({
                method: 'GET',
                url: $(this).data('url') + '?year=' + $(this).val(),
                success: function (data) {
                    barChartData.datasets.forEach(d => {
                        if (d.inLate) {
                            d.data = data.data.map(c => c.in_late);
                        }
                        if (d.outEarly) {
                            d.data = data.data.map(c => c.out_early);
                        }
                        if (d.overTemp) {
                            d.data = data.data.map(c => c.over_temp);
                        }
                    });
                    window.myBar.update();
                },
                error: function (e) {
                    console.log(e);
                }
            });
        });

        chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        
        let MONTHS = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];
        let color = Chart.helpers.color;
        barChartData = redefineChartData(barChartData);

        window.onload = function() {
            var ctx = document.getElementById('user-chart').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Biểu đồ đi trễ, về sớm, bị sốt trong năm'
                    },
                    scales: {
                        yAxes: 
                        [
                            {
                                ticks: {
                                    stepSize: 5
                                }
                            }
                        ]
                    }
                }
            });
        };

        function redefineChartData(data) {
            return {
                labels: MONTHS,
                datasets: 
                [
                    {
                        label: 'Đi trễ',
                        backgroundColor: color(chartColors.yellow).alpha(0.5).rgbString(),
                        borderColor: chartColors.yellow,
                        borderWidth: 1,
                        data: data.map(c => c.in_late),
                        inLate: true
                    },
                    {
                        label: 'Về sớm',
                        backgroundColor: color(chartColors.blue).alpha(0.5).rgbString(),
                        borderColor: chartColors.blue,
                        borderWidth: 1,
                        data: data.map(c => c.out_early),
                        outEarly: true
                    },
                    {
                        label: 'Sốt trên 37°C',
                        backgroundColor: color(chartColors.red).alpha(0.5).rgbString(),
                        borderColor: chartColors.red,
                        borderWidth: 1,
                        data: data.map(c => c.over_temp),
                        overTemp: true
                    }
                ]
            }
        }
    });
</script>
@stop
