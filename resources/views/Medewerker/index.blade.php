<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Medewerkers | SmilePro</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="app-layout">
        <aside class="sidebar">
            <a class="brand" href="{{ url('/') }}">
                Smile<span>Pro</span>
            </a>

            <nav class="sidebar-nav" aria-label="Hoofdnavigatie">
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ url('/agenda') }}">Agenda</a>
                <a href="{{ route('patienten.index') }}">Patiënten</a>
                <a href="{{ url('/behandelingen') }}">Behandelingen</a>
                <a href="{{ route('Medewerker.index') }}" aria-current="page">Medewerker</a>
            </nav>
        </aside>

        <main class="dashboard">
            <header class="dashboard-header">
                <h1>Medewerkers overzicht</h1>
            </header>

            <div class="patienten-tabel">
                <table aria-label="Geregistreerde medewerkers">
                    <thead>
                        <tr>
                            <th scope="col">Naam</th>
                            <th scope="col">Functie</th>
                            <th scope="col">E-mailadres</th>
                            <th scope="col">Beschikbaarheid</th>
                           
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($medewerkers as $medewerker)
                            <tr>
                                <td>{{ $medewerker->Naam }}</td>
                                <td>{{ $medewerker->Functie }}</td>
                                <td>{{ $medewerker->Email }}</td>
                                <td>{{ $medewerker->Beschikbaarheid }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($medewerkers->isEmpty())
                    <p>Er zijn geen medewerkers gevonden.</p>
                @endif
            </div>
        </main>
    </div>

    @if ($medewerkers->isEmpty())
        <div class="medewerkers-toast">
            <strong>Medewerkers overzicht</strong>
            <p>Er zijn geen medewerkers gevonden.</p>
        </div>

        <dialog id="medewerkers-melding"
                class="patienten-dialog"
                aria-labelledby="melding-titel">

            <h2 id="melding-titel">Medewerkers overzicht</h2>
            <p>Er zijn geen medewerkers gevonden.</p>

            <form method="dialog">
                <button type="submit" autofocus>Sluiten</button>
            </form>
        </dialog>

        <script>
            const melding = document.getElementById('medewerkers-melding');

            melding.showModal();

            setTimeout(() => {
                if (melding.open) {
                    melding.close();
                }
            }, 3000);
        </script>
    @endif

</body>
</html>
