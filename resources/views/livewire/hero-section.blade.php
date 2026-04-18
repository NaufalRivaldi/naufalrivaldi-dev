<section id="home" class="hero">
    <div class="container">
        <div class="hero-grid hero-grid-full">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span class="pulse"></span>
                    Available for Q3 2026 · Remote or Singapore
                </div>

                <h1>
                    <span class="hi">Hello, I'm</span>
                    <span class="name">Naufal</span>
                    <span class="name-accent">Rivaldi.</span>
                </h1>

                <div class="hero-role">
                    <div class="typewriter" x-data="typewriter()">
                        <span class="prompt">~$</span>
                        <span>role = "<span x-text="displayText"></span>"</span>
                        <span class="cursor"></span>
                    </div>
                </div>

                <p class="hero-bio">
                    Passionate Backend Developer specialized in <strong>Laravel</strong>, <strong>Filament</strong>, and <strong>Livewire</strong> for
                    dynamic, reactive interfaces. I pair backend depth with frontend capability in Vue &amp; Next.js
                    to ship robust, scalable apps end-to-end — with experience serving a global audience from a Singapore-based team.
                </p>

                <div class="hero-ctas">
                    <a href="#contact" class="btn btn-primary">
                        Let's Talk
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="14" height="14" class="arrow"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <a href="#projects" class="btn btn-ghost">View Projects</a>
                </div>
            </div>
        </div>

        <div class="marquee" aria-hidden="true">
            <div class="marquee-track">
                @foreach (range(0, 1) as $_)
                    @foreach (['Laravel', 'Filament', 'Livewire', 'PostgreSQL', 'Next.js', 'Tailwind', 'Native PHP', 'Vue.js'] as $tech)
                        <span class="marquee-item">{{ $tech }}</span>
                    @endforeach
                @endforeach
            </div>
        </div>

        <div class="hero-sub">
            <div class="sub-group">
                <a href="https://www.linkedin.com/in/naufal-rivaldi-18b385158/" target="_blank" rel="noreferrer">
                    <svg viewBox="0 0 24 24" fill="currentColor" width="13" height="13"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3V9zm7 0h3.8v1.7h.1c.5-1 1.9-2 3.9-2 4.2 0 5 2.7 5 6.3V21h-4v-5.4c0-1.3 0-3-1.8-3s-2.1 1.4-2.1 2.9V21h-4V9z"/></svg>
                    LinkedIn
                </a>
                <a href="mailto:naufal.rivaldi33@gmail.com">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="13" height="13"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6" stroke-linecap="round"/></svg>
                    Email
                </a>
                <span style="color:var(--fg-subtle)">Based in Indonesia · UTC+7</span>
            </div>
            <div class="sub-group">
                <span>naufal.rivaldi33@gmail.com</span>
            </div>
        </div>
    </div>
</section>
