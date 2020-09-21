@extends('layouts.admin')
@section('title', 'プロフィールの作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Admin\UsersController@profile_create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">ニックネーム</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nickname" value="{{ old('nickname') ?? $user->nickname }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">趣味</label>
                        <div class="col-md-10">
                            <!--<input type="text" class="form-control" name="hobby" value="{{ old('hobby') ?? $user->hobby }}">-->
                            <!--<dt>好きなもの</dt>-->
                            <input type="checkbox" name="interest" value="Books">Books
                            <input type="checkbox" name="interest" value="Sports">Sports
                            <input type="checkbox" name="interest" value="Beauty">Beauty
                            <input type="checkbox" name="interest" value="Home">Home
                            <input type="checkbox" name="interest" value="Fashion">Fashion
                            <input type="checkbox" name="interest" value="Cooking">Cooking
                            <input type="checkbox" name="interest" value="Pets">Pets
                            <input type="checkbox" name="interest" value="Business">Business
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="profile" rows="10">{{ old('profile') ?? $user->profile }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="profile_image">
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{ $user->id }}" >
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection