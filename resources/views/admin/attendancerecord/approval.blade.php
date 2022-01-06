@extends('layouts.admin')

@section('title','勤務記録一覧')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>勤務記録承認</h2>
                <form action="{{ action('Admin\AttendanceController@update_attendancerecord') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-4">日付</label>
                        <div class="col-8">
                            <p>a</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">名前</label>
                        <div class="col-8">
                            <select class="form-control" name="user">
                                <option hidden>選択してください</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach($users as $user)
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">現場名</label>
                        <div class="col-8">
                            <select class="form-control" name="site">
                                <option hidden>選択してください</option>
                                @foreach($sites as $site)
                                    <option value="{{ $site->name }}">{{ $site->name }}</option>
                                @endforeach($sites as $site)
                            </select>
                        </div>
                        
                        
                    </div>
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-4">ハウスメーカー</label>-->
                    <!--    <div class="col-8">-->
                    <!--        <select class="form-control" name="housemaker">-->
                    <!--            <option hidden>選択してください</option>-->
                    <!--            @foreach($housemakers as $housemaker)-->
                    <!--                <option value="{{$housemaker->name }}">{{ $housemaker->name }}</option>-->
                    <!--            @endforeach($housemakers as $housemaker)-->
                    <!--        </select>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="form-group row">
                        <label class="col-4"></label>
                        <div class="col-8">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="work_time" value=8 autocomplete="off" checked>１日
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="work_time" value=4 autocomplete="off">半日
                                </label>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="登録">
                    </div>
                </form>
            </div>
                
                
        </div>
    </div>
@endsection