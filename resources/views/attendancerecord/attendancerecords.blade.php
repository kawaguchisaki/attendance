@extends('layouts.user')

@section('title','勤務記録一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>勤務記録一覧</h2>
                <div class="text-right mb-3">
                    <a href="{{ action('AttendanceController@add_new_attendancerecord') }}" role="button" class="btn btn-primary">新規申請</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="list-site col-12 mx-auto">
                <div class="row">
                    <table class="table table-striped col-auto">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">日付</th>
                                <th scope="col">現場名</th>
                                <th scope="col">ハウスメーカー</th>
                                <th scope="col">応援</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->id }}</td>
                                    <td>{{ $attendance->date }}</td>
                                    <td>{{ $attendance->site->name }}</td>
                                    <th>{{ $attendance->house_maker->name }}</th>
                                    <td>{{ $site->house_maker->get_help }}</td>
                                    <td>{{ $attendance->day }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\AttendanceController@edit_site' , ['id' => $site->id]) }}" role="button" class="btn btn-secondary">編集申請</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection