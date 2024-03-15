@extends('layouts.app')

@section('content')

<div class="commodity_edit">
    <h1>商品情報編集画面</h1>

    <form action="{{ route('article.update', $article->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <p>ID: {{ $article->id }}</p>
        </div>

        <div class="form-group">
            <label for="product_name">商品名*</label>
            <input class="form-control" id="name" name="name" placeholder="NAME" value="{{ $article->name }}">
            @if($errors->has('name'))
                <p>{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="company">メーカー名*</label>
            <select name="company" class="form-select">
                <option value="">選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->str }}"@if($company->id==$article->company) selected @endif>{{ $company->str }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">価格*</label>
            <input class="form-control" id="price" name="price" placeholder="PRICE" value="{{ $article->price }}">
            @if($errors->has('price'))
                <p>{{ $errors->first('price') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="stock">在庫数*</label>
            <input class="form-control" id="stock" name="stock" placeholder="STOCK" value="{{ $article->stock }}">
            @if($errors->has('stock'))
                <p>{{ $errors->first('stock') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="detial">コメント</label>
            <textarea class="form-control" id="detail" name="detail" placeholder="DETAIL">{{ $article->detail }}</textarea>
            @if($errors->has('detail'))
                <p>{{ $errors->first('detail') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="productImage">商品画像</label>
            <input type="file" name="fileInput">
        </div>

        <button type="submit" class="update_btn">更新</button>
    </form>
    <form action="{{ route('article.index') }}" method="get">
            @csrf
            <button type="submit" class="back_btn">戻る</button>
        </form>
</div>

@endsection