<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">

                    @if (session('flash_message'))
                    <div class="flash_message alert alert-success alert-block">
                        {!! session('flash_message') !!}
                    </div>
                    @endif

                    <div class="card">
                        <h5 class="card-body">記事投稿</h5>
                        <div class="card-body">
                            <form method="POST" action="{{ route('post.send') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="select">公開範囲選択</label>
                                    <select name="private" id="select" class="form-control">
                                        <option value="private">限定公開</option>
                                        <option value="public">一般公開</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tag">タグ</label>
                                    <input type="text" id="tag" class="form-control" name="tag">
                                </div>
                                <div class="form-group">
                                    <label for="title">タイトル</label>
                                    <input type="text" id="title" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label for="textarea">本文</label>
                                    <textarea id="textarea" class="form-control" name="body"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">投稿</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
