@extends('layouts.layout')

@section('title') Pocetna @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row add">
            <div class="home-top add1" style="display: block">
                <h1>Osnovne informacije</h1>
                <div class="infos">
                    <p>Ime i prezime: {{$korisnik->ime . " " . $korisnik->prezime}}</p>
                    <p>Email: {{$korisnik->email}}</p>
                    <p>Telefon: {{$korisnik->telefon}}</p>
                </div>
            </div>
            <div class="add-button">
                <a href="{{route('formaOglas')}}"><button type="button">Postavi novi oglas</button></a>
            </div>
        </div>
        <div class="home-latest">
            @if(session()->has('message'))
                    <p class="error-msg">{{session()->get('message')}}</p>
                @endif
            <div class="message">

            </div>
            <div class="home-latest-header">
                <h4>Vasi aktivni oglasi </h4>
            </div>
            <div class="home-latest-body comps">
                @if($oglasi->isEmpty())
                    <p>Niste postavili nijedan oglas.</p>
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
