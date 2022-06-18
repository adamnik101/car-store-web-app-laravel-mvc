@extends('layouts.layout')

@section('title') Pocetna @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="home-wrapper ">
        <div class="main">
            <div class="home-top naslov-oglas oglas">
                <h1>{{$oglas[0]->model->proizvodjac->naziv . " " . $oglas[0]->model->naziv . " " . $oglas[0]->obelezje}}</h1>
                <h2>{{$oglas[0]->godiste->godina}}. godište</h2>
                @if(session()->has('korisnik'))
                    @if($oglas[0]->korisnik->id == session()->get('korisnik')->id || session()->get('korisnik')->id_uloga == 2)
                        <div class="btns">
                            <a href="{{route('izmeniOglasForma', ['id' => $oglas[0]->id])}}">Izmeni</a>
                            <form method="post" action="{{route('obrisiOglas', ['id' => $oglas[0]->id])}}"> @csrf<input type="submit" value="Obrisi"></form>
                        </div>
                    @endif
                @endif
            </div>
            <div class="row-img">
                <div class="carousel-main">
                    <section id="image-carousel" class="splide" aria-label="Beautiful Images">
                        <div class="splide__track">
                            <ul class="splide__list">

                                @foreach($oglas[0]->slika as $slika)
                                    <li class="splide__slide">
                                        <img src="{{asset('assets/img/oglasi/'.$slika->url)}}" alt="">
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </section>
                    <section
                        id="thumbnail-carousel"
                        class="splide"
                        aria-label="The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel."
                    >
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach($oglas[0]->slika as $slika)
                                    <li class="splide__slide">
                                        <img src="{{asset('assets/img/oglasi/'.$slika->url)}}" alt="">
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </section>
                </div>
                <div class="info">
                    <h4 class="naslov-plus">Opste informacije :</h4>
                    <p class="info-text"><span>Marka:</span> {{$oglas[0]->model->proizvodjac->naziv}}</p>
                    <p class="info-text"><span>Model:</span> {{$oglas[0]->model->naziv}}</p>
                    <p class="info-text"><span>Godiste:</span> {{$oglas[0]->godiste->godina}}.</p>
                    <p class="info-text"><span>Kilometraza:</span> {{$oglas[0]->kilometraza}} km</p>
                    <p class="info-text"><span>Karoserija:</span> {{$oglas[0]->karoserija->naziv}}</p>
                    <p class="info-text"><span>Gorivo:</span> {{$oglas[0]->gorivo->naziv}}</p>
                    <p class="info-text"><span>Pogon:</span> {{$oglas[0]->pogon->naziv}}</p>
                    <p class="info-text"><span>Registrovan do:</span> {{$oglas[0]->registrovan_do == null ? "Nije registrovan" : $oglas[0]->registrovan_do}}</p>
                    <p class="info-text"><span>Menjac:</span> {{$oglas[0]->menjac->naziv}}</p>
                    <p class="info-text"><span>Klima:</span> {{$oglas[0]->klima->naziv}}</p>
                    <p class="info-text"><span>Broj vrata:</span> {{$oglas[0]->vrata->naziv}}</p>
                    <p class="info-text"><span>Boja: </span>{{$oglas[0]->boja->naziv}}</p>
                    <p class="info-text"><span>Mesto: </span>{{$oglas[0]->grad->naziv}}</p>
                    <p class="info-text"><span>Kontakt: </span>{{$oglas[0]->korisnik->telefon}}</p>

                </div>
                <div class="price-section">
                    {{$oglas[0]->cena}} <i class="fa fa-euro"></i>
                </div>
            </div>
        </div>

        <div class="row details">
            <h3>Sigurnost</h3>
            <div class="equipment">
                @foreach($oglas[0]->sigurnost as $s)
                    <p>{{$s->naziv}}</p>
                @endforeach
            </div>
            <h3>Oprema</h3>
            <div class="equipment">
                @foreach($oglas[0]->oprema as $o)
                    <p>{{$o->naziv}}</p>
                @endforeach
            </div>
        </div>
        <div class="row details">
            <h3>Opis</h3>
            <p>{{$oglas[0]->opis != '' ? $oglas[0]->opis : "Nema opis"}}</p>
        </div>
    </div>
@endsection
