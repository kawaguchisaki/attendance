@extends('layouts.admin')

@section('title','ホーム(管理者)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <h2>ホーム</h2>
            </div>
            <div class="col-12 mx-auto">
                <div class="card text-center border-dark mb-3">
                    <h5 class="card-header border-dark">勤務記録</h5>
                        <div class="card-body">
                            <a class="btn btn-dark btn-lg btn-block" href="{{ route('new') }}" role="button">登録</a>
                            <a class="btn btn-secondary btn-lg btn-block" href="{{ route('admin_attendancerecords') }}" role="button">一覧</a>
                        </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="card text-center border-dark mb-3">
                            <h5 class="card-header border-dark">現場</h5>
                                <div class="card-body">
                                    <a class="btn btn-dark btn-lg btn-block" href="{{ route('new_site') }}" role="button">登録</a>
                                    <a class="btn btn-secondary btn-lg btn-block" href="{{ route('admin_sites') }}" role="button">一覧</a>
                                </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card text-center border-dark mb-3">
                            <h5 class="card-header border-dark">従業員</h5>
                                <div class="card-body">
                                    <a class="btn btn-dark btn-lg btn-block" href="{{ route('new_user') }}" role="button">登録</a>
                                    <a class="btn btn-secondary btn-lg btn-block" href="{{ route('users') }}" role="button">一覧</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col mx-auto">
                <div class="card text-center border-dark mb-3">
                    <h5 class="card-header border-dark">承認待ち勤務記録</h5>
                        <div class="card-body">
                            @if(isset($approval_0_attendances))
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">日付</th>
                                            <th scope="col">名前</th>
                                            <th scope="col">現場名</th>
                                            <th scope="col">ハウスメーカー</th>
                                            <th scope="col">応援</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                @foreach($approval_0_attendances as $approval_0_attendance)
                                    <tbody>
                                        <tr>
                                            <td>{{ $approval_0_attendance->id }}</td>
                                            <td>{{ $approval_0_attendance->date }}</td>
                                            <td>{{ $approval_0_attendance->user->name??'名前が削除されています' }}</td>
                                            <td>{{ $approval_0_attendance->site->name??'現場名が削除されています' }}</td>
                                            <th>{{ $approval_0_attendance->house_maker->name }}</th>
                                            <td>{{ $approval_0_attendance->house_maker->get_help }}</td>
                                            <td>{{ $approval_0_attendance->work_time_string }}</td>
                                            <td>
                                                <div>
                                                    <a href="{{ action('Admin\AttendanceController@approval_check' , ['id' => $approval_0_attendance->id]) }}" role="button" class="btn btn-secondary">承認へ進む</a>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCentered{{ $approval_0_attendance->id }}">削除</button> <!--foreach内のため、approval_0_attendance->idで場合に応じたidが取得できるよう設定。-->
                                                    <div class="modal" id="deleteModalCentered{{ $approval_0_attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenteredLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="deleteModalCenteredLabel">確認</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>申請を却下しますか？</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                                                    <a href="{{ action('Admin\AttendanceController@delete_attendancerecord' , ['id' => $approval_0_attendance->id]) }}" role="button" class="btn btn-danger">却下</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                                </table>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection