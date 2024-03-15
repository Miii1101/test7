<!-- 新規登録画面 -->
@extends('layouts.app')

@section('content')
    <div class="add_product">
        <h1>商品新規登録画面</h1>
    
        <form action="{{ route('regist.article') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- 商品名や価格、在庫数などのフォーム要素を追加 -->
            <div class="form-group">
                <label for="product_name">商品名*</label>
                <input  class="form-control" id="name" name="name" placeholder="NAME" value="{{ old('name') }}">
                @if($errors->has('name'))
                    <p>{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="form-group">
            <select name="company" class="form-select">
                    <option>メーカー名*</otion>
                    @foreach ($companies as $company)
                        <option value="{{ $company->str }}">{{ $company->str }}</otion>
                    @endforeach
                </select>

            <div class="form-group">
                <label for="price">価格*</label>
                <input  class="form-control" id="price" name="price" placeholder="PRICE" value="{{ old('price') }}">
                @if($errors->has('price'))
                    <p>{{ $errors->first('price') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="stock">在庫数*</label>
                <input  class="form-control" id="stock" name="stock" placeholder="STOCK" value="{{ old('stock') }}">
                @if($errors->has('stock'))
                    <p>{{ $errors->first('stock') }}</p>
                @endif
            </div>

            <div class="form-group">
                <label for="detial">コメント</label>
                <textarea class="form-control" id="detail" name="detail" placeholder="DETAIL">{{ old('detail') }}</textarea>
                @if($errors->has('detail'))
                    <p>{{ $errors->first('detail') }}</p>
                @endif
            </div>

            <label for="productImage">商品画像</label>
            <input type="file" name="fileInput" enctype="multipart/form-data">

            
            <button type="submit" class="touroku_btn">新規登録</button>
        </form>
        
        <form action="{{ route('article.search') }}" method="get">
            @csrf
            <button type="submit" class="back_btn">戻る</button>
        </form>

    </div>

@endsection