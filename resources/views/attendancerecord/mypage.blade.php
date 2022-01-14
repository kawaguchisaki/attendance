@extends('layouts.admin')

@section('title','マイページ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto">
            <h2>マイページ</h2>
                <div class="form-group row">
                    <label class="col-4">名前</label>
                    <div class="col-8">
                        <p>{{ $user->name }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">メールアドレス</label>
                    <div class="col-8">
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-4">パスワード</label>
                    <div class="col-8">
                        <p>表示できません。</p>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col text-right">
                        <a href="{{ route('edit_user') }}" role="button" class="btn btn-secondary">編集</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection