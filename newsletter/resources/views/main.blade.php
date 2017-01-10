<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link rel="stylesheet" href="{{ elixir('css/styles.css') }}" />
        <script src="{{ elixir('js/scripts.js') }}"></script>
    </head>
    <body>

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>