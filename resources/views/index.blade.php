<!-- 商品一覧画面 -->

@extends('layouts.app')

@section('content')

<div class="commodity_list">
    <h1>商品一覧画面</h1>

    <div class="search_form">
        <form action="{{ route('article.search') }}" method="get">
            <input type="text" name="key" placeholder="検索キーワード">

            <select name="companies">
                <option value="">メーカーを選択</option>
                <option value="コカ・コーラ">コカ・コーラ</option>
                <option value="えひめ飲料">えひめ飲料</option>
                <option value="サントリー">サントリー</option>
                <option value="アサヒ">アサヒ</option>
                <option value="キリン">キリン</option>
                <option value="サッポロ">サッポロ</option>
            </select>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
    
    <form action="{{ route('article.create') }}" method="get">
    @csrf
    <button type="submit" class="btn btn-success">新規登録</button>
    </form>

</div>

<table class="commodity-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td><img src="{{ asset($article->productImage) }}" alt="商品画像"></td>
            <td>{{ $article->name }}</td>
            <td>{{ $article->price }}円</td>
            <td>{{ $article->stock }}本</td>
            <td>{{ $article->company }}</td>
                
            <td><form action="{{ route('article.detail',$article->id) }}" method="get">
                @csrf
                <button type="submit" class="btn btn-info">詳細</button>
            </form></td>
            <td><form action="{{ route('article.destroy',$article->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick='return confirm("削除しますか？");'>削除</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection