
<nav class="navbar navbar-expand-md hide-desck shadow-sm nav-custon nav-mobile ">
    <div class="container">
        <ul class="menu-mobile">
            @foreach ($menu as $link=>$item)
                @if($item['mobile'])
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($link) }}" title="{{$item['title']}}">
                           <i class="{{$item['icon']}} fa-2x"></i> 
                           <span>{{$item['title']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
       
    </div>
</nav>

