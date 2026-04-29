<div>
    <section class="detail-hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Home</a>
                <span class="sep">/</span>
                <a href="/#services">Services</a>
                <span class="sep">/</span>
                <span class="here">{{ $service['title'] }}</span>
            </div>

            <div style="display:flex;align-items:center;gap:16px;margin-bottom:28px">
                <div class="detail-icon-box">
                    @if ($service['icon'] === 'code')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="24" height="24"><path d="M8 9l-4 3 4 3M16 9l4 3-4 3M14 6l-4 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    @elseif ($service['icon'] === 'server')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="24" height="24"><rect x="3" y="4" width="18" height="7" rx="1.5"/><rect x="3" y="13" width="18" height="7" rx="1.5"/><path d="M7 7.5h.01M7 16.5h.01M11 7.5h4M11 16.5h4" stroke-linecap="round"/></svg>
                    @elseif ($service['icon'] === 'phone')
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="24" height="24"><rect x="7" y="2.5" width="10" height="19" rx="2.5"/><path d="M11 18.5h2" stroke-linecap="round"/></svg>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" width="24" height="24"><ellipse cx="12" cy="5" rx="8" ry="2.5"/><path d="M4 5v7c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5V5"/><path d="M4 12v7c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5v-7"/></svg>
                    @endif
                </div>
                <span style="font-family:var(--f-mono);font-size:11px;letter-spacing:0.2em;text-transform:uppercase;color:var(--fg-muted)">
                    Service · {{ $service['n'] }}
                </span>
            </div>

            <h1 class="detail-title">{{ $service['title'] }}.</h1>
            <p class="detail-tagline">{{ $service['tagline'] }}</p>

            <div class="detail-meta">
                <div>
                    <span class="m-k">Best for</span>
                    <span class="m-v">{{ $service['bestFor'] }}</span>
                </div>
                <div>
                    <span class="m-k">Typical engagement</span>
                    <span class="m-v">6–24 weeks</span>
                </div>
                <div>
                    <span class="m-k">Availability</span>
                    <span class="m-v">Open — Q3 2026</span>
                </div>
            </div>
        </div>
    </section>

    <section class="detail-body">
        <div class="container">
            <div class="block">
                <div class="detail-grid">
                    <h3>// Overview</h3>
                    <div class="block-body">
                        <p>{{ $service['short'] }}</p>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// What you get</h3>
                    <div class="block-body">
                        <ul>
                            @foreach ($service['deliverables'] as $deliverable)
                                <li>{{ $deliverable }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// Process</h3>
                    <div class="block-body">
                        <div class="process">
                            @foreach ($service['process'] as $step)
                                <div class="step">
                                    <span class="k">{{ $step['k'] }} / step</span>
                                    <h4 class="t">{{ $step['t'] }}</h4>
                                    <p class="d">{{ $step['d'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// Stack I use</h3>
                    <div class="block-body">
                        <div class="tech-pills">
                            @foreach ($service['tech'] as $tech)
                                <span>{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// Next step</h3>
                    <div class="block-body">
                        <p>Tell me about your project. I'll reply within 24 hours with a scoping call or a short written plan.</p>
                        <div style="margin-top:24px;display:flex;gap:10px;flex-wrap:wrap">
                            <a href="/#contact" class="btn btn-primary">
                                Start a project
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12" class="arrow"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="/#projects" class="btn btn-ghost">See case studies</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="detail-nav">
            <a href="{{ route('service.detail', $prev['slug']) }}">
                <span class="k">← Previous service</span>
                <div class="t">{{ $prev['title'] }}</div>
            </a>
            <a href="{{ route('service.detail', $next['slug']) }}" class="next">
                <span class="k">Next service →</span>
                <div class="t">{{ $next['title'] }}</div>
            </a>
        </div>
    </div>
</div>
