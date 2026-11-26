<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda | SmilePro</title>
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
                <a href="{{ route('agenda.index') }}" aria-current="page">Agenda</a>
                <a href="{{ route('patienten.index') }}">Patiënten</a>
                <a href="{{ url('/behandelingen') }}">Behandelingen</a>
            </nav>
        </aside>

        @php
            $gekozenDag = \Carbon\CarbonImmutable::parse($datum)->locale('nl');
            $weekStart = $gekozenDag->startOfWeek(\Carbon\CarbonImmutable::MONDAY);
        @endphp

        <main class="dashboard">
            <header class="dashboard-header">
                <h1>Agenda overzicht</h1>
            </header>

            <section class="agenda-paneel" aria-label="Datum kiezen">
                <div class="agenda-werkbalk">
                    <nav class="agenda-weekknoppen" aria-label="Weeknavigatie">
                        <a href="{{ route('agenda.index', ['datum' => $gekozenDag->subWeek()->toDateString()]) }}"
                            aria-label="Vorige week">←</a>
                        <a href="{{ route('agenda.index') }}">Vandaag</a>
                        <a href="{{ route('agenda.index', ['datum' => $gekozenDag->addWeek()->toDateString()]) }}"
                            aria-label="Volgende week">→</a>
                    </nav>

                    <form class="agenda-datumformulier" method="GET" action="{{ route('agenda.index') }}">
                        <label for="datum">Kies een datum</label>
                        <input type="date" id="datum" name="datum" value="{{ $datum }}" required>
                        <button type="submit">Tonen</button>
                    </form>
                </div>

                <nav class="agenda-week" aria-label="Dagen van de week">
                    @for ($i = 0; $i < 7; $i++)
                        @php
                            $dag = $weekStart->addDays($i);
                            $dagDatum = $dag->toDateString();
                        @endphp
                        <a href="{{ route('agenda.index', ['datum' => $dagDatum]) }}"
                            aria-label="{{ $dag->translatedFormat('l j F Y') }}" @if ($dagDatum === $datum)
                            aria-current="date" @endif>
                            <span>{{ $dag->translatedFormat('D') }}</span>
                            <strong>{{ $dag->format('j') }}</strong>
                        </a>
                    @endfor
                </nav>
            </section>

            <section class="agenda-paneel agenda-dag" aria-labelledby="agenda-dagtitel">
                <h2 id="agenda-dagtitel">{{ ucfirst($gekozenDag->translatedFormat('l j F Y')) }}</h2>

                @if ($afspraken->isEmpty())
                    <p class="agenda-leeg">Er zijn geen afspraken ingepland voor deze datum.</p>
                @else
                    <ol class="agenda-tijdlijn">
                        @foreach ($afspraken as $afspraak)
                            @php
                                $begintijd = \Illuminate\Support\Carbon::parse($afspraak->StartDatumTijd);
                            @endphp
                            <li>
                                <time datetime="{{ $begintijd->format('H:i') }}">
                                    {{ $begintijd->format('H:i') }}
                                </time>
                                <div class="agenda-afspraak">
                                    <strong>{{ $afspraak->Behandeling }}</strong>
                                    <span>{{ $afspraak->Voornaam }} {{ $afspraak->Achternaam }}</span>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                @endif
            </section>
        </main>
    </div>
    @if ($afspraken->isEmpty())
        <dialog id="agenda-melding" class="patienten-dialog" aria-labelledby="agenda-melding-titel">
            <h2 id="agenda-melding-titel">Agenda overzicht</h2>
            <p>Er zijn geen afspraken ingepland voor deze datum.</p>

            <form method="dialog">
                <button type="submit" autofocus>Sluiten</button>
            </form>
        </dialog>

        <script>
            const agendaMelding = document.getElementById('agenda-melding');

            agendaMelding.showModal();

            setTimeout(() => {
                if (agendaMelding.open) {
                    agendaMelding.close();
                }
            }, 3000);
        </script>
    @endif
</body>

</html>