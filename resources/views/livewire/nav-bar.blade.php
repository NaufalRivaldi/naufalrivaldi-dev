<header class="nav" x-data="{ open: false }">
    <div class="container nav-inner">
        <a href="#home" class="logo" @click="open = false">
            <span class="dot"></span>
            <span>naufal.dev</span>
            <span class="logo-meta">Fullstack · PHP/Laravel</span>
        </a>

        <nav class="nav-links">
            <a href="#services">Services</a>
            <a href="#experience">Experience</a>
            <a href="#projects">Projects</a>
            <a href="#stack">Stack</a>
            <a href="#contact">Contact</a>
        </nav>

        <div class="nav-right">
            <button class="theme-toggle" @click="toggleTheme()" aria-label="Toggle theme">
                <template x-if="theme === 'dark'">
                    <span class="theme-btn-inner">
                        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" stroke-linecap="round"/></svg>
                        <span class="label">light</span>
                    </span>
                </template>
                <template x-if="theme === 'light'">
                    <span class="theme-btn-inner">
                        <svg class="ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" stroke-linejoin="round"/></svg>
                        <span class="label">dark</span>
                    </span>
                </template>
            </button>

            <button
                class="nav-burger"
                :class="{ open: open }"
                @click="open = !open"
                aria-label="Menu"
                :aria-expanded="open"
            >
                <span></span>
            </button>
        </div>
    </div>

    <div class="nav-drawer" :class="{ open: open }">
        <a href="#services" @click="open = false"><span>Services</span><span class="num">01</span></a>
        <a href="#experience" @click="open = false"><span>Experience</span><span class="num">02</span></a>
        <a href="#projects" @click="open = false"><span>Projects</span><span class="num">03</span></a>
        <a href="#stack" @click="open = false"><span>Stack</span><span class="num">04</span></a>
        <a href="#contact" @click="open = false"><span>Contact</span><span class="num">05</span></a>
        <div class="drawer-foot">
            <a href="mailto:naufal.rivaldi33@gmail.com">→ naufal.rivaldi33@gmail.com</a>
            <a href="https://www.linkedin.com/in/naufal-rivaldi-18b385158/" target="_blank" rel="noreferrer">→ LinkedIn</a>
        </div>
    </div>
</header>
