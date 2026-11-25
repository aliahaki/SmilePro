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
                <a href="{{ route('dashboard') }}" aria-current="page">Dashboard</a>
                <a href="{{ url('/agenda') }}">Agenda</a>
                <a href="{{ url('/patienten') }}">Patiënten</a>
                <a href="{{ url('/behandelingen') }}">Behandelingen</a>
            </nav>
        </aside>

        <main class="dashboard">
            <header class="dashboard-header">
                <h1>Praktijkdashboard</h1>
                <p>Welkom bij SmilePro.</p>
            </header>

            <div class="dashboard-grid">
                <section class="dashboard-card dashboard-card-primary">
                    <h2>Agenda</h2>
                    <p>Bekijk welke afspraken per dag zijn ingepland.</p>
                    <a class="card-link" href="{{ url('/agenda') }}">
                        Open agenda <span aria-hidden="true">→</span>
                    </a>
                </section>

                <section class="dashboard-card">
                    <h2>Patiënten</h2>
                    <p>Bekijk het overzicht van ingeschreven patiënten.</p>
                    <a class="card-link" href="{{ url('/patienten') }}">
                        Bekijk patiënten <span aria-hidden="true">→</span>
                    </a>
                </section>

                <section class="dashboard-card">
                    <h2>Behandelingen</h2>
                    <p>Bekijk welke behandelingen de praktijk aanbiedt.</p>
                    <a class="card-link" href="{{ url('/behandelingen') }}">
                        Bekijk behandelingen <span aria-hidden="true">→</span>
                    </a>
                </section>
            </div>
        </main>
    </div>
</body>
</html>