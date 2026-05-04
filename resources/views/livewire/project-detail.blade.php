<div>
    <section class="detail-hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="/">Home</a>
                <span class="sep">/</span>
                <a href="/#projects">Projects</a>
                <span class="sep">/</span>
                <span class="here">{{ $project['title'] }}</span>
            </div>

            <div style="display:flex;align-items:center;gap:10px;margin-bottom:28px;flex-wrap:wrap">
                <span style="background:var(--accent);color:var(--accent-ink);padding:5px 12px;border-radius:999px;font-family:var(--f-mono);font-size:11px;letter-spacing:0.1em;text-transform:uppercase;font-weight:600">{{ $project['tag'] }}</span>
                <span style="font-family:var(--f-mono);font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--fg-muted)">{{ $project['year'] }}</span>
                @if ($project['featured'])
                    <span style="font-family:var(--f-mono);font-size:11px;letter-spacing:0.14em;text-transform:uppercase;color:var(--fg-muted)">★ Featured</span>
                @endif
            </div>

            <h1 class="detail-title">{{ $project['title'] }}.</h1>
            <p class="detail-tagline">{{ $project['subtitle'] }}</p>

            <div class="detail-meta">
                <div>
                    <span class="m-k">Client</span>
                    <span class="m-v">{{ $project['client'] }}</span>
                </div>
                <div>
                    <span class="m-k">My role</span>
                    <span class="m-v">{{ $project['role'] }}</span>
                </div>
                <div>
                    <span class="m-k">Duration</span>
                    <span class="m-v">{{ $project['duration'] }}</span>
                </div>
                <div>
                    <span class="m-k">Year</span>
                    <span class="m-v">{{ $project['year'] }}</span>
                </div>
            </div>

            <div class="detail-banner">
                @if ($project['main_image_url'])
                    <img
                        src="{{ $project['main_image_url'] }}"
                        alt="{{ $project['title'] }}"
                        class="detail-banner-img"
                    />
                @else
                    <div class="chrome">
                        <i></i><i></i><i></i>
                        <span class="url">~/ {{ $project['slug'] }}.app</span>
                    </div>
                    <div class="art">
                        <div class="sidebar">
                            <div class="bar active"></div>
                            <div class="bar short"></div>
                            <div class="bar short"></div>
                            <div class="bar"></div>
                            <div class="bar short"></div>
                        </div>
                        <div class="main">
                            <div class="row">
                                @foreach (array_slice($project['outcome'], 0, 3) as $i => $out)
                                    <div class="card {{ $i === 0 ? 'accent' : '' }}">
                                        <div class="h"></div>
                                        <div class="num">{{ $out['v'] }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="chart">
                                <svg viewBox="0 0 400 120" preserveAspectRatio="none">
                                    <polyline fill="none" stroke="var(--accent)" stroke-width="2" points="0,90 40,80 80,85 120,65 160,55 200,60 240,40 280,45 320,25 360,20 400,10" />
                                    <polyline fill="none" stroke="var(--fg-muted)" stroke-width="1" stroke-dasharray="3 3" points="0,70 400,70" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="detail-body">
        <div class="container">
            <div class="block">
                <div class="detail-grid">
                    <h3>// Challenge</h3>
                    <div class="block-body">
                        <p>{{ $project['challenge'] }}</p>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// Solution</h3>
                    <div class="block-body">
                        <p>{{ $project['solution'] }}</p>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// Outcome</h3>
                    <div class="block-body">
                        <div class="outcomes">
                            @foreach ($project['outcome'] as $out)
                                <div class="out">
                                    <span class="k">{{ $out['k'] }}</span>
                                    <span class="v">{{ $out['v'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($project['gallery_urls']))
                <div class="block"
                     x-data="galleryLightbox({{ Illuminate\Support\Js::from($project['gallery_urls']) }})"
                     @keydown.escape.window="isOpen && close()"
                     @keydown.arrow-left.window="isOpen && prev()"
                     @keydown.arrow-right.window="isOpen && next()">
                    <div class="detail-grid">
                        <h3>// Gallery</h3>
                        <div class="block-body">
                            <div class="gallery">
                                @foreach ($project['gallery_urls'] as $i => $url)
                                    <div class="shot shot-clickable"
                                         role="button"
                                         tabindex="0"
                                         @click="openAt({{ $i }})"
                                         @keydown.enter="openAt({{ $i }})"
                                         @keydown.space.prevent="openAt({{ $i }})">
                                        <div class="chrome"><i></i><i></i><i></i></div>
                                        <img src="{{ $url }}" alt="Gallery screenshot {{ $i + 1 }}" class="shot-img" />
                                        <div class="shot-zoom">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="22" height="22" aria-hidden="true">
                                                <circle cx="11" cy="11" r="6"/><path d="M20 20l-3.5-3.5M11 8v6M8 11h6" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Lightbox modal --}}
                    <div class="lightbox"
                         x-show="isOpen"
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         @click.self="close()"
                         @touchstart.passive="touchStartX = $event.touches[0].clientX"
                         @touchend.passive="onSwipe($event)">

                        <button class="lightbox-close" @click="close()" aria-label="Close lightbox">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18" aria-hidden="true">
                                <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round"/>
                            </svg>
                        </button>

                        <button class="lightbox-nav lightbox-prev" @click="prev()" x-show="images.length > 1" aria-label="Previous image">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22" aria-hidden="true">
                                <path d="M15 18l-6-6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div class="lightbox-body" @click.self="close()">
                            <img :src="images[current]" class="lightbox-img" :alt="'Gallery image ' + (current + 1)" />
                        </div>

                        <button class="lightbox-nav lightbox-next" @click="next()" x-show="images.length > 1" aria-label="Next image">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="22" height="22" aria-hidden="true">
                                <path d="M9 18l6-6-6-6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>

                        <div class="lightbox-counter" x-show="images.length > 1">
                            <span x-text="current + 1"></span>
                            <span class="lightbox-sep">/</span>
                            <span x-text="images.length"></span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="block">
                <div class="detail-grid">
                    <h3>// Stack</h3>
                    <div class="block-body">
                        <div class="tech-pills">
                            @foreach ($project['tech'] as $tech)
                                <span>{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="block">
                <div class="detail-grid">
                    <h3>// Interested?</h3>
                    <div class="block-body">
                        <p>Got a project like this one? Let's talk about how I can help.</p>
                        <div style="margin-top:24px;display:flex;gap:10px;flex-wrap:wrap">
                            <a href="/#contact" class="btn btn-primary">
                                Start a project
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12" class="arrow"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                            <a href="/#projects" class="btn btn-ghost">See more work</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="detail-nav">
            <a href="{{ route('project.detail', $prev['slug']) }}">
                <span class="k">← Previous project</span>
                <div class="t">{{ $prev['title'] }}</div>
            </a>
            <a href="{{ route('project.detail', $next['slug']) }}" class="next">
                <span class="k">Next project →</span>
                <div class="t">{{ $next['title'] }}</div>
            </a>
        </div>
    </div>
</div>
