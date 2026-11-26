<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmilePro | Tijdelijk niet beschikbaar</title>

    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body class="foutpagina">

    <main class="foutkaart" role="alert">

        <div class="fouticoon">!</div>

        <h1>SmilePro</h1>

        <h2>De website is momenteel niet beschikbaar.</h2>

        <p>Probeer het later opnieuw.</p>

        <a href="{{ route('home') }}" class="btn btn-primary">
            Opnieuw proberen
        </a>

    </main>

</body>

</html>
