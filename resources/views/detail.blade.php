<!-- 商品情報詳細画面 -->

@extends('layouts.app')

@section('content')

    <div class="detail_page">
        <h1>商品情報詳細画面</h1>

        <div class="commodity_detail">
            <p>ID: {{ $article->id }}</p>
            <p>商品画像: {{ $article->productImage }}</p>
            <p>商品名: {{ $article->name }}</p>
            <p>価格: {{ $article->price }}円</p>
            <p>在庫数: {{ $article->stock }}本</p>
            <p>メーカー名: {{ $article->company }}</p>
            <p>コメント: {{ $article->detail }}</p>
        </div>

        <form action="{{ route('article.index') }}" method="get">
            @csrf
            <button type="submit" class="back_btn">戻る</button>
        </form>
        <form action="{{ route('article.edit', $article->id) }}" method="get">
                    @csrf
                    <button type="submit" class="hensyu_btn">編集</button>
        </form>
        
    </div>

@endsection