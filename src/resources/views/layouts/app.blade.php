<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>mogitate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <link rel="stylesheet" href="{{ asset('css/products.css')}}">
  @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <h1 class="header__inner" href="{{ asset('/products.blade.php')}}">mogitate</h1>
            @yield('link')
        </header>
        <div class="fruit">
        
        </div>
        <main>
        @yield('content')
        </main>

    </div>
    @yield('scripts')
</body>

</html>