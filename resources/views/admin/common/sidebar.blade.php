<div class="admin-sidebar">
    <div class="admin-name">
        <p>Dobro dosli {{session()->get('korisnik')->ime . " " .session()->get('korisnik')->prezime}}!</p>
    </div>
    <div class="links">
        <ul>
            <li><a href="{{route('admin')}}" class="{{request()->is('admin') ? 'active' : ""}}">Glavna stranica</a></li>
            <li><a href="{{route('korisnici')}}" class="{{request()->is('admin/korisnici') || request()->is('admin/korisnici/izmeni*') ? 'active' : ""}}">Korisnici</a></li>
            <li><a href="{{route('oglasi')}}" class="{{request()->is('admin/oglasi*') ? 'active' : ""}}">Oglasi</a></li>
            <li><a href="{{route('akcije')}}" class="{{request()->is('admin/korisnici/akcije*') ? 'active' : ""}}">Akcije korisnika</a></li>
            <li><a href="{{route('proizvodjaci')}}" class="{{request()->is('admin/proizvodjaci*') ? 'active' : ""}}">Upravljaj proizvodjacima</a></li>
            <li><a href="{{route('modeli')}}" class="{{request()->is('admin/modeli*') ? 'active' : ""}}">Upravljaj modelima</a></li>
            <li><a href="{{route('oprema')}}" class="{{request()->is('admin/oprema*') ? 'active' : ""}}">Upravljaj dodatnom opremom</a></li>
            <li><a href="{{route('sigurnost')}}" class="{{request()->is('admin/sigurnost*') ? 'active' : ""}}">Upravljaj sigurnosnom opremom</a></li>
        </ul>
    </div>
</div>
