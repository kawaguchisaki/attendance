@extends('layouts.admin')

@section('title','現場一覧')

@section('content')
    <div class="container">
        <h2>現場一覧</h2>
        <div class="text-right">
            <a href="{{ action('Admin\AttendanceController@add_new_site') }}" role="button" class="btn btn-primary">新規登録</a>
        </div>
        <div class="row">
            <div class="list-site col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-striped col-auto">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">現場名</th>
                                <th scope="col">ハウスメーカー</th>
                                <th scope="col">応援</th>
                                <th scope="col">担当者</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                                <tr>
                                    <td>{{ $site->id }}</td>
                                    <td>{{ $site->name }}</td>
                                    <td>{{ $site->house_maker->name }}</td>
                                    <td>{{ $site->house_maker->get_help }}</td>
                                    <td>a</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\AttendanceController@edit_site' , ['id' => $site->id]) }}" role="button" class="btn btn-secondary">編集</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalCentered{{ $site->id }}">削除</button> //foreach内のため、{{ $site->id }}で場合に応じたidが取得できるよう設定。
                                            <div class="modal" id="deleteModalCentered{{ $site->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenteredLabel" aria-hidden="true">
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
                                                            <a href="{{ action('Admin\AttendanceController@delete_site' , ['id' => $site->id]) }}" role="button" class="btn btn-danger">削除</a>
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