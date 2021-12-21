@extends('layouts.admin')

@section('title','ホーム(管理者)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>ホーム</h2>
                <a class="btn btn-dark btn-lg btn-block" href="{{ route('new') }}" role="button">勤務記録登録</a>
                <a class="btn btn-dark btn-lg btn-block" href="{{ route('admin_attendancerecords') }}" role="button">勤務記録一覧</a>
            </div>
        </div>
    </div>
@endsection