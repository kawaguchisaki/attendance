@extends('layouts.user')

@section('title','現場一覧')

@section('content')
    <div class="container">
        <h2>現場一覧</h2>
        <div class="row">
            <div class="list-site col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-striped col-auto">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">現場名</th>
                                <th scope="col">ハウスメーカー</th>
                                <th scope="col">応援</th>
                                <th scope="col">担当者</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sites as $site)
                                <tr>
                                    <td>{{ $site->id }}</td>
                                    <td>{{ $site->name }}</td>
                                    <td>{{ $site->house_maker->name }}</td>
                                    <td>{{ $site->house_maker->get_help }}</td>
                                    <td>a</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection