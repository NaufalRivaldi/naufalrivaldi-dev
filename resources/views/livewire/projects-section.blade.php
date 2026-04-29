<section id="projects" x-data="projectFilter()">
    <div class="container">
        <div class="sec-header">
            <div>
                <div class="sec-eyebrow">// case studies</div>
                <h2 class="sec-title">Selected<br/><em>projects.</em></h2>
            </div>
            <p>Eight recent projects — from Filament admin dashboards to headless Next.js storefronts. Filter by the stack you care about.</p>
            <span class="btn btn-ghost" style="align-self:end;pointer-events:none">{{ count($projects) }} shown</span>
        </div>

        <div class="projects-filter">
            <template x-for="tag in tags" :key="tag">
                <button
                    class="filter-btn"
                    :class="{ active: filter === tag }"
                    @click="filter = tag"
                >
                    <span x-text="tag"></span>
                    <span class="count">/ <span x-text="counts[tag]"></span></span>
                </button>
            </template>
        </div>

        <div class="projects-grid">
            @foreach ($projects as $project)
                <a
                    href="{{ route('project.detail', $project['slug']) }}"
                    class="project reveal"
                    style="text-decoration:none;color:inherit;display:block"
                    x-show="filter === 'All' || {{ json_encode($project['tech']) }}.includes(filter)"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    wire:key="project-{{ $project['id'] }}"
                >
                    <div class="project-thumb">
                        <div class="browser-chrome"><i></i><i></i><i></i></div>
                        <div class="pv">
                            <div class="bar accent"></div>
                            <div class="bar"></div>
                            <div class="bar short"></div>
                            <div class="grid-mini"><div></div><div></div><div></div></div>
                        </div>
                    </div>
                    <div class="project-body">
                        <div class="project-meta">
                            <span class="badge">{{ $project['tag'] }}</span>
                            <span>·</span>
                            <span>{{ $project['year'] }}</span>
                            @if ($project['featured'])
                                <span>·</span><span>★ Featured</span>
                            @endif
                        </div>
                        <h3>{{ $project['title'] }}</h3>
                        <p>{{ $project['desc'] }}</p>
                        <div class="project-tags">
                            @foreach ($project['tech'] as $tech)
                                <span>{{ $tech }}</span>
                            @endforeach
                        </div>
                        <span class="project-cta">
                            View case study
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="12" height="12"><path d="M7 17L17 7M17 7H8M17 7V16" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('projectFilter', () => ({
            filter: 'All',
            allTechs: @json($allTechs),
            projects: @json(array_column($projects, 'tech')),
            get tags() {
                return ['All', ...this.allTechs];
            },
            get counts() {
                const c = { All: this.projects.length };
                this.allTechs.forEach(t => {
                    c[t] = this.projects.filter(p => p.includes(t)).length;
                });
                return c;
            },
        }));
    });
</script>
