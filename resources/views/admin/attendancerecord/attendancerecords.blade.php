@extends('layouts.admin')

@section('title','勤務記録一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>勤務記録一覧</h2>
            </div>
            <div class="text-right mb-3">
                <a href="{{ action('Admin\AttendanceController@add_new_attendancerecord') }}" role="button" class="btn btn-primary">新規登録</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="{{ action('Admin\AttendanceController@attendancerecords') }}" method="get">
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    絞り込み
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col text-right mb-3">
                                            <a href="{{ action('Admin\AttendanceController@attendancerecords') }}" role="button" class="btn btn-secondary">検索をリセット</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control mb-3" name="cond_user" list="saved-users-name" placeholder="名前を入力もしくは選択" autocomplete="off" value="{{ $q['cond_user'] }}">
                                                <datalist id="saved-users-name">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->name }}">
                                                    @endforeach
                                                </datalist>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control mb-3" name="cond_site" list="saved-sites-name" placeholder="現場名を入力もしくは選択" autocomplete="off" value="{{ $q['cond_site'] }}">
                                                <datalist id="saved-sites-name">
                                                    @foreach($sites as $site)
                                                        <option value="{{ $site->name }}">
                                                    @endforeach
                                                </datalist>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control mb-3" name="cond_housemaker" list="saved_housemakers_name" placeholder="ハウスメーカーを入力もしくは選択" autocomplete="off" value="{{ $q['cond_housemaker'] }}">
                                                <datalist id="saved_housemakers_name">
                                                    @foreach($housemakers as $housemaker)
                                                        <option value="{{ $housemaker->name }}">
                                                    @endforeach
                                                </datalist>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">     
                                            <input type="date" class="form-control" name="from" placeholder="カレンダーから選択" value="{{ $q['from'] }}">
                                        </div>
                                        <div class="col-1 m-auto">
                                            ～
                                        </div>
                                        <div class="col">
                                            <input type="date" class="form-control" name="until" placeholder="カレンダーから選択" value="{{ $q['until'] }}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        {{ csrf_field() }}
                                        <input type="submit" class="btn btn-dark btn-lg btn-block" value="検索">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                @if(isset($total_day))
                                <div class="card border-dark my-3 text-center" >
                                    <div class="card-body">
                                        <p class="card-text">合計勤務日数は{{ $total_day }}日です。</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
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
                                    <td>{{ $attendance->work_time_string }}</td>
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