@extends('layouts.layout')

@section('title') Pocetna @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row">
            <div class="home-top">
                <h1>Automobili</h1>
            </div>

            <form action="{{route('izvrsiPretragu')}}" method="GET">
                @csrf
                <div class="main-search">
                    <img src="{{asset('assets/img/search-form.png')}}" alt="new-car">
                    <div class="form-group">
                        <select name="marka" id="proizvodjac">
                            <option value="0">Izaberi marku:</option>

                            @foreach($model as $m)
                                <option {{$requests->get('marka') == $m->id ? 'selected' : ''}} value="{{$m->id}}"> {{$m->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="model" id="model">
                            <option value="0">Izaberi model</option>
                            @foreach($marka as $m)
                                @if($m->proizvodjac_id == $requests->get('marka'))
                                    <option value="{{$m->id}}" {{$requests->get('model') == $m->id ? "selected" : ''}}>{{$m->naziv}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="cenaOd" class="euro-icon" placeholder="Cena od:" value="{{$requests->get('cenaOd') != null ? $requests->get('cenaOd') : null}}">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <div class="form-group">
                        <input type="number" name="cenaDo" class="euro-icon" placeholder="Cena do:" value="{{$requests->get('cenaDo') != null ? $requests->get('cenaDo') : null}}">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <div class="form-group godiste">
                        <select name="godisteOd">
                            <option value="0">Godiste od</option>
                            @foreach($godiste as $g)
                                <option {{$g->id == $requests->get('godisteOd') ? 'selected' : ""}} value="{{$g->id}}"> {{$g->godina}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group godiste">
                        <select name="godisteDo">
                            <option value="0">do</option>
                            @foreach($godiste as $g)
                                <option {{$g->id == $requests->get('godisteDo') ? 'selected' : ""}} value="{{$g->id}}"> {{$g->godina}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="karoserija">
                            <option value="0">Izaberi karoseriju</option>
                            @foreach($karoserija as $k)
                                <option {{$k->id == $requests->get('karoserija') ? 'selected' : ""}} value="{{$k->id}}"> {{$k->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="gorivo" >
                            <option value="0">Vrsta goriva</option>
                            @foreach($gorivo as $g)
                                <option {{$g->id == $requests->get('gorivo') ? 'selected' : ""}} value="{{$g->id}}"> {{$g->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="brojVrata">
                            <option value="0">Broj vrata</option>
                            @foreach($vrata as $v)
                                <option {{$v->id == $requests->get('brojVrata') ? 'selected' : ""}} value="{{$v->id}}"> {{$v->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Obelezje" name="obelezje" value="{{$requests->get('obelezje') != null ? $requests->get('obelezje') : null}}">
                    </div>
                    <div class="form-group resetuj">
                        <input type="reset" value="Resetuj pretragu">
                    </div>
                    <div class="form-group detail">
                        <a href="{{route('pretraga')}}"><input type="button" id='pretraga' value="Detaljna pretraga"></a>
                    </div>
                    <div class="form-group pretraga">
                        <input type="submit" value="Pretrazi">
                    </div>
                </div>
            </form>
        </div>
        <div class="home-latest">
            <div class="home-latest-header">
                <h4>Pronadjeni oglasi </h4>
            </div>
                    <div class="home-latest-body comps">
                        @if($oglasi->isEmpty())
                                <p>Nema oglasa koji odgovaraju vasem kriterijumu.</p>
                            @endif
                        @foreach($oglasi as $oglas)
                            @component('components.oglas',['oglas' => $oglas, 'slide' => false])
                            @endcomponent
                        @endforeach
                    </div>
                    {{$oglasi->links()}}
        </div>
    </div>
@endsection
