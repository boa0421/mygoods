@extends('layouts.about')
@section('title', 'はじめての方へ')

@section('content')

    <div class="container">
        {{-- パンくずリスト --}}
        <div class="row">
            <nav>
                <ol class="breadcrumbs">
                    <li><a href="/"><i class="fas fa-home"></i>top</a></li>
                    <li>はじめての方へ</li>
                </ol>
            </nav>
        </div>
        {{-- このサービスの説明 --}}
        <div class="row">
            <section class="about-contents">
                <img class="side-image col-lg-6" src="public/image/top.jpg" alt="トップページの画像" title="トップページの画像">
                <div class="main-side">
                    <h2>みんなのおすすめ商品をチェック</h2>
                    <p>気になるものがあるけれど買おうかどうか悩んでいる。</p>
                    <p>ショッピングで失敗したくない！使っている人の口コミが知りたい！</p>
                    <p>そんなあなたのために、MyGoodsではみんなのおすすめ商品を紹介しています。</p>
                    <p><a href="/">トップページをみる</a></p>
                </div>
            </section>
            <section class="about-contents">
                <img class="side-image col-lg-6" src="/image/show.jpg" alt="投稿詳細ページの画像" title="投稿詳細ページの画像">
                <div class="main-side">
                    <h2>アカウントを作ってログインしよう</h2>
                    <p>ログインすると、あなたのお気に入りを投稿したり、いいねしたり、コメントをしたり、気になるユーザーをフォローしたりすることができます。</p>
                    <p>投稿した写真には、タグやアイテムを追加することができます。</p>
                    <p><a href="register">新規アカウント作成</a></p>
                </div>
            </section>
            <section class="about-contents">
                <img class="side-image col-lg-6" src="image/users.jpg" alt="ユーザー一覧の画像" title="ユーザー一覧の画像">
                <div class="main-side">
                    <h2>お気に入りのユーザーを見つける</h2>
                    <p>ユーザー一覧ページから気になるユーザーを見つけることができます。</p>
                    <p>アカウントを作成してログインすれば、お気に入りのユーザーをフォローすることができます。</p>
                    <p><a href="{{ action('UsersController@index' ) }}">ユーザー一覧ページをみる</a></p>
                </div>
            </section>
            <section class="about-contents">
                <!--<img class="side-image col-lg-6" src="{{ asset('storage/image/item.jpg') }}" alt="アイテム一覧ページの画像" title="アイテム一覧ページの画像">-->
                <h2 class="logo-img"></h2>
                <div class="main-side">
                    <h2>気になるアイテムを見つける</h2>
                    <p>投稿に関連したアイテムは店舗URLやECサイトに直接アクセスできます。</p>
                    <p>アカウントを作成してログインすれば、お気に入りのアイテムを紹介することができます。</p>
                    <p><a href="{{ action('ItemsController@index' ) }}">アイテム一覧ページをみる</a></p>
                </div>
            </section>
        </div>
    </div>
@endsection


