<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | SmilePro</title>
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
                <a href="{{ route('patienten.index') }}" aria-current="page">Patiënten</a>
                <a href="{{ url('/behandelingen') }}">Behandelingen</a>
            </nav>
        </aside>

        <main class="dashboard">
            <header class="dashboard-header">
                <h1>Agenda overzicht</h1>
            </header>

            <form class="agenda-filter" method="GET" action="{{ route('agenda.index') }}">
                <label for="datum">Kies een datum</label>
                <input type="date" id="datum" name="datum" value="{{ $datum }}" required>
                <button type="submit">Toon afspraken</button>
            </form>

            <div class="patienten-tabel">
                <table aria-label="Afspraken op de gekozen datum">
                    <thead>
                        <tr>
                            <th scope="col">Begintijd</th>
                            <th scope="col">Patiënt</th>
                            <th scope="col">Behandeling</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($afspraken as $afspraak)
                            <tr>
                                <td>{{ \Illuminate\Support\Carbon::parse($afspraak->StartDatumTijd)->format('H:i') }}</td>
                                <td>{{ $afspraak->Voornaam }} {{ $afspraak->Achternaam }}</td>
                                <td>{{ $afspraak->Behandeling }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($afspraken->isEmpty())
                    <p>Er zijn geen afspraken ingepland voor deze datum.</p>
                @endif
            </div>
        </main>
    </div>
    @if ($patienten->isEmpty())
        <div class="patienten-toast">
            <strong>Patiënten overzicht</strong>
            <p>Er zijn geen patiënten gevonden.</p>
        </div>
    @endif

    @if ($patienten->isEmpty())
        <dialog id="patienten-melding" class="patienten-dialog" aria-labelledby="melding-titel">
            <h2 id="melding-titel">Patiënten overzicht</h2>
            <p>Er zijn geen patiënten gevonden.</p>

            <form method="dialog">
                <button type="submit" autofocus>Sluiten</button>
            </form>
        </dialog>

        <script>
            const melding = document.getElementById('patienten-melding');

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