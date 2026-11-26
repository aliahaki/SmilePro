<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="SmilePro - Persoonlijke mondzorg in Utrecht">

    <title>SmilePro | Een gezonde glimlach</title>

    <!-- Lettertype -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Iconen -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>

    <!-- =========================
         HEADER EN NAVIGATIE
    ========================== -->
    <header class="site-header">
        <div class="container header-inner">

            <a href="{{ route('home') }}" class="brand">
                <span class="brand-icon">
                    <i class="fa-solid fa-tooth"></i>
                </span>

                <span>Smile<span>Pro</span></span>
            </a>

            <button type="button" class="menu-toggle" id="menu-toggle" aria-label="Menu openen"
                aria-controls="hoofdmenu" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>

            <nav class="main-nav" id="hoofdmenu" aria-label="Hoofdnavigatie">
                <a href="#home">Home</a>
                <a href="#over-ons">Over ons</a>
                <a href="#behandelingen">Behandelingen</a>
                <a href="#team">Ons team</a>
                <a href="#contact">Contact</a>

                <div class="mobile-actions">
                    <button class="btn btn-login" type="button" data-later="Inloggen">
                        Inloggen
                    </button>

                    <button class="btn btn-register" type="button" data-later="Registreren">
                        Registreren
                    </button>
                </div>
            </nav>

            <div class="header-actions">
                <button class="btn btn-login" type="button" data-later="Inloggen">
                    Inloggen
                </button>

                <button class="btn btn-register" type="button" data-later="Registreren">
                    Registreren
                </button>
            </div>

        </div>
    </header>

    <main>

        <!-- =========================
             HERO
        ========================== -->
        <section class="hero" id="home">
            <div class="hero-layout">

                <div class="hero-content">
                    <div class="hero-copy">

                        <p class="eyebrow">
                            MONDZORG MET PERSOONLIJKE AANDACHT
                        </p>

                        <!-- Titel uit de database, met SmilePro blauw -->
                        <h1>
                            {{ \Illuminate\Support\Str::beforeLast($pagina->slogan, $pagina->naam) }}<span>{{ $pagina->naam }}</span>
                        </h1>

                        <p class="hero-description">
                            {{ $pagina->introductie }}
                        </p>

                        <div class="hero-buttons">
                            <a href="#contact" class="btn btn-primary">
                                Maak een afspraak
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                            <a href="#behandelingen" class="btn btn-outline">
                                Onze behandelingen
                            </a>
                        </div>

                        <div class="hero-benefits">
                            <span>
                                <i class="fa-solid fa-check"></i>
                                Persoonlijke zorg
                            </span>

                            <span>
                                <i class="fa-solid fa-check"></i>
                                Moderne praktijk
                            </span>

                            <span>
                                <i class="fa-solid fa-check"></i>
                                Snel terecht
                            </span>
                        </div>
                    </div>
                </div>

                <div class="hero-image">
                    <img src="{{ $afbeeldingen['hero'] }}" alt="Tandarts bespreekt de behandeling met een patiënt"
                        fetchpriority="high">

                    <div class="review-badge">
                        <strong>9,4</strong>

                        <div class="review-details">
                            <span class="review-stars">★★★★★</span>
                            <small>1.240 tevreden patiënten</small>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================
             STATISTIEKEN
        ========================== -->
        <section class="stats-section" aria-label="SmilePro in cijfers">
            <div class="container stats-card">

                @foreach ($statistieken as $statistiek)
                    <div class="stat-item">
                        <strong>{{ $statistiek['waarde'] }}</strong>
                        <span>{{ $statistiek['tekst'] }}</span>
                    </div>
                @endforeach

            </div>
        </section>

        <!-- =========================
             OVER SMILEPRO
        ========================== -->
        <section class="about-section section-space" id="over-ons">
            <div class="container about-layout">

                <div class="about-image">
                    <img src="{{ $afbeeldingen['praktijk'] }}" alt="Moderne tandartspraktijk" loading="lazy">

                    <div class="experience-badge">
                        <strong>15 jaar</strong>
                        <span>vertrouwde mondzorg</span>
                    </div>
                </div>

                <div class="about-content">
                    <p class="eyebrow">OVER SMILEPRO</p>

                    <h2>Met aandacht voor u en uw glimlach</h2>

                    <p class="about-description">
                        {{ $pagina->over_ons }}
                    </p>

                    <ul class="about-benefits">
                        <li>
                            <i class="fa-solid fa-check"></i>
                            Eén vast team dat u kent
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Transparante behandelplannen
                        </li>

                        <li>
                            <i class="fa-solid fa-check"></i>
                            Ook voor patiënten met tandartsangst
                        </li>
                    </ul>

                    <a href="#team" class="text-link">
                        Ontmoet ons team
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </section>

        <!-- =========================
             BEHANDELINGEN
        ========================== -->
        <section class="treatments-section section-space" id="behandelingen">
            <div class="container">

                <div class="section-heading">
                    <p class="eyebrow">ONZE BEHANDELINGEN</p>

                    <h2>Alles voor een gezonde glimlach</h2>

                    <p>
                        Van preventieve controle tot specialistische
                        behandeling, altijd met een helder plan.
                    </p>
                </div>

                <div class="treatments-grid">

                    @foreach ($behandelingen as $behandeling)
                        <article class="treatment-card {{ $loop->first ? 'featured' : '' }}">

                            <span class="treatment-icon">
                                <i class="fa-solid {{ $behandeling['icoon'] }}"></i>
                            </span>

                            <h3>{{ $behandeling['naam'] }}</h3>

                            <p>{{ $behandeling['beschrijving'] }}</p>

                            <a href="#contact">
                                Meer informatie
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                        </article>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- =========================
             ONS TEAM
        ========================== -->
        <section class="team-section section-space" id="team">
            <div class="container">

                <div class="section-heading">
                    <p class="eyebrow">ONS TEAM</p>

                    <h2>Deskundige zorg, vertrouwde gezichten</h2>

                    <p>
                        Ons team bestaat uit 3 tandartsen,
                        2 mondhygiënisten en 4 tandartsassistenten.
                    </p>
                </div>

                <div class="team-grid">

                    @foreach ($teamleden as $teamlid)
                        <article class="team-card">

                            <img src="{{ $teamlid['foto'] }}" alt="Teamfoto bij {{ $teamlid['naam'] }}"
                                loading="lazy">

                            <div class="team-overlay">
                                <h3>{{ $teamlid['naam'] }}</h3>
                                <p>{{ $teamlid['functie'] }}</p>
                            </div>

                        </article>
                    @endforeach

                </div>

                <div class="team-statistics">
                    <div>
                        <strong>2</strong>
                        <span>Mondhygiënisten</span>
                    </div>

                    <div>
                        <strong>4</strong>
                        <span>Tandartsassistenten</span>
                    </div>

                    <div>
                        <strong>1</strong>
                        <span>Praktijkmanager</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================
             CONTACT
        ========================== -->
        <section class="contact-section section-space" id="contact">
            <div class="container contact-layout">

                <div class="contact-content">
                    <p class="eyebrow">CONTACT</p>

                    <h2>We helpen u graag verder</h2>

                    <p class="contact-intro">
                        Heeft u een vraag of wilt u een afspraak maken?
                        Neem gerust contact op.
                    </p>

                    <div class="contact-list">

                        <div class="contact-item">
                            <i class="fa-solid fa-location-dot"></i>

                            <div>
                                <strong>{{ $pagina->adres }}</strong>
                                <span>{{ $pagina->postcode_stad }}</span>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fa-solid fa-phone"></i>

                            <div>
                                <strong>{{ $pagina->telefoon }}</strong>
                                <span>Ma – vr, 08:00–17:00</span>
                            </div>
                        </div>

                        <div class="contact-item">
                            <i class="fa-regular fa-envelope"></i>

                            <div>
                                <strong>{{ $pagina->email }}</strong>
                                <span>Reactie binnen één werkdag</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="opening-card">
                    <h3>Openingstijden</h3>

                    <div class="opening-list">
                        @foreach ($openingstijden as $openingstijd)
                            <div class="opening-row">
                                <span>{{ $openingstijd['dag'] }}</span>
                                <strong>{{ $openingstijd['tijd'] }}</strong>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-primary opening-button" data-later="Online afspraak maken">
                        Online afspraak maken
                    </button>
                </div>

            </div>
        </section>

    </main>

    <!-- =========================
         FOOTER
    ========================== -->
    <footer class="site-footer">
        <div class="container footer-grid">

            <div class="footer-brand">
                <a href="{{ route('home') }}" class="brand">
                    <span class="brand-icon">
                        <i class="fa-solid fa-tooth"></i>
                    </span>
                    <span>Smile<span>Pro</span></span>
                </a>

                <p>Persoonlijke mondzorg in het hart van Utrecht.</p>
            </div>

            <div class="footer-column">
                <h4>Snel naar</h4>

                <a href="#" data-later="Patiëntportaal">
                    Patiëntportaal
                </a>

                <a href="#behandelingen">
                    Behandelingen
                </a>
            </div>

            <div class="footer-column">
                <h4>Contact</h4>

                <span>{{ $pagina->telefoon }}</span>
                <span>{{ $pagina->email }}</span>
            </div>

            <div class="footer-column">
                <h4>Veilige zorg</h4>

                <span>BIG-geregistreerde behandelaars</span>
                <span>AVG-proof patiëntportaal</span>
            </div>

        </div>

        <div class="container footer-bottom">
            <p>
                © 2025 SmilePro Tandartspraktijk. Alle rechten voorbehouden.
            </p>
        </div>
    </footer>

    <!-- Melding bij functies van latere sprints -->
    <div id="melding" class="toast-message" role="status" aria-live="polite"></div>

    <script>
        const menuKnop = document.getElementById('menu-toggle');
        const menu = document.getElementById('hoofdmenu');
        const melding = document.getElementById('melding');

        let meldingTimeout;

        // Open of sluit het mobiele menu.
        menuKnop.addEventListener('click', function() {
            const open = menu.classList.toggle('menu-open');

            menuKnop.setAttribute('aria-expanded', String(open));
            menuKnop.setAttribute(
                'aria-label',
                open ? 'Menu sluiten' : 'Menu openen'
            );

            menuKnop.querySelector('i').className = open ?
                'fa-solid fa-xmark' :
                'fa-solid fa-bars';
        });

        // Sluit het mobiele menu na een klik.
        menu.querySelectorAll('a[href^="#"]').forEach(function(link) {
            link.addEventListener('click', function() {
                menu.classList.remove('menu-open');

                menuKnop.setAttribute('aria-expanded', 'false');
                menuKnop.setAttribute('aria-label', 'Menu openen');

                menuKnop.querySelector('i').className = 'fa-solid fa-bars';
            });
        });

        // Duidelijke melding voor functies van een latere sprint.
        document.querySelectorAll('[data-later]').forEach(function(knop) {
            knop.addEventListener('click', function(event) {
                event.preventDefault();

                melding.textContent =
                    knop.dataset.later + ' is binnenkort beschikbaar.';

                melding.classList.add('visible');

                clearTimeout(meldingTimeout);

                meldingTimeout = setTimeout(function() {
                    melding.classList.remove('visible');
                }, 3500);
            });
        });
    </script>

</body>

</html>
