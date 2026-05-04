<div>
    <section class="detail-hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Home</a>
                <span class="sep">/</span>
                <a href="/#services">Services</a>
                <span class="sep">/</span>
                <span class="here">{{ $service->title }}</span>
            </div>

            <div class="detail-icon-header">
                <div class="detail-icon-box">
                    <x-service-icon :icon="$service->icon" />
                </div>
                <span style="font-family:var(--f-mono);font-size:11px;letter-spacing:0.2em;text-transform:uppercase;color:var(--fg-muted)">
                    Service · {{ $serviceNumber }}
                </span>
            </div>

            <h1 class="detail-title">{{ $service->title }}.</h1>
            <p class="detail-tagline">{{ $service->subtitle }}</p>

            <div class="detail-meta">
                <div>
                    <span class="m-k">Best for</span>
                    <span class="m-v">{{ $service->best_for }}</span>
                </div>
                <div>
                    <span class="m-k">Typical engagement</span>
                    <span class="m-v">{{ $service->engagement_duration }}</span>
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
                        <p>{{ $service->overview }}</p>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// What you get</h3>
                    <div class="block-body">
                        <ul>
                            @foreach ($service->deliverables as $deliverable)
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
                            @foreach ($service->process as $step)
                                <div class="step">
                                    <span class="k">{{ sprintf('%02d', $loop->iteration) }} / step</span>
                                    <h4 class="t">{{ $step['title'] }}</h4>
                                    <p class="d">{{ $step['description'] }}</p>
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
                            @foreach ($service->tech_stack as $tech)
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
                        <div class="detail-cta-row">
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
