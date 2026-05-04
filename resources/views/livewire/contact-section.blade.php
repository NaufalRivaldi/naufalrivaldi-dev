<section id="contact">
    <div class="container">
        <div class="contact">
            <div class="contact-copy">
                <div class="sec-eyebrow">// get in touch</div>
                <h2>
                    Have a project?<br/>
                    <em>Let's build it.</em>
                </h2>
                <p>Whether it's a new product, a Laravel audit, or hardening an existing backend — I'm open to freelance and full-time offers. Typical response within 24 hours.</p>

                <div class="contact-meta">
                    <a href="mailto:{{ $settings->contact_email }}">
                        <span class="k">Email</span>
                        <span class="v">{{ $settings->contact_email }}</span>
                    </a>

                    @if ($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}" target="_blank" rel="noreferrer">
                            <span class="k">LinkedIn</span>
                            <span class="v">/in/naufal-rivaldi</span>
                        </a>
                    @endif

                    @if ($settings->github_url)
                        <a href="{{ $settings->github_url }}" target="_blank" rel="noreferrer">
                            <span class="k">GitHub</span>
                            <span class="v">{{ ltrim(parse_url($settings->github_url, PHP_URL_PATH), '/') }}</span>
                        </a>
                    @endif

                    @if ($settings->twitter_url)
                        <a href="{{ $settings->twitter_url }}" target="_blank" rel="noreferrer">
                            <span class="k">Twitter / X</span>
                            <span class="v">{{ ltrim(parse_url($settings->twitter_url, PHP_URL_PATH), '/') }}</span>
                        </a>
                    @endif

                    @if ($settings->timezone)
                        <div>
                            <span class="k">Timezone</span>
                            <span class="v">{{ $settings->timezone }}</span>
                        </div>
                    @endif

                    @if ($settings->availability_status)
                        <div>
                            <span class="k">Status</span>
                            <span class="v">{{ $settings->availability_status }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <livewire:contact-form />
        </div>

        <footer class="footer">
            <span class="signature">Naufal Rivaldi</span>
            <span>© 2026 — Built with Laravel &amp; Livewire.</span>
            <span>v1.0 · 2026.04</span>
        </footer>
    </div>
</section>
