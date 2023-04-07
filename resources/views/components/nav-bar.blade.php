<nav class="rounded-3 navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbar-buttons">
            <ul class="d-flex flex-row navbar-nav me-auto mb-lg-0 align-items-center">
                <a id="toggle-side-bar"
                   class="btn btn-dark px-3 me-3"
                   type="button"
                   aria-label="Toggle navigation">
                    <i class="fas fa-bars p-0 m-0"></i>
                </a>
                <span class="text-dark">
                    @foreach($currentPage as $word)
                        @if($loop->index == count($currentPage) - 1)
                            <span class="fw-bold">
                                {{$word}}
                            </span>
                        @else
                            {{$word}} /
                        @endif
                    @endforeach
                </span>
            </ul>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-link text-dark px-3 me-2">
                    Login
                </button>
                <button type="button" class="btn btn-dark me-3">
                    Sign up for free
                </button>
                <a
                    class="btn btn-dark px-3"
                    href="https://github.com/mdbootstrap/mdb-ui-kit"
                    role="button"
                ><i class="fab fa-github"></i
                    ></a>
            </div>
        </div>
    </div>
</nav>