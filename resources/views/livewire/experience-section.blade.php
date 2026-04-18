<section id="experience">
    <div class="container">
        <div class="sec-header">
            <div>
                <div class="sec-eyebrow">// experience</div>
                <h2 class="sec-title">Where I've<br/><em>shipped code.</em></h2>
            </div>
            <p>Six+ years writing PHP and shipping Laravel apps — with the last two spent architecting systems used by a global audience from a Singapore-based team.</p>
            <span class="btn btn-ghost" style="align-self:end;pointer-events:none">6+ yrs total</span>
        </div>

        <div class="exp-list reveal">
            @foreach ($experience as $item)
                <div class="exp-item" wire:key="exp-{{ $item['idx'] }}">
                    <span class="idx">{{ $item['idx'] }} /</span>
                    <div class="role">
                        <h4>{{ $item['role'] }}</h4>
                        <span class="company">
                            {{ $item['company'] }}
                            <span class="dot-sep">·</span>
                            {{ $item['location'] }}
                        </span>
                    </div>
                    <span class="duration">Duration — {{ $item['duration'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
