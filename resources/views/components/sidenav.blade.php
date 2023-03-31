<aside class="position-fixed h-100 p-2 inactive" id="side-nav"
       style="width: 300px;">
    <div class="h-100 rounded primary-shadow position-relative">
        <header class="container-fluid profile border-bottom d-flex flex-column justify-content-center h-auto">
            <div class="profile-wrapper d-flex justify-content-center align-items-center">
                <div class="profile-image-wrapper d-flex align-items-center ">
                    <img src="https://i.pravatar.cc/150?img=1" alt="profile image"
                         class="profile-image rounded-circle  primary-shadow">
                </div>
                <div class="profile-info-wrapper d-flex flex-column justify-content-start align-items-start px-3">
                    <div class="profile-name-wrapper">
                        <h4 class="profile-name m-0">John Doe</h4>
                    </div>
                    <div class="profile-email-wrapper">
                        <p class="profile-email fs-6 text-nowrap m-0">johndoe@gmail.com</p>
                    </div>
                </div>
            </div>
        </header>
        <div class="links-wrapper">
            <ul class="nav flex-column px-2 gap-2  pt-4">
                <li class="nav-item text-dark">
                    <a href="#" class="btn btn-outline-smoke d-flex align-items-center gap-1">
                        <i class="ph-fill ph-squares-four"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-outline-smoke d-flex align-items-center gap-1 active">
                        <i class="ph-fill ph-heart"></i>
                        <span>Favorites</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-outline-smoke d-flex align-items-center gap-1">
                        <i class="ph-fill ph-book"></i>
                        <span>Books</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="btn btn-outline-smoke d-flex align-items-center gap-1">
                        <i class="ph ph-clock-counter-clockwise"></i>
                        <span>Historic</span>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="btn-group dropend w-100">
                        <button type="button" class="btn text-lg-start dropdown-toggle btn-outline-smoke d-flex align-items-center gap-1"  data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="ph ph-columns"></i>
                            Tables
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" href="#">Country</a></li>/
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <img class="position-absolute footer-img" src="{{asset('images/library-sidebar-background.jpg')}}"
             alt="Image of footer">
    </div>
</aside>
