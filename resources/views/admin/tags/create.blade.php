@extends('layouts.admin')
@section('title', 'Tagの新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Tag新規作成</h2>
                <form action="{{ action('Admin\TagsController@create') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タグ</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="tag_name" value="{{ old('tag_name') }}">
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post_id }}">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
            </div>
        </div>
    </div>
@endsection