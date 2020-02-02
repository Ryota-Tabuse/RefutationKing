<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Scripts -->
	@if(app('env') == 'production')
	<link href="{{ secure_asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
	@else
	<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@endif
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div style="margin: 100px auto;">
                <div class="text-center">
                    <p>お探しのページは見つかりませんでした。</p>
                    <a href="{{ route('home') }}" class="btn">ホームへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>