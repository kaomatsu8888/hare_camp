<x-app-layout><!--x-app-layoutはresources/vieesフォルダのapp-layout.blade.phpファイルを指定している-->
    <x-slot name="header"><!-- resources/vieesフォルダのapp-layout.blade.phpファイルのheaderセクションを指定している-->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts.index') }} <!-- resources/vieesフォルダのpostsフォルダのindex.blade.phpファイルを指定している-->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    記事の一覧画面です！<!-- ページに出力する文字列 -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
