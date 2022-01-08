@extends('layouts.admin')

@section('title','現場情報編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>現場情報編集</h2>
                <form action="{{ action('Admin\AttendanceController@update_site') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-4">現場名</label>
                        <div class="col-8">
                                <input type="text" class="form-control" name="site_name" autocomplete=off value="{{ $site->name }}" style="text-align:right">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">ハウスメーカー</label>
                        <div class="col-8">
                            <input type="text" name='housemaker_name' list='saved-housemaker-name' value="{{ $site->house_maker->name }}" autocomplete="off">
                                <datalist id='saved-housemaker-name'>
                                    @foreach($housemakers as $housemaker)
                                        <option value={{$housemaker->name}}>
                                    @endforeach($housemakers as $housemaker)
                                </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">応援</label>
                        <div class="col-8">
                            <input type="checkbox" class="form-check-input" name="get_help" value="true"> <!--true:応援、false:通常-->
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="編集">
                </form>
            </div>
        </div>
    </div>

@endsection