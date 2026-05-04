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
                    href="{{ route('service.detail', $service->slug) }}"
                    class="service{{ $service->is_featured ? ' featured' : '' }} reveal"
                    data-n="{{ sprintf('%02d', $loop->iteration) }}"
                >
                    <div class="icon-box">
                        <x-service-icon :icon="$service->icon" :size="22" />
                    </div>
                    <h3>{{ $service->title }}</h3>
                    <p>{{ $service->subtitle }}</p>
                    <span class="read-more">
                        Read more
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12" class="arrow"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>
