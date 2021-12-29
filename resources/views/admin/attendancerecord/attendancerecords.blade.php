@extends('layouts.admin')

@section('title','勤務記録一覧')

@section('content')
    <div class="container">
        <h2>勤務記録一覧</h2>
        <div class="row">
            <div class="col-8">
                <form action="{{ action('Admin\AttendanceController@attendancerecords') }}" method="get">
                    <div class="form-group row">
                        <div class="col-8">
                            <input type="text" class="form-control" name='cond_user' list='saved-user-name' placeholder="入力もしくは選択" autocomplete="off">
                                <datalist id='saved-user-name'>
                                    @foreach($users as $user)
                                        <option value="{{ $user->name }}">
                                    @endforeach
                                </datalist>
                        </div>
                        <div class="col-4">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-secondary" value="検索">
                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4 text-right mb-3">
                <a href="{{ action('Admin\AttendanceController@add_new_attendancerecord') }}" role="button" class="btn btn-primary">新規登録</a>
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
                                <th scope="col">名前</th>
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
                                    <td>{{ $attendance->user->name??'名前が削除されています' }}</td>
                                    <td>{{ $attendance->site->name??'現場名が削除されています' }}</td>
                                    <th>{{ $attendance->house_maker->name }}</th>
                                    <td>{{ $attendance->house_maker->get_help }}</td>
                                    <td>{{ $attendance->work_time }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\AttendanceController@edit_attendancerecord' , ['id' => $attendance->id]) }}" role="button" class="btn btn-secondary">編集</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCentered{{ $attendance->id }}">削除</button> <!--foreach内のため、attendance->idで場合に応じたidが取得できるよう設定。-->
                                            <div class="modal" id="deleteModalCentered{{ $attendance->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenteredLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalCenteredLabel">確認</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>削除しますか？</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                                            <a href="{{ action('Admin\AttendanceController@delete_attendancerecord' , ['id' => $attendance->id]) }}" role="button" class="btn btn-danger">削除</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection