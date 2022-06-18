<div class="navigation-wrapper">
    <ul class="navigation-links">
        @foreach($navigation as $nav)
            @if(($nav->route == "register" || $nav->route == 'login') && session()->has('korisnik'))
                @continue
            @endif
            <li><a href="{{route($nav->route)}}">{{$nav->name}}</a></li>
        @endforeach
            @if(session()->has('korisnik'))
                <li><a href="{{route('profil')}}">Moj profil</a></li>
                <li><a href="{{route('logout')}}">Odjavi se</a></li>
                @if(session()->get('korisnik')->id_uloga == 2)
                    <li><a href="{{route('admin')}}">Admin panel</a></li>
                @endif
            @endif
    </ul>
</div>
