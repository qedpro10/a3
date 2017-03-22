<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Pig Latin Translator')
    </title>

    <meta charset='utf-8'>
    <link href="/css/piglatin.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header>
        <img
        src='https://i.ytimg.com/vi/Ikw5HhxC5UM/hqdefault.jpg'
        style='width:300px'
        alt='Pig Latin Logo'>
    </header>

    <section>
        @yield('content')
    </section>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
