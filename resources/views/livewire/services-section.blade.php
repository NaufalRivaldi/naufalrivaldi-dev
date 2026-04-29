<section id="services">
    <div class="container">
        <div class="sec-header">
            <div>
                <div class="sec-eyebrow">// services</div>
                <h2 class="sec-title">What I'm<br/><em>offering.</em></h2>
            </div>
            <p>Four focus areas where I do my best work. Each one backed by years of shipping production code for teams across Southeast Asia and Singapore.</p>
            <a href="#contact" class="btn btn-ghost" style="align-self:end">All Services</a>
        </div>

        <div class="services-grid">
            @foreach ($services as $service)
                <a
                    href="{{ route('service.detail', $service['slug']) }}"
                    class="service{{ $service['featured'] ? ' featured' : '' }} reveal"
                    data-n="{{ $service['n'] }}"
                    style="text-decoration:none;color:inherit;display:block"
                >
                    <div class="icon-box">
                        @if ($service['icon'] === 'code')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 9l-4 3 4 3M16 9l4 3-4 3M14 6l-4 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        @elseif ($service['icon'] === 'server')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="4" width="18" height="7" rx="1.5"/><rect x="3" y="13" width="18" height="7" rx="1.5"/><path d="M7 7.5h.01M7 16.5h.01M11 7.5h4M11 16.5h4" stroke-linecap="round"/></svg>
                        @elseif ($service['icon'] === 'phone')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="7" y="2.5" width="10" height="19" rx="2.5"/><path d="M11 18.5h2" stroke-linecap="round"/></svg>
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><ellipse cx="12" cy="5" rx="8" ry="2.5"/><path d="M4 5v7c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5V5"/><path d="M4 12v7c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5v-7"/></svg>
                        @endif
                    </div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['desc'] }}</p>
                    <span class="read-more">
                        Read more
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12" class="arrow"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
