<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('dashboard.index')}}">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('comments.softDelete')}}">Deleted comments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('posts.softDelete')}}">Deleted posts</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('dashboard.logout')}}">Logout?</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
