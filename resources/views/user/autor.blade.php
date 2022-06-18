@extends('layouts.layout')

@section('title') Pocetna @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row">
            <div class="home-top autor">
                <h1>Adam Nikolic 101/19</h1>
                <div class="img-text">
                    <img src="{{asset('assets/img/autor.jpg')}}">
                    <p>Hi. I'm a web developer from Požega, Serbia. Right now I'm studying Internet Technologies at Information and Communication Technologies College in Belgrade and I'm pursuing career in Web programming.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
