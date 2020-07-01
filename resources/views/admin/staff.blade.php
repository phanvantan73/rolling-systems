@extends('adminlte::page')

@section('content_header')
    <h1>Thông tin nhân viên</h1>
    {{ Breadcrumbs::render('staffs.show', $staff) }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin nhân viên</h3>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('staffs.diaries_export', $staff->id) }}">
                        <i class="fa fa-fw fa-download"></i>
                        Xuất file xlsx
                    </a>
                    <a class="btn btn-primary pull-right" title="Thêm mới" href="{{ route('staffs.index') }}" style="margin-right: 20px;">
                        <i class="fa fa-fw fa-arrow-left"></i>
                        Quay lại danh sách nhân viên
                    </a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped text-center">
                        <tbody>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>Tên</th>
                                <th>Nhiệt độ</th>
                                <th>Thời gian checkin</th>
                                <th>Thời gian checkout</th>
                                <th>Ngày làm việc</th>
                                <th>Mã nhân viên</th>
                            </tr>
                            @foreach ($staff->diaries as $diary)
                                <tr>
                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td style="vertical-align: middle;">{{ $diary->staff->name }}</td>
                                    <td style="vertical-align: middle;">{{ $diary->temp }}</td>
                                    <td style="vertical-align: middle;">{{ $diary->timein }}</td>
                                    <td style="vertical-align: middle;">{{ $diary->timeout }}</td>
                                    <td style="vertical-align: middle;">{{ $diary->day }}</td>
                                    <td style="vertical-align: middle;">{{ $diary->idNv }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lịch làm việc</h3>
                </div>
                <div class="box-body">
                    <div id="calendar" class="fc fc-unthemed fc-ltr" data-calendar="{{ json_encode($staff->diaries) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            const FORMAT = 'HH:mm:ss';
            const START_TIME = '09:00:00';
            const END_TIME = '17:00:00';
            let data = $('#calendar').data('calendar');
            let events = [];

            for (const item in data) {
                if (data.hasOwnProperty(item)) {
                    const element = data[item];
                    let timeInBackgroundColor = moment(element.timein, FORMAT).isBefore(moment(START_TIME, FORMAT)) ? 'green' : 'red';
                    let timeInBorderColor = moment(element.timein, FORMAT).isBefore(moment(START_TIME, FORMAT)) ? 'green' : 'red';
                    let timeOutBackgroundColor = moment(element.timeout, FORMAT).isAfter(moment(END_TIME, FORMAT)) ? 'green' : 'red';
                    let timeOutBorderColor = moment(element.timeout, FORMAT).isAfter(moment(END_TIME, FORMAT)) ? 'green' : 'red';
                    let tempBackgroundColor = element.temp >= 37 ? 'orange' : 'green';
                    let tempBorderColor = element.temp >= 37 ? 'orange' : 'green';
                    let inEvent = {
                        title: element.timein,
                        start: element.day,
                        end: element.day,
                        backgroundColor: timeInBackgroundColor,
                        borderColor: timeInBorderColor
                    };
                    let outEvent = {
                        title: element.timeout,
                        start: element.day,
                        end: element.day,
                        backgroundColor: timeOutBackgroundColor,
                        borderColor: timeOutBorderColor
                    };
                    let temp = {
                        title: `${element.temp}`,
                        start: element.day,
                        end: element.day,
                        backgroundColor: tempBackgroundColor,
                        borderColor: tempBorderColor
                    };
                    events.push(inEvent, outEvent, temp);
                }
            }
            console.log(events);


            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                editable: true,
                events: events
            });
        });
    </script>
@endsection
