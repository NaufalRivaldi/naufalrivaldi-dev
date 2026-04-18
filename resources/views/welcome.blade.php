<!DOCTYPE html>
<html lang="en" x-data="portfolio()" :data-theme="theme" x-cloak>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Naufal Rivaldi — Fullstack Developer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

<livewire:nav-bar />

<main>
    <livewire:hero-section />

    <div class="container"><div class="divider-ascii">· · · — — — · · ·</div></div>

    <livewire:services-section />

    <div class="container"><div class="divider-ascii">/ / / / / / / / / / /</div></div>

    <livewire:experience-section />

    <div class="container"><div class="divider-ascii">[ 01 ] [ 02 ] [ 03 ] [ 04 ]</div></div>

    <livewire:projects-section />

    <div class="container"><div class="divider-ascii">{ stack.open() }</div></div>

    <livewire:tech-stack-section />

    <livewire:contact-section />
</main>

@livewireScripts

<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('portfolio', () => ({
            theme: localStorage.getItem('portfolio-theme') || 'light',
            toggleTheme() {
                this.theme = this.theme === 'dark' ? 'light' : 'dark';
                localStorage.setItem('portfolio-theme', this.theme);
            },
            init() {
                const io = new IntersectionObserver((entries) => {
                    entries.forEach(en => { if (en.isIntersecting) en.target.classList.add('in'); });
                }, { threshold: 0.12 });
                document.querySelectorAll('.reveal').forEach(el => io.observe(el));
            },
        }));

        Alpine.data('typewriter', () => ({
            roles: ['fullstack_developer', 'laravel_specialist', 'backend_architect', 'livewire_enjoyer'],
            idx: 0,
            displayText: '',
            deleting: false,
            tick() {
                const current = this.roles[this.idx];
                const speed = this.deleting ? 45 : 85;
                setTimeout(() => {
                    if (!this.deleting) {
                        this.displayText = current.slice(0, this.displayText.length + 1);
                        if (this.displayText === current) {
                            setTimeout(() => { this.deleting = true; this.tick(); }, 1500);
                            return;
                        }
                    } else {
                        this.displayText = current.slice(0, this.displayText.length - 1);
                        if (this.displayText === '') {
                            this.deleting = false;
                            this.idx = (this.idx + 1) % this.roles.length;
                        }
                    }
                    this.tick();
                }, speed);
            },
            init() { this.tick(); },
        }));

    });
</script>

</body>
</html>
