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

        <main class="dashboard">
            <header class="dashboard-header">
                <h1>Agenda overzicht</h1>
            </header>

            <section class="agenda-paneel" aria-labelledby="agenda-maandtitel">
                <div class="agenda-werkbalk">
                    <nav class="agenda-weekknoppen" aria-label="Maandnavigatie">
                        <a href="{{ route('agenda.index', ['datum' => $maandStart->subMonth()->toDateString()]) }}"
                           aria-label="Vorige maand">←</a>

                        <a href="{{ route('agenda.index') }}">Vandaag</a>

                        <a href="{{ route('agenda.index', ['datum' => $maandStart->addMonth()->toDateString()]) }}"
                           aria-label="Volgende maand">→</a>
                    </nav>

                    <h2 id="agenda-maandtitel">
                        {{ ucfirst($maandStart->translatedFormat('F Y')) }}
                    </h2>

                    <form class="agenda-datumformulier"
                          method="GET"
                          action="{{ route('agenda.index') }}#agenda-dagtitel">
                        <label for="datum">Kies een datum</label>
                        <input type="date" id="datum" name="datum" value="{{ $datum }}" required>
                        <input type="hidden" name="dag" value="1">
                        <button type="submit">Tonen</button>
                    </form>
                </div>

                <div class="agenda-maand-scroll" role="region" aria-label="Maandkalender" tabindex="0">
                    <div class="agenda-maand">
                        @foreach (['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'] as $weekdag)
                            <div class="agenda-weekdag">{{ $weekdag }}</div>
                        @endforeach

                        @for ($leeg = 1; $leeg < $maandStart->dayOfWeekIso; $leeg++)
                            <div class="agenda-maand-leeg" aria-hidden="true"></div>
                        @endfor

                        @for ($nummer = 1; $nummer <= $maandStart->daysInMonth; $nummer++)
                            @php
                                $dag = $maandStart->day($nummer);
                                $dagDatum = $dag->toDateString();
                                $dagAfspraken = $afsprakenPerDag->get($dagDatum, []);
                            @endphp

                            <div class="agenda-maand-dag">
                                <a class="agenda-dagnummer"
                                   href="{{ route('agenda.index', ['datum' => $dagDatum, 'dag' => 1]) }}#agenda-dagtitel"
                                   aria-label="{{ $dag->translatedFormat('l j F Y') }}"
                                   @if ($dagDatum === $datum) aria-current="date" @endif>
                                    {{ $nummer }}
                                </a>

                                @foreach ($dagAfspraken as $afspraak)
                                    @php
                                        $tijd = \Carbon\Carbon::parse($afspraak->StartDatumTijd)->format('H:i');
                                    @endphp

                                    <div class="agenda-maand-afspraak">
                                        <strong><time datetime="{{ $tijd }}">{{ $tijd }}</time></strong>
                                        <span>{{ $afspraak->Voornaam }} {{ $afspraak->Achternaam }}</span>
                                        <span>{{ $afspraak->Behandeling }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endfor

                        @for ($leeg = $maandStart->endOfMonth()->dayOfWeekIso; $leeg < 7; $leeg++)
                            <div class="agenda-maand-leeg" aria-hidden="true"></div>
                        @endfor
                    </div>
                </div>
            </section>

            <section class="agenda-paneel agenda-dag" aria-labelledby="agenda-dagtitel">
                <h2 id="agenda-dagtitel">
                    {{ ucfirst($gekozenDag->translatedFormat('l j F Y')) }}
                </h2>

                @if ($afspraken->isEmpty())
                    <p class="agenda-leeg">Er zijn geen afspraken ingepland voor deze datum.</p>
                @else
                    <ol class="agenda-tijdlijn">
                        @foreach ($afspraken as $afspraak)
                            @php
                                $tijd = \Carbon\Carbon::parse($afspraak->StartDatumTijd)->format('H:i');
                            @endphp

                            <li>
                                <time datetime="{{ $tijd }}">{{ $tijd }}</time>

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

    @if ($toonLegeDagPopup)
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