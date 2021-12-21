@extends('layouts.admin')

@section('title','勤務記録登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>勤務記録登録</h2>
                <form action="{{ action('Admin\AttendanceController@new_attendancerecord') }}" method="post" enctype="multipart/form-data">
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
                            <input type="date" class="form-control" name="date" autocomplete="off" value="<?php echo date('Y-m-d');?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">名前</label>
                        <div class="col-8">
                            <!--<input type="text" name='name' list='saved-name' placeholder="選択" autocomplete="off">-->
                            <!--    <datalist id='saved-name'>-->
                            <!--        @foreach($users as $user)-->
                            <!--            <option value="{{ $user->name }}">-->
                            <!--        @endforeach($users as $user)-->
                            <!--    </datalist>-->
                            
                            <select class="form-control" name="name">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach($users as $user)
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">現場名</label>
                        <div class="col-8">
                            <input type="text" name='site' list='saved-site' placeholder="選択" autocomplete="off">
                                <datalist id='saved-site'>
                                    @foreach($sites as $site)
                                        <option value="{{$site->name }}">
                                    @endforeach($sites as $site)
                                </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">ハウスメーカー</label>
                        <div class="col-8">
                            <input type="text" name='housemaker' list='saved-housemaker' placeholder="選択" autocomplete="off">
                            <datalist id='saved-housemaker'>
                                @foreach($housemakers as $housemaker)
                                    <option value="{{$housemaker->name }}">
                                @endforeach($housemakers as $housemaker)
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4"></label>
                        <div class="col-8">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-secondary active">
                                    <input type="radio" name="takes" id="full" autocomplete="off" checked>１日
                                </label>
                                <label class="btn btn-outline-secondary">
                                    <input type="radio" name="takes" id="half" autocomplete="off">半日
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