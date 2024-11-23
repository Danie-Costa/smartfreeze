
<nav class="navbar navbar-expand-md hide-desck shadow-sm nav-custon header-mobile ">
    <div class="container">
        <ul class="menu-mobile">
            <li class="nav-item">
                <a href="{{ url()->previous() }}" class="nav-link">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </li>
            <li class="nav-item item">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </li>
            <li class="nav-item end">
                <div class="btn-group dropleft">
                    <a href="javascript:;"  class="dropdown-toggle nav-item" data-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </div>
     
            </li>
        </ul>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>

