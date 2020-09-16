@extends('layouts.posts')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($users as $user)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $user->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    <div>
                                        <a href="{{ action('UsersController@show', ['id' => $user->id]) }}">{{ str_limit($user->name, 150) }}</a>
                                    </div>
                                    
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($user->profile, 1500) }}
                                </div>
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/image/' . $user->profile_image) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection