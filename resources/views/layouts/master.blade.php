<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="description" content="Star Trek Trivia Game">
    <meta name="author" content="Jen Smith">
    <title>
        @yield('title', 'Star Trekivia')
    </title>

    <link rel="icon" type="images/png" href="images/favicon.ico">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
    <link href="/css/trivia.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header class="mainlogo">
        <div id="top">
            <div class="banner">
                <img src=@yield('picture','images/st_tng.jpg') style='width:250px' alt="ST_Logo">
            </div>
            <div class="banner">
                <h1>Star Trekivia</h1>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
                <section class="mainpage">
                    @yield('content')
                </section>

                <section>
                    @yield('quiz')
                </section>

        </div>
    </div>

    <footer class="foot">
        <p>Jen Tiberius Smith &copy; {{ date('Y') }}</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
