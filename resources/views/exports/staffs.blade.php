<table class="table table-bordered table-striped text-center">
    <tbody>
        <tr>
            <th style="width: 10px;">#</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Mã nhân viên</th>
            <th>Vai trò</th>
        </tr>
        @foreach ($staffs as $staff)
            <tr>
                <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                <td style="vertical-align: middle;">{{ $staff->name }}</td>
                <td style="vertical-align: middle;">{{ $staff->user->email }}</td>
                <td style="vertical-align: middle;">{{ $staff->id }}</td>
                <td style="vertical-align: middle;">{{ $staff->user->role }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
