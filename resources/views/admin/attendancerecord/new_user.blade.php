@extends('layouts.admin')

@section('title','従業員登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <h2>従業員登録</h2>
                <form action="{{ action('Admin\AttendanceController@new_user') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-4">従業員名</label>
                        <div class="col-8">
                            <p>（入力もしくはCSVからデータ取得）</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4"></label>
                        <div class="col-8">
                            <input type="text" class="form-control" name="name" autocomplete=off value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">アイコン画像</label>
                        <div class="col-8">
                            <input type="file" class="form-control-file" name="icon_path">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModalCentered">
                      確認
                    </button>
                    <div class="modal" id="confirmModalCentered" tabindex="-1" role="dialog" aria-labelledby="confirmModalCenteredLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalCenteredLabel">こちらの内容で登録しますか？</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!--ここに名前とアイコンを並べて表示-->
                                    <div class="modal-body row">
                                        <div class="col-4">名前</div>
                                        <div class="col-">アイコン</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                                    <input type="submit" class="btn btn-primary" value="登録">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection