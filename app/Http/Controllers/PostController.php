<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;//Postモデルを使うために追加
use Illuminate\Support\Facades\DB;//DBクラスを使うために追加
use Illuminate\Support\Facades\Storage;//画像を保存するために追加

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return view('posts.index');
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
    public function store(StorePostRequest $request)//StorePostRequestを使うように変更
    {
        $post = new Post($request->all());//fillableを使っているので、$request->all()で代入しても大丈夫
        $post->user_id = $request->user()->id;//ログインしているユーザーのidを代入

        $file = $request->file('image');//アップロードされた画像を取得
        $post->image = date('YmdHis') . '_' . $file->getClientOriginalName();//ファイル名を変更して代入//例：20210701123456_hogehoge.jpg
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
