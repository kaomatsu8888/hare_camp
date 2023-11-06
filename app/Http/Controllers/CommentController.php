<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;//Postモデルを追加

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(post $post)//postを引数に追加
    {
        return view('comments.create', compact('post'));//postをviewに渡す
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Post $post)//postを引数に追加
    {
        $comment = new Comment($request->all());//Commentモデルのインスタンスを作成し、$request->all()でリクエストの全データを取得
        $comment->user_id = $request->user()->id;//

        try {// トランザクション開始
            // 登録
            $post->comments()->save($comment);//$post->comments()でリレーションを取得し、saveメソッドで保存
        } catch (\Exception $e) {// 例外発生時
            return back()->withInput()->withErrors($e->getMessage());//エラーを返す
        }

        return redirect()//リダイレクト
            ->route('posts.show', $post)//posts.showにリダイレクト
            ->with('notice', 'コメントを登録しました');//フラッシュメッセージを追加
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
