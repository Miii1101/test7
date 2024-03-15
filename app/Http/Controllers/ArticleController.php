<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Manufacturer;

class ArticleController extends Controller
{
    // 検索画面表示
    public function index()
    {
        $articles = Article::all();
        return view('index', compact('articles'));
    }

    // 検索処理
    public function get(Request $request)
    {
        $key = $request->input('key');
        $selectedCompany = $request->input('companies');
    
        $articles = Article::where(function($queryBuilder) use ($key, $selectedCompany) {
            // 検索キーワードが入力されている場合の条件
            if ($key) {
                $queryBuilder->where(function($nestedQueryBuilder) use ($key) {
                    $nestedQueryBuilder->where('name', 'like', '%' . $key . '%')
                                      ->orWhere('price', 'like', '%' . $key . '%')
                                      ->orWhere('stock', 'like', '%' . $key . '%');
                });
            }
            // メーカー名の選択に基づいて条件を追加
            if ($selectedCompany) {
                $queryBuilder->orWhere('company', 'like', '%' . $selectedCompany . '%');
            }
        })->get();
    
        return view('index', [
            'articles' => $articles,
            'selectedCompany' => $selectedCompany,
        ]);
    }

    // 削除処理
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('article.index')
        ->with('success',$article->name.'を削除しました');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //新規登録画面でメーカー名を選択
    public function showRegistForm()
    {
        $manufacturers = Manufacturer::all();
        return view('create')
        ->with('companies',$manufacturers);
    }

    // 商品追加
    public function store(ArticleRequest $request)
    {
        // フォームリクエストでバリデーションされたデータを取得
        $validatedData = $request->validated();
        // バリデーションされたデータを使って新しい商品を作成し保存する
        Article::create($validatedData);
        // 商品一覧画面にリダイレクトする
        return redirect()->route('article.index')->with('success', '商品を追加しました');
    }

    // 商品登録処理
    public function registArticle(ArticleRequest $request) 
    {
        // トランザクションを開始
        DB::beginTransaction();
        try {
            // リクエストからデータを取得
            $data = $request->only(['name', 'price', 'stock', 'company', 'detail']);
            // ファイルを取得
            $file = $request->file('fileInput');
            // 新しい記事を作成
            $article = Article::create($data);
            // コミット
            DB::commit();
            // 処理が完了したら検索ページにリダイレクト
            return redirect(route('article.search'))->with('success', '記事が正常に登録されました');
        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollback();
            return back()->with('error', '記事の登録に失敗しました: ' . $e->getMessage());
        }
    }

    // 詳細画面表示
    public function showArticleDetail($id)
    {
        $article = Article::findOrFail($id);
        return view('detail', ['article' => $article]);
    }
    
    // 編集画面表示
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $manufacturers = Manufacturer::all();
        return view('edit',compact('article','manufacturers'))
        ->with('companies',$manufacturers);
    }
    
    // 更新処理
    public function update(ArticleRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            // 既存の商品を取得
            $article = Article::findOrFail($id);
            // 商品を更新
            $article->update($request->all());
            // トランザクションをコミットする
            DB::commit();
            //リダイレクト
            return redirect(route('article.search'));
        
        } catch (\Exception $e) {
            // トランザクションをロールバックしてエラーメッセージを含めてリダイレクト
            DB::rollback();
            return back()->with('error', '商品の更新中にエラーが発生しました: ' . $e->getMessage());
            }
    }

}

