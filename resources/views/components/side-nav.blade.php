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
            <li class="sidenav-btn sidenav-link">
                <a href="{{url('/shelf')}}" class="text-dark">
                    <i class="fa-solid fa-home pr-1"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="sidenav-btn sidenav-link">
                <a href="{{url('user/history')}}" class="text-dark">
                    <i class="fa-solid fa-clock pr-1"></i>
                    <span>History</span>
                </a>
            </li>
            <li class="sidenav-btn sidenav-link">
                <a href="{{url('user/favorites')}}" class="text-dark">
                    <i class="fa-solid fa-heart pr-1"></i>
                    <span>Favorites</span>
                </a>
            </li>
            <li class="sidenav-btn sidenav-link">
                <a href="{{url('user/notifications')}}" class="text-dark">
                    <i class="fa-solid fa-bell pr-1"></i>
                    <span>Notifications</span>
                </a>
            </li>
            <li class="sidenav-btn sidenav-drop">
                <span class="sidenav-btn sidenav-link sidenav-drop-btn text-dark">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Tables</span>
                    <i class="fas fa-angle-down rotate-icon"></i>
                </span>
                <ul class="sub-links text-dark">
                    @foreach($tables as $table)
                        <li class="sidenav-btn sidenav-link
                            @if($currentEditingTable  && $currentEditingTable == $table)
                                active
                            @endif ">
                            <span>{{$table}}</span>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        <footer class="d-flex justify-content-center align-items-center sidebar-footer" style="height: max-content">
            <span class="fw-light text-dark"> © <span class="fw-bold">{{date('Y')}}</span>, made by Higor Grigorio.</span>
        </footer>
    </div>
</aside>
