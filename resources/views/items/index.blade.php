@extends('layouts.index')
@section('title', 'アイテム一覧')

@section('content')
    <div class="container">
        <div class="row">
            <nav>
                <ol class="breadcrumbs breadcrumbs-user-in">
                    <li><a href="/"><i class="fas fa-home"></i>top</a></li>
                    <li>アイテム一覧</li>
                </ol>
            </nav>
        </div>
        <div class="row side-navigation">
            <div class="side-user">
                <div class="search-link">
                    <p class="link-title">検索</p>
                </div>
                <form action="{{ action('ItemsController@index') }}" method="get">
                    <div class="form-group row">
                        <!--<label class="col-md-2">名前</label>-->
                        <div class="col-md-8">
                            <input type="text" placeholder="アイテム名で探す"class="form-control" name="cond_title" value="{{ $cond_title }}">
                        </div>
                        <div class="col-md-2">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="検索">
                        </div>
                    </div>
                </form>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="items-main-user-index">
                @foreach($items as $item)
                    <div class="post">
                        <section class="card-main-user-index">
                            <div class="item_user-image image">
                                @if (isset($item->item_image))
                                        <img class="card-img-user-index" src="{{ asset('storage/image/' . $item->item_image) }}" alt="アイテム画像">
                                @endif
                            </div>
                            <div class="card-item-content">
                                <div class="item-name">
                                    <div>
                                        {{ str_limit($item->item_name, 150) }}
                                    </div>
                                </div>
                                <div class="item-shop-name">
                                    <a target="_blank" href="{{ $item->shop }}" class="btn btn-blue-user-index"><i class="fas fa-shopping-basket fa-position-left"></i>ショップはこちら</a>
                                </div>
                            </div>
                        </section>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $items->links() }}
    </div>
@endsection