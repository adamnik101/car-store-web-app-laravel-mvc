 <a class="card {{$slide == true ? "splide__slide" : ""}}" href="{{route('prikazOglasa', ['id'=> $oglas->id])}}">
        <div class="card-header">
            {{--                                    {{$oglas->slika[0]->main == 1 ? asset('assets/img/'.$oglas->slika[0]->url) : ""}}--}}
            <img src="
                                    @foreach($oglas->slika as $o)
            @if($o->main == 1)
            {{asset('assets/img/oglasi/'.$o->url)}}
            @endif
            @endforeach
                " alt="car">
        </div>
        <div class="card-body">
            <h3>{{$oglas->model->proizvodjac->naziv . " " . $oglas->model->naziv . " " . $oglas->obelezje}}</h3>
            <p>{{$oglas->gorivo->naziv}}</p>
            <p>{{$oglas->karoserija->naziv}}</p>
            <p>{{$oglas->kilometraza}} km</p>
            <p>{{$oglas->godiste->godina}}</p>
            <p>{{$oglas->pogon->naziv}}</p>
            <p>{{$oglas->menjac->naziv}}</p>
        </div>

        <div class="card-footer">
            <p><i class="fa-solid fa-location-dot"></i> {{$oglas->grad->naziv}}</p>
            <p class="cena">{{$oglas->cena}}  <i class="fa-solid fa-euro-sign"></i></p>
        </div>
    </a>
