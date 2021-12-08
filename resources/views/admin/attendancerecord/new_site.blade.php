@extends('layouts.admin')

@section('title','現場情報の登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
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
                        <label class="col-4">現場名(邸)</label>
                        <div class="col-8">
                                <input type="text" class="form-control" name="site_name" value="{{ old('site_name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">ハウスメーカー</label>
                        <div class="col-8">
                            <input type="text" name='housemaker_name' list='saved-housemaker-name' placeholder="入力もしくは選択" autocomplete="off">
                                <datalist id='saved-housemaker-name'>
                                    @foreach($housemakers as $housemaker)
                                        <option value={{$housemaker->name}}>
                                    @endforeach($housemakers as $housemaker)
                                </datalist>
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="get_help" value="true">応援 <!--true:応援、false:通常-->
                        </label>
                    </div>
                        
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection