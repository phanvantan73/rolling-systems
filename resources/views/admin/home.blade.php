@extends('adminlte::page')

@section('content_header')
    <h1>Trang chủ</h1>
    {{ Breadcrumbs::render('home') }}
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lịch làm việc</h3>
                </div>
                <div class="box-body no-padding">
                    <div id="calendar" class="fc fc-unthemed fc-ltr" data-calendar="{{ json_encode($diaries) }}">
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
                        title: `${element.timein}`,
                        start: element.day,
                        end: element.day,
                        backgroundColor: timeInBackgroundColor,
                        borderColor: timeInBorderColor
                    };
                    let divideEvent = {
                        title: '-----------',
                        start: element.day,
                        end: element.day,
                        backgroundColor: 'white',
                        borderColor: 'white'
                    };
                    let outEvent = {
                        title: `${element.timeout}`,
                        start: element.day,
                        end: element.day,
                        backgroundColor: timeOutBackgroundColor,
                        borderColor: timeOutBorderColor
                    };
                    let temp = {
                        title: `${element.temp}°C`,
                        start: element.day,
                        end: element.day,
                        backgroundColor: tempBackgroundColor,
                        borderColor: tempBorderColor
                    };
                    events.push(inEvent, divideEvent, outEvent, divideEvent, temp);
                }
            }


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
