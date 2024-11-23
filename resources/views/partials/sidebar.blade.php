<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
      <ul class="nav flex-column">
        @foreach ($menu as $key => $item )
            @if(isset($item['sub-menu']))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if(Route::currentRouteName() == $key ) active @endif" href="{{route($key)}}" data-toggle="dropdown" aria-expanded="false">
                        <span data-feather="{{$item['icon']}}"></span>
                        {{ $item['title']}}
                    </a>
                    <div class="dropdown-menu">
                        @foreach ($item['sub-menu'] as $subkey => $submenu )
                            <a class="dropdown-item" href="{{route($subkey)}}">
                                <span data-feather="{{$submenu['icon']}}"></span>
                                {{$submenu['title']}}
                            </a>
                        @endforeach
                    </div>
                </li>
            @else
                <li class="nav-item ">
                    <a class="nav-link @if(Route::currentRouteName() == $key ) active @endif" href="{{route($key)}}">
                        <span data-feather="{{$item['icon']}}"></span>
                        {{ $item['title']}}
                    </a>
                </li>
            @endif
        @endforeach
        <li class="nav-item show-mobile">
            <a class="nav-link"  href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
      </ul>

    </div>
  </nav>
