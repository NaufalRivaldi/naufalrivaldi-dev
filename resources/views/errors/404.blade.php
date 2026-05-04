<!DOCTYPE html>
<html lang="en" x-data="portfolio()" :data-theme="theme" x-cloak>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>404 — Naufal Rivaldi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

<livewire:nav-bar prefix="/" />

<main>
    <section class="nf-section">
        <div class="container nf-grid">

            {{-- LEFT: terminal + meta --}}
            <div class="nf-left">
                <div class="nf-terminal">
                    <div class="nf-term-head">
                        <i></i><i></i><i></i>
                        <span class="nf-term-path">~/naufal — zsh</span>
                    </div>
                    <div class="nf-term-body">
                        <div class="nf-line">
                            <span class="nf-prompt">~$</span>
                            <span class="nf-cmd">cat {{ request()->getPathInfo() }}</span>
                        </div>
                        <div class="nf-line nf-err">
                            cat: <span>{{ request()->getPathInfo() }}</span>: No such file or directory
                        </div>
                        <div class="nf-line">
                            <span class="nf-prompt">~$</span>
                            <span class="nf-cmd">whereis page</span>
                        </div>
                        <div class="nf-line nf-muted">page: not in $PATH</div>
                        <div class="nf-line">
                            <span class="nf-prompt">~$</span>
                            <span class="nf-cmd">cd ../</span><span class="nf-blink">▌</span>
                        </div>
                    </div>
                </div>

                <div class="nf-meta">
                    <div>
                        <span class="k">Status</span>
                        <span class="v">404 — Not Found</span>
                    </div>
                    <div>
                        <span class="k">Referrer</span>
                        <span class="v" id="nf-referrer">—</span>
                    </div>
                    <div>
                        <span class="k">Stack</span>
                        <span class="v">Laravel · Filament · Livewire</span>
                    </div>
                    <div>
                        <span class="k">Action</span>
                        <span class="v">Try one of the links →</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT: huge 404 + actions --}}
            <div class="nf-right">
                <div class="breadcrumb">
                    <a href="/">Home</a>
                    <span class="sep">/</span>
                    <span class="here">404</span>
                </div>

                <h1 class="nf-headline">
                    <span class="nf-digits">
                        <span>4</span>
                        <span class="nf-zero" x-data="glitch404()" x-text="glyph">0</span>
                        <span>4</span>
                    </span>
                    <span class="nf-sub">Page <em>not found.</em></span>
                </h1>

                <p class="nf-tagline">
                    The route you followed doesn't resolve to anything I've built — yet.
                    Maybe a stale link, maybe a typo. Let's get you somewhere useful.
                </p>

                <div class="nf-actions">
                    <a href="/" class="btn btn-primary">← Back home</a>
                    <a href="/#contact" class="btn btn-ghost">Report a broken link</a>
                </div>

                <div class="nf-suggest">
                    <div class="nf-suggest-label">// Try one of these</div>
                    <div class="nf-suggest-list">
                        <a href="/#services" class="nf-suggest-item">
                            <span class="nf-num">01</span>
                            <span class="nf-link">
                                <span class="nf-link-t">Services</span>
                                <span class="nf-link-m">What I'm offering</span>
                            </span>
                            <span class="nf-arrow">↗</span>
                        </a>
                        <a href="/#projects" class="nf-suggest-item">
                            <span class="nf-num">02</span>
                            <span class="nf-link">
                                <span class="nf-link-t">Projects</span>
                                <span class="nf-link-m">Selected case studies</span>
                            </span>
                            <span class="nf-arrow">↗</span>
                        </a>
                        <a href="/#experience" class="nf-suggest-item">
                            <span class="nf-num">03</span>
                            <span class="nf-link">
                                <span class="nf-link-t">Experience</span>
                                <span class="nf-link-m">Where I've shipped code</span>
                            </span>
                            <span class="nf-arrow">↗</span>
                        </a>
                        <a href="/#contact" class="nf-suggest-item">
                            <span class="nf-num">04</span>
                            <span class="nf-link">
                                <span class="nf-link-t">Contact</span>
                                <span class="nf-link-m">Start a conversation</span>
                            </span>
                            <span class="nf-arrow">↗</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="nf-ascii" aria-hidden="true">
            404 — 404 — ROUTE NOT FOUND — 404 — 404 — ROUTE NOT FOUND — 404 — 404 — ROUTE NOT FOUND — 404 — 404 — ROUTE NOT FOUND
        </div>
    </section>
</main>

<div class="container">
    <footer class="footer">
        <span class="signature">Naufal Rivaldi</span>
        <span>© 2026 — Built with Laravel &amp; Livewire.</span>
        <a href="/">← Back to portfolio</a>
    </footer>
</div>

@livewireScripts

<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('portfolio', () => ({
            theme: localStorage.getItem('portfolio-theme') || 'light',
            toggleTheme() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('portfolio-theme', this.theme);
            },
            init() {},
        }));

        Alpine.data('glitch404', () => ({
            glyphs: ['0', 'Ø', '◯', '0', '○', '0', '◌', '0'],
            idx: 0,
            glyph: '0',
            init() {
                setInterval(() => {
                    this.idx = (this.idx + 1) % this.glyphs.length;
                    this.glyph = this.glyphs[this.idx];
                }, 380);
            },
        }));

    });

    // Populate referrer from browser
    document.addEventListener('DOMContentLoaded', () => {
        const el = document.getElementById('nf-referrer');
        if (el && document.referrer) {
            try {
                const u = new URL(document.referrer);
                el.textContent = u.pathname + (u.hash || '');
            } catch (_) {}
        }
    });
</script>

</body>
</html>
