<!DOCTYPE html>
<html lang="en" x-data="portfolio()" :data-theme="theme" x-cloak>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $slug }} — Naufal Rivaldi</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

<livewire:nav-bar prefix="/" />

<main>
    <livewire:service-detail :slug="$slug" />
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
    });
</script>

</body>
</html>
