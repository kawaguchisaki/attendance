@extends('layouts.admin')

@section('title','従業員一覧')

@section('content')
    <div class="container">
        <h2>従業員一覧</h2>
        <div class="text-right">
            <a href="{{ action('Admin\AttendanceController@add_new_user') }}" role="button" class="btn btn-primary">新規登録</a>
        </div>
        <div class="row">
            <div class="list-site col-12 mx-auto">
                <div class="row">
                    <table class="table table-striped col-auto">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col-1"></th>
                                <th scope="col">名前</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->icon_path }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <div class="text-right">
                                            <a href="{{ action('Admin\AttendanceController@edit_user' , ['id' => $user->id]) }}" role="button" class="btn btn-secondary">編集</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCentered{{ $user->id }}">削除</button> <!--foreach内のため、{{ $user->id }}で場合に応じたidが取得できるよう設定。-->
                                            <div class="modal" id="deleteModalCentered{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenteredLabel" aria-hidden="true">
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
                                                            <a href="{{ action('Admin\AttendanceController@delete_user' , ['id' => $user->id]) }}" role="button" class="btn btn-danger">削除</a>
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
    </div>
@endsection