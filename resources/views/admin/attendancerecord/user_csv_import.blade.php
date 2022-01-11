@extends('layouts.admin')

@section('title','CSVから従業員登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2 class="mb-5">CSVデータから従業員情報を登録</h2>
                <p>CSVファイルを選択してください。複数の従業員を一括で登録することができます。</p>
                <form action="{{ action('Admin\AttendanceController@import_user') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-4"></label>
                        <div class="col-8">
                            <input type="file" accept=".csv" class="form-control-file" name="user" autocomplete="off">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="確認">
                </form>
            </div>
        </div>
    </div>
@endsection