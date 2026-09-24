{{-- Öne çıkan projeler listesi. $projects, $heading (isteğe bağlı) --}}
@if ($projects->isNotEmpty())
    <div class="featured-works-list position-relative">
        @foreach ($projects as $i => $project)
            <div>
                <div class="featured-works-item {{ $loop->first ? 'effectFade fadeUp no-div' : '' }}">
                    <div class="image main-mouse-hover">
                        <img src="{{ \App\Support\Img::cover($project->image, $project->id) }}" alt="{{ $project->title }}" loading="lazy">
                        <a href="{{ $project->url() }}" class="tf-mouse view-project h6">
                            Projeyi İncele
                            <i class="icon icon-arrow-top-right"></i>
                        </a>
                    </div>
                    <div class="content">
                        <div class="pagi-dot">
                            @foreach ($projects as $j => $unused)
                                <span class="{{ $j === $i ? 'active' : '' }}"></span>
                            @endforeach
                        </div>
                        <div class="bot">
                            <h3 class="heading h4 fw-semibold"><a href="{{ $project->url() }}" class="link1">{{ $project->title }}</a></h3>
                            <div class="grid-text">
                                @if ($project->summary)
                                    <div class="item">
                                        <div class="title text-secondary">AÇIKLAMA</div>
                                        <div class="text-body-3 fw-semibold">{{ $project->summary }}</div>
                                    </div>
                                @endif
                                @if ($project->deliverables)
                                    <div class="item">
                                        <div class="title text-secondary">NELER YAPILDI</div>
                                        <div class="fw-semibold text-body-3">{{ $project->deliverables }}</div>
                                    </div>
                                @endif
                                @if ($project->category)
                                    <div class="item">
                                        <div class="title text-secondary">ALAN</div>
                                        <div class="fw-semibold text-body-3">{{ $project->category }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
