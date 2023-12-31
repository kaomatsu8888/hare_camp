<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">
        {{-- <!-- フラッシュメッセージの表示。リファクタリングのため削除 -->
        @if (session('notice'))
            <div class="bg-blue-100 border-blue-500 text-blue-700 border-l-4 p-4 my-2">
                {{ session('notice') }}
            </div>
        @endif --}}
        <x-flash-message :message="session('notice')" /><!-- フラッシュメッセージの表示。リファクタリング -->
        <x-validation-errors :errors="$errors" /><!-- エラー表示 -->

        <!-- バリデーションエラーの表示に使用 -->
        <article class="mb-2">
            <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words">{{ $post->title }}</h2>
            <h3>{{ $post->user->name }}</h3>
            <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                <span class="text-red-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $post->created_at ? 'NEW' : '' }}</span>
                {{ $post->created_at }}
            </p>
            <img src="{{ $post->image_url }}" alt="" class="mb-4"><!-- 画像を表示する。アクセサを使用する -->


            <!-- 本文を表示する。改行を反映させるためにnl2brを使用する。 -->
            <p class="text-gray-700 text-base">{!! nl2br(e($post->body)) !!}</p>
        </article>
        <div class="flex flex-row text-center my-4">
            @can('update', $post)<!-- ポリシーのupdateメソッドを呼び出す -->
                <a href="{{ route('posts.edit', $post) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
            @endcan
            @can('delete', $post){{-- ポリシーのdeleteメソッドを呼び出す --}}
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
                </form>
            @endcan
        </div>
        @auth{{-- ログインしている場合のみ表示 --}}
            <hr class="my-4">
            <div class="flex justify-end">
                <a href="{{ route('posts.comments.create', $post) }}" class="bg-indigo-400 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline block">コメント登録</a>
            </div>
        @endauth
        <section class="font-sans break-normal text-gray-900 ">
            @foreach ($comments as $comment){{--  コメントを表示する  --}}
                <div class="my-2">
                    <span class="font-bold mr-3">{{ $comment->user->name }}</span>{{--  コメントしたユーザー名を表示する  --}}
                    <span class="text-sm">{{ $comment->created_at }}</span>{{--  コメントした日時を表示する  --}}
                    <p class="break-all">{!! nl2br(e($comment->body)) !!}</p>{{--  コメントを表示する。改行を反映させるためにnl2brを使用する  --}}
                    {{-- コメントの編集・削除ボタンを表示する  --}}
                    <div class="flex justify-end text-center">
                        @can('update', $comment){{-- ポリシーのupdateメソッドを呼び出す --}}
                            <a href="{{ route('posts.comments.edit', [$post, $comment]) }}"{{-- コメントの編集画面へのリンク --}}
                                class="text-sm bg-green-400 hover:bg-green-600 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline w-20 mr-2">編集</a>
                        @endcan
                        @can('delete', $comment){{-- ポリシーのdeleteメソッドを呼び出す --}}
                            <form action="{{ route('posts.comments.destroy', [$post, $comment]) }}" method="post">{{--  コメントの削除フォーム  --}}
                                @csrf
                                @method('DELETE'){{-- DELETEメソッドを指定する  --}}
                                <input type="submit" value="削除" onclick="if(!confirm('削除しますか？')){return false};"{{-- 削除ボタン  --}}
                                    class="text-sm bg-red-400 hover:bg-red-600 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline w-20">
                            </form>
                        @endcan
                    </div>
                </div>
                <hr>
            @endforeach
        </section>



    </div>
</x-app-layout>
