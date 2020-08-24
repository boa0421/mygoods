@extends('layouts.admin')
@section('title', '登録済みPostの一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Post詳細</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!--<a href="{{ action('Admin\PostsController@add') }}" role="button" class="btn btn-primary">新規作成</a>-->
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">タイトル</th>
                                <th width="30%">本文</th>
                                <th width="20%">アイテム</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{ $post->id }}</th>
                                <td>{{ \Str::limit($post->title, 100) }}</td>
                                <td>{{ \Str::limit($post->content, 250) }}</td>
                                <td>{{ \Str::limit($post->item_name, 100) }}</td>
                                <td>
                                    <div>
                                        <a href="{{ action('Admin\PostsController@edit', ['id' => $post->id]) }}">編集</a>
                                    </div>
                                    <div>
                                        <a href="{{ action('Admin\PostsController@delete', ['id' => $post->id]) }}">削除</a>
                                    </div>
                                    <div>
                                        <a href="{{ action('Admin\ItemsController@add', ['post_id' => $post->id]) }}">アイテム追加</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
