@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main">
        <div class="stats">
            <div class="stat">
                <span>{{$korisnici->count()}}</span>
                <p>Broj korisnika</p>
            </div>
            <div class="stat">
                <span>{{$registrovani24}}</span>
                <p>Broj novih korisnika u poslednja 24 sata</p>
            </div>
            <div class="stat">
                <span>{{$logovani24}}</span>
                <p>Korisnici ulogovani u poslednja 24 sata</p>
            </div>
            <div class="stat">
                <span>{{$oglasi->count()}}</span>
                <p>Broj aktivnih oglasa</p>
            </div>
            <div class="stat">
                <span>{{$noviOglasi24}}</span>
                <p>Broj novih oglasa u poslednja 24 sata</p>
            </div>
        </div>
    </div>
@endsection
