@extends('layouts.user')

@section('title','勤務記録編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>勤務記録編集</h2>
                <form action="{{ action('AttendanceController@update_attendancerecord') }}" method="post" enctype="multipart/form-data">
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
                            <input type="date" class="form-control" name="date" autocomplete="off" value="{{ $attendance->date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">名前</label>
                        <div class="col-8">
                            <select class="form-control" name="user">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                    @if($user->id == $thisUser->id) selected @endif>
                                    {{ $user->name }}</option>
                                @endforeach($users as $user)
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">現場名</label>
                        <div class="col-8">
                            <select class="form-control" name="site">
                                
                                @foreach($sites as $site)
                                    <option value="{{ $site->id }}"
                                    @if($site->id == $thisSite->id) selected @endif>
                                    {{ $site->name }}</option>
                                @endforeach($sites as $site)
                            </select>
                        </div>
                        
                        
                    </div>
                    <div class="form-group row">
                        <label class="col-4"></label>
                        <div class="col-8">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="work_time" value=8 {{ $attendance->work_time == 8 ? 'checked' : '' }}>１日
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="work_time" value=4 {{ $attendance->work_time == 4 ? 'checked' : '' }}>半日
                                </label>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $attendance->id }}">
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="登録">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection