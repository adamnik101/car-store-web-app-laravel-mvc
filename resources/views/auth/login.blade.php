@extends('layouts.layout')

@section('title') Uloguj se @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="register-image">
        <img src="{{asset('assets/img/login-image.jpg')}}" alt="car-image">
    </div>
    <div class="register-wrapper">
        <div class="register-header">
            <h3>Uloguj se sada!</h3>
            <p>Ako već imate nalog unesite email adresu i lozinku</p>
        </div>
        <div class="register-form">
            <form action="{{route('doLogin')}}" method="POST">
                @csrf
                <div class="input-wrapper l-input">
                    <label for="email">Mail adresa: </label>
                    @if($errors->any())
                        <p style="color: red;">{{$errors->first()}}</p>
                    @endif
                    <input type="email" name="email" id="email">
                </div>
                <div class="input-wrapper l-input">
                    <label for="password">Tvoja lozinka: </label>
                    <input type="password" name="lozinka" id="password" >
                </div>

                <div class="input-wrapper">
                    <input type="submit" name="submit" id="submit" value="Uloguj se">
                </div>
            </form>
        </div>
        <div class="already-registered">
            <p>Nemaš nalog? <a href="{{route('register')}}">Registruj se</a></p>
{{--            <a href="{{route('resetPassword')}}">Zaboravili ste lozinku?</a> --}}
        </div>
    </div>
@endsection
