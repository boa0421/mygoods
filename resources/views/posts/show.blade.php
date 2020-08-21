@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                        <img src="{{ asset('storage/image/' . $post->image) }}">
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($post->title, 70) }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="body mx-auto">{{ str_limit($post->contents, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection