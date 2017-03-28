<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title', 'Triviae Meretrix')
    </title>

    <meta charset='utf-8'>
    <link href="/css/trivia.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header>
        <img
        src='images/questionmark.png'
        style='width:200px'
        alt='Triviae Meretrix Logo'>
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
