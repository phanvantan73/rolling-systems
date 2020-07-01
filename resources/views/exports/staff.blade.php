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
