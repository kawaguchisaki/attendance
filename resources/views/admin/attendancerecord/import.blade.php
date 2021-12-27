@extends('layouts.admin')

@section('title','従業員登録(CSV)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>CSVから従業員登録</h2>
                <form action="{{ action('Admin\AttendanceController@import') }}" method="post" enctype="multipart/form-data">
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
                            <input type="file" class="form-control-file" name="name" autocomplete=off value="{{ old('name') }}">
                        </div>
                    </div>
                    
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="アップロード">
                </form>
            </div>
        </div>
    </div>
@endsection