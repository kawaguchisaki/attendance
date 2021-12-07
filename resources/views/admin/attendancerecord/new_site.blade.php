@extends('layouts.admin')

@section('title','現場情報の登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>現場情報の登録</h2>
                <form action="{{ action('Admin\AttendanceController@new_site') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">現場名(邸)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ハウスメーカー</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="company" value="{{ old('company') }}">
                        </div>
                    </div>
                    <!--<div class="form-check">-->
                    <!--    <label class="form-check-label">-->
                    <!--        <input type="checkbox" class="form-check-input" name="get_help" value="1">応援 //1:応援、0:通常-->
                    <!--    </label>-->
                    <!--</div>-->
                    
                    
                    
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-md-2">現場名(邸)</label>-->
                    <!--    <div class="col-md-10">-->
                    <!--        <input type="text" name='customer' list='saved-customer' placeholder="テキスト入力もしくはダブルクリック" autocomplete="off">-->
                    <!--            <datalist id='saved-customer'>-->
                    <!--                <option value='小田'>-->
                    <!--                <option value='中井'>-->
                    <!--                <option value='高山'>-->
                    <!--            </datalist>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-md-2">ハウスメーカー</label>-->
                    <!--    <div class="col-md-10">-->
                    <!--        <input type="text" name='housemaker' list='saved-housemaker' placeholder="テキスト入力もしくはダブルクリック" autocomplete="off">-->
                    <!--            <datalist id='saved-housemaker'>-->
                    <!--                <option value='株式会社あ'>-->
                    <!--                <option value='株式会社い'>-->
                    <!--                <option value='株式会社う'>-->
                    <!--            </datalist>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="form-check">-->
                    <!--    <label class="form-check-label">-->
                    <!--        <input type="checkbox" class="form-check-input" name="get_help" value="true">応援-->
                    <!--    </label>-->
                    <!--</div>-->
                    
                        
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection