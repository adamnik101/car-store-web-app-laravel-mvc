@extends('layouts.layout')

@section('title') Pocetna @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row">
            <div class="home-top">
                <h1>Automobili</h1>
                <p>{{$brojOglasa}} oglasa, {{$brojKorisnika}} korisnika</p>
            </div>
            <form action="{{route('izvrsiPretragu')}}" method="GET">
                @csrf
            <div class="main-search">
                <img src="{{asset('assets/img/search-form.png')}}" alt="new-car">

                    <div class="form-group">
                        <select name="marka" id="proizvodjac">
                            <option value="0">Izaberi marku:</option>
                            @foreach($model as $m)
                                <option value="{{$m->id}}"> {{$m->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="model" disabled id="model">
                            <option value="0">Izaberi model</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="cenaOd" class="euro-icon" placeholder="Cena od:">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <div class="form-group">
                        <input type="number" name="cenaDo" class="euro-icon" placeholder="Cena do:">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <div class="form-group godiste">
                        <select name="godisteOd">
                            <option value="0">Godiste od</option>
                            @foreach($godiste as $g)
                                <option value="{{$g->id}}"> {{$g->godina}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group godiste">
                        <select name="godisteDo">
                            <option value="0">do</option>
                            @foreach($godiste as $g)
                                <option value="{{$g->id}}"> {{$g->godina}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="karoserija">
                            <option value="0">Izaberi karoseriju</option>
                            @foreach($karoserija as $k)
                                <option value="{{$k->id}}"> {{$k->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="gorivo" >
                            <option value="0">Vrsta goriva</option>
                            @foreach($gorivo as $g)
                                <option value="{{$g->id}}"> {{$g->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="brojVrata">
                            <option value="0">Broj vrata</option>
                            @foreach($vrata as $v)
                                <option value="{{$v->id}}"> {{$v->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Obelezje">
                    </div>
                    <div class="form-group resetuj">
                        <input type="reset" value="Resetuj pretragu">
                    </div>
                    <div class="form-group detail">
                        <a href="{{route('pretraga')}}"><input type="button" value="Detaljna pretraga"></a>
                    </div>
                    <div class="form-group pretraga">
                        <input type="submit" value="Pretrazi">
                    </div>
            </div>
            </form>
        </div>
        <div class="home-latest">
            <div class="home-latest-header">
                <h4>Najnoviji oglasi</h4>
            </div>
            <div class="splide">
                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="splide__track">
                    <div class="home-latest-body splide__list">
                        @foreach($najnovijiOglasi as $oglas)
                            @component('components.oglas',['oglas' => $oglas, 'slide' => true])
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="home-latest">
            <div class="home-latest-header">
                <h4>Oglasi koji ti se mozda svide</h4>
            </div>
            <div class="splide splide2">
                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="splide__arrow splide__arrow--next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
                <div class="splide__track">
                    <div class="home-latest-body splide__list">
                        @foreach($randomOglasi as $oglas)
                            @component('components.oglas',['oglas' => $oglas, 'slide' => true])
                            @endcomponent
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
