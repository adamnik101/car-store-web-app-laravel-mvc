@extends('layouts.layout')

@section('title') Registruj se @endsection
@section('description') Pocetna stranica sajta @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="register-image">
        <img src="{{asset('assets/img/register-image.jpg')}}" alt="car-image">
    </div>
    <div class="register-wrapper">
        <div class="register-header">
            <h3>Registruj se sada!</h3>
            <p>Ukoliko nemate nalog, molimo Vas da popunite sledeća polja traženim podacima.</p>
            <p>SVA POLJA OZNAČENA * SU OBAVEZNA UKOLIKO NIJE NAGLAŠENO DRUGAČIJE.</p>
        </div>
        <div class="register-form">
            <form action="{{route('doRegister')}}" method="POST">
                @csrf
                <div class="input-wrapper">
                    <label for="first-name">Tvoje ime: *</label>
                    <input type="text" name="ime" id="first-name"  value="{{old('ime')}}">
                    @if($errors->has('ime'))
                        <div class="errors">
                            {{$errors->first('ime')}}
                        </div>
                    @endif
                </div>
                <div class="input-wrapper">
                    <label for="last-name">Tvoje prezime: *</label>
                    <input type="text" name="prezime" id="last-name" value="{{old('prezime')}}">
                    @if($errors->has('prezime'))
                        <div class="errors">
                            {{$errors->first('prezime')}}
                        </div>
                    @endif
                </div>
                <div class="input-wrapper">
                    <label for="email">Mail adresa: *</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}">
                    @if($errors->has('email'))
                        <div class="errors">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="input-wrapper">
                    <label for="tel">Broj telefona: *</label>
                    <input type="tel" name="tel" id="tel" min="10" value="{{old('tel')}}">
                        @if($errors->has('tel'))
                            <div class="errors">
                                {{$errors->first('tel')}}
                            </div>
                        @endif
                </div>
                <div class="input-wrapper">
                    <label for="password">Tvoja lozinka: *</label>
                    <input type="password" name="password" id="password"  value="{{old('password')}}">

                        @if($errors->has('password'))
                        <div class="errors">
                            {{$errors->first('password')}}
                        </div>
                        @endif

                </div>
                <div class="input-wrapper">
                    <label for="password-confirm">Potvrdi lozinku: *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}" >

                        @if($errors->has('password_confirmation'))
                        <div class="errors">
                            {{$errors->first('password_confirmation')}}
                        </div>
                        @endif


                </div>
                <div class="input-wrapper">
                    <input type="submit" name="submit" id="submit" value="Registruj se">
                </div>
            </form>

        </div>
        <div class="already-registered">
            <p>Već imaš nalog? <a href="{{route('login')}}">Uloguj se</a></p>
        </div>
    </div>
@endsection
