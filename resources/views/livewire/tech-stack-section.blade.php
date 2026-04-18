<section id="stack">
    <div class="container">
        <div class="sec-header">
            <div>
                <div class="sec-eyebrow">// stack</div>
                <h2 class="sec-title">The<br/><em>toolbox.</em></h2>
            </div>
            <p>What I reach for. Deep specialization in the Laravel ecosystem, with enough frontend range to build the full stack without slowing down.</p>
            <span class="btn btn-ghost" style="align-self:end;pointer-events:none">{{ count($stackItems) }} core tools</span>
        </div>

        <div class="tech-wrap reveal">
            <div class="tech-header">
                <div class="dots"><i></i><i></i><i></i></div>
                <span class="path">~/<b>naufal</b>/stack.json <span style="color:var(--fg-subtle)">— updated 2026.04</span></span>
            </div>
            <div class="tech-body">
                @foreach ($stackItems as $item)
                    <div class="tech-item{{ $item['primary'] ? ' primary' : '' }}" wire:key="stack-{{ $item['name'] }}">
                        <span class="tag">// {{ $item['tag'] }}</span>
                        <span class="name">{{ $item['name'] }}</span>
                        <div class="bar">
                            <i style="width:{{ $item['level'] }}%"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
