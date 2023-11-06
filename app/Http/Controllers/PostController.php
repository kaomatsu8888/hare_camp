<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post; //Postモデルを使うために追加
use Illuminate\Support\Facades\DB; //DBクラスを使うために追加
use Illuminate\Support\Facades\Storage; //画像を保存するために追加

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()//記事一覧を表示する
    {
        $posts = Post::with('user')->latest()->paginate(4);//記事を新しい順に取得するように変更。ページネーションを追加。with('user')を追加

        return view('posts.index', compact('posts'));//取得した記事をビューに渡す
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request) //StorePostRequestを使うように変更
    {
        $post = new Post($request->all()); //fillableを使っているので、$request->all()で代入しても大丈夫
        $post->user_id = $request->user()->id; //ログインしているユーザーのidを代入

        $file = $request->file('image'); //アップロードされた画像を取得
        $post->image = self::createFileName($file); //ファイル名を変更して代入//例：20210701123456_hogehoge.jpg

        // トランザクション開始
        DB::beginTransaction();
        try { // 保存
            // 登録
            $post->save(); // 画像アップロード

            // 画像アップロード
            if (!Storage::putFileAs('images/posts', $file, $post->image)) { // 第一引数に保存先のディレクトリ、第二引数にアップロードするファイル、第三引数にファイル名を指定
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの保存に失敗しました。'); //
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback(); //
            return back()->withInput()->withErrors($e->getMessage()); // エラーメッセージをセッションに入れてリダイレクト
        }

        return redirect()
            ->route('posts.show', $post) //登録した記事の詳細ページにリダイレクト
            ->with('notice', '記事を登録しました'); //フラッシュメッセージをセッションに入れてリダイレクト
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)//記事の詳細を表示する
    {
        $post = Post::with(['user'])->find($id);//記事を取得するように変更。with('user')を追加
        $comments = $post->comments()->latest()->get()->load(['user']);//コメントを新しい順に取得するように変更。with('user')を追加

        return view('posts.show', compact('post', 'comments'));//取得した記事とコメントをビューに渡す
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id); //編集する記事を取得

        return view('posts.edit', compact('post')); //取得した記事をビューに渡す
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $post = Post::find($id);

        if ($request->user()->cannot('update', $post)) {
            return redirect()->route('posts.show', $post)
                ->withErrors('自分の記事以外は更新できません');
        }

        $file = $request->file('image');
        if ($file) {
            $delete_file_path = 'images/posts/' . $post->image; //削除するファイルのパスを作成
            $post->image = self::createFileName($file); //ファイル名を作成。リファクタリング
        }
        $post->fill($request->all());

        // トランザクション開始
        DB::beginTransaction();
        try {
            // 更新
            $post->save();

            if ($file) {
                // 画像アップロード
                if (!Storage::putFileAs('images/posts', $file, $post->image)) {
                    // 例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの保存に失敗しました。');
                }

                // 画像削除
                if (!Storage::delete($delete_file_path)) {
                    //アップロードした画像を削除する
                    Storage::delete($post->image_path);//アクセサ
                    //例外を投げてロールバックさせる
                    throw new \Exception('画像ファイルの削除に失敗しました。');
                }
            }

            // トランザクション終了(成功)
            DB::commit();
        } catch (\Exception $e) {
            // トランザクション終了(失敗)
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        return redirect()->route('posts.show', $post)
            ->with('notice', '記事を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)//記事を削除する
    {
        //
        $post = Post::find($id);//削除する記事を取得

        // トランザクション開始
        DB::beginTransaction();//トランザクションを開始
        try {//削除
            $post->delete();

            // 画像削除
            if (!Storage::delete($post->image_path)) {//アップロードした画像を削除する。アクセサ
                // 例外を投げてロールバックさせる
                throw new \Exception('画像ファイルの削除に失敗しました。');
            }

            // トランザクション終了(成功)
            DB::commit();//トランザクションをコミット
        } catch (\Exception $e) {//例外が発生した場合
            // トランザクション終了(失敗)
            DB::rollback();//トランザクションをロールバック
            return back()->withErrors($e->getMessage());//エラーメッセージをセッションに入れてリダイレクト
        }

        return redirect()->route('posts.index')//記事一覧ページにリダイレクト
            ->with('notice', '記事を削除しました');//フラッシュメッセージをセッションに入れてリダイレクト
    }
    private static function createFileName($file) //リファクタリング
    {
        return date('YmdHis') . '_' . $file->getClientOriginalName(); //例：20210701123456_hogehoge.jpg


    }
}
