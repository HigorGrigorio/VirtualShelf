<nav class="rounded-3 navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbar-buttons">
            <ul class="d-flex flex-row navbar-nav me-auto mb-lg-0 align-items-center">
                <a id="toggle-side-bar"
                   class="btn btn-ocean px-3 me-3"
                   type="button"
                   aria-label="Toggle navigation">
                    <i class="fas fa-bars p-0 m-0"></i>
                </a>
                <span class="text-black">
                    @foreach($breadCrumb as $word)
                        @if($loop->index == count($breadCrumb) - 1)
                            <span class="fw-bold">
                                    {{$word['name']}}
                            </span>
                        @elseif($word['route'] != null)
                            <a href="{{$word['route']}}" class="link-dark text-decoration-underline">
                                {{$word['name']}}
                            </a>
                            >
                        @else
                            {{$word['name']}} >
                        @endif
                    @endforeach
                </span>
            </ul>
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-link btn-floating">
                    <a href="#" class="text-dark">
                        <i class="fa-solid fa-bell"></i>
                    </a>
                </button>
                <button class="btn btn-link btn-floating">
                    <a href="#" class="text-dark">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                </button>
                @if(!$user)
                    <a class="btn btn-ocean px-3"
                       href="https://github.com/mdbootstrap/mdb-ui-kit"
                       role="button">
                        <i class="fa-solid fa-door-open me-3"></i>
                        Sign in
                    </a>
                @else
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-ocean px-3">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Log Out</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>
