<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name="description" content="trivia game">
    <meta name="author" content="Jen Smith">
    <title>
        @yield('title', 'Trivia Master')
    </title>

    <link rel="icon" type="images/png" href="images/favicon.ico">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
    <link href="/css/trivia.css" type='text/css' rel='stylesheet'>

    @stack('head')

</head>
<body>

    <header class="mainlogo">
        <div class="banner">
            <h1>Trivia</h1>
        </div>
        <div class="banner">
            <img src='images/brain.png' style='width:100px' alt='Triviae Meretrix Logo'>
        </div>
        <div class="banner">
            <h1>Master</h1>
        </div>
    </header>

    <div class="container">
        <div class="row">

                <section class="quiz">
                    @yield('content')
                </section>
            
        </div>
    </div>

    <footer class="foot">
        <p>Jen Smith &copy; {{ date('Y') }}</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    @stack('body')

</body>
</html>
