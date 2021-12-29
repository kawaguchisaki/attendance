@extends('layouts.admin')

@section('title','CSV従業員登録確認')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto mb-5">
                <h2>登録内容確認</h2>
                <form action="{{ action('Admin\AttendanceController@import_user_check') }}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="list-site col-12 mx-auto">
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($import_users as $import_user)
                                <li class="list-group-item">
                                    <div class="form-row">
                                        <div class="col">
                                            <label>名前</label>
                                            <input type="text" class="form-control" name="user[][name]" autocomplete="off" value="{{ $import_user->name }}">
                                        </div>
                                        <div class="col">
                                            <label>メールアドレス</label>
                                            <input type="text" class="form-control" name="user[][email]" autocomplete="off" value="{{ $import_user->email }}">
                                        </div> 
                                        <div class="col">
                                            <label>パスワード</label>
                                            <input type="text" class="form-control" name="user[][password]" autocomplete="off" value="{{ $import_user->password }}">
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                         </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection