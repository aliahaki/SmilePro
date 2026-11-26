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
            <main class="dashboard">
                <header class="dashboard-header">
                    <h1>Patiënten overzicht</h1>
                </header>

                <div class="patienten-tabel">
                    <table aria-label="Geregistreerde patiënten">
                        <thead>
                            <tr>
                                <th scope="col">Voornaam</th>
                                <th scope="col">Achternaam</th>
                                <th scope="col">Geboortedatum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patienten as $patient)
                                <tr>
                                    <td>{{ $patient->Voornaam }}</td>
                                    <td>{{ $patient->Achternaam }}</td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($patient->Geboortedatum)->format('d-m-Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if ($patienten->isEmpty())
                        <p>Er zijn geen patiënten gevonden.</p>
                    @endif
                </div>
            </main>
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