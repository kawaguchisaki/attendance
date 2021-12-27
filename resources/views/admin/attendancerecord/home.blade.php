@extends('layouts.admin')

@section('title','ホーム(管理者)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>ホーム</h2>
            </div>
            <div class="col-8 mx-auto">
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
    </div>
@endsection