<!DOCTYPE html>
    <x-app-layout>
        <x-slot name="header"><html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
            トップページ
        </x-slot>
        <head>
            <meta charset="utf-8">
            <title>Blog</title>
            <!-- Fonts -->
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        </head>
        <body>
            <h1>Blog Name</h1>
            <div class='posts'>
                <div class='posts'>
                    @foreach($posts as $post)
                        <h2 class='title'>{{ $post->title }}</h2>
                        <p class='body'>{{ $post->body }}</p>
                        
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                        </form>
                    @endforeach
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>
            </div>
            <a href='/posts/create'>create</a>
            <div>
                @foreach($questions as $question)
                    <div>
                        <a href="https://teratail.com/questions/{{ $question['id'] }}">
                            {{ $question['title'] }}
                        </a>
                    </div>
                @endforeach
            </div>
            <script>
                function deletePost(id) {
                    'use strict'
                    
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
        </body>
    </x-app-layout>
</html>