<aside class="position-fixed h-100 p-2 inactive" id="side-nav">
    <div class="container-fluid h-100 rounded-3 p-0 primary-shadow">
        <header class="bg-dark side-header"
                style="">
            <div class="d-flex flex-column justify-content-center align-items-center px-0 position-relative">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                     alt="Generic placeholder image" class="img-fluid img-thumbnail mt-3 mb-2 rounded-3"
                     style="width: 150px; z-index: 1">
                <a href="#" class="btn text-dark profile-edit">
                    <i class="fas fa-pencil"></i>
                </a>
                <span class="fw-bold text-dark">John Newman </span>
                <span class="fw-light">john@gmail.com</span>
            </div>
        </header>
        <ul class="pl-0 border-top border-1 links">
            <li>
                <a href="{{url('/shelf')}}" class="sidenav-btn sidenav-link text-dark">
                    <i class="fa-solid fa-home pr-1"></i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="{{url('my/history')}}" class="sidenav-btn sidenav-link text-dark">
                    <i class="fa-solid fa-clock pr-1"></i>
                    <span>History</span>
                </a>
            </li>
            <li>
                <a href="{{url('my/favorites')}}" class="sidenav-btn sidenav-link text-dark">
                    <i class="fa-solid fa-heart pr-1"></i>
                    <span>Favorites</span>
                </a>
            </li>
            <li>
                <a href="{{url('my/notifications')}}" class="sidenav-btn sidenav-link text-dark">
                    <i class="fa-solid fa-bell pr-1"></i>
                    <span>Notifications</span>
                </a>
            </li>
            @if(count($tables) > 0)
                <li class="sidenav-btn sidenav-drop">
                <span class="sidenav-btn sidenav-link sidenav-drop-btn text-dark">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Tables</span>
                    <i class="fas fa-angle-down rotate-icon"></i>
                </span>
                    <ul class="sub-links text-dark">
                        @foreach($tables as $item)
                            @if($table  && $table == $item['singular'])
                                @continue
                            @endif
                            <li>
                                <a href="{{route($item['index'] ?? '#')}}"
                                   class="sidenav-btn sidenav-link text-dark">
                                    <span>{{$item['name']}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        </ul>
        <footer class="d-flex justify-content-center align-items-center sidebar-footer" style="height: max-content">
            <span class="fw-light text-dark"> © <span
                    class="fw-bold">{{date('Y')}}</span>, made by Higor Grigorio.</span>
        </footer>
    </div>
</aside>
