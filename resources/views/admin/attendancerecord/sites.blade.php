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
                                    <td>{{ $site->housemaker_id }}</td>
                                    <td>a</td>
                                    <td>a</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\AttendanceController@edit_site') }}" role="button" class="btn btn-primary">編集</a>
                                            <!--<a href="{{ action('Admin\AttendanceController@delete_site') }}" role="button" class="btn btn-secondary">削除</a>-->
                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="sakujyokakuninn">削除</button>
                                            
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