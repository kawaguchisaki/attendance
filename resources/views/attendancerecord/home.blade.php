@extends('layouts.user')

@section('title','ホーム')

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
                                <a class="btn btn-dark btn-lg btn-block" href="{{ route('user_new_attendancerecord') }}" role="button">申請</a>
                            <a class="btn btn-secondary btn-lg btn-block" href="{{ route('user_attendancerecords') }}" role="button">一覧</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection