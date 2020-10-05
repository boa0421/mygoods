@extends('layouts.admin')
@section('title', 'プロフィールの編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール編集</h2>
                <form action="{{ action('Admin\UsersController@update') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">名前</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('user_name',$user->name) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">メール</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="email" value="{{ old('user_email',$user->email) }}">
                        </div>
                    </div>
                    <!--<div class="form-group row">-->
                    <!--    <label class="col-md-2">パスワード</label>-->
                    <!--    <div class="col-md-10">-->
                    <!--        <input type="text" class="form-control" name="password" value="{{ $user->password }}">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <input type="hidden" name="password" value="{{ $user->password }}" >
                    <input type="hidden" name="id" value="{{ $user->id }}" >
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
@endsection