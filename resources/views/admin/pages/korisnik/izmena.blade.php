@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main">
        <h1>Informacije o korisniku</h1>
        <div class="prikaz">
            <form action="{{route('izmenaKorisnika',['id' => $korisnik->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="ime">Ime: </label>
                    <input type="text" id="ime" name="ime" value="{{$korisnik->ime}}">
                    @if($errors->has('ime'))
                        <div class="errors">
                            {{$errors->first('ime')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="prezime">Prezime: </label>
                    <input type="text" id="prezime" name="prezime" value="{{$korisnik->prezime}}">
                    @if($errors->has('prezime'))
                        <div class="errors">
                            {{$errors->first('prezime')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" id='email' name="email" value="{{$korisnik->email}}">
                    @if($errors->has('email'))
                        <div class="errors">
                            {{$errors->first('email')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="tel">Telefon: </label>
                    <input type="text" id="tel" name="tel" value="{{$korisnik->telefon}}">
                    @if($errors->has('tel'))
                        <div class="errors">
                            {{$errors->first('tel')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="uloga">Uloga: </label>
                    <select id="uloga" name="uloga">
                        @foreach($uloga as $u)
                            <option value="{{$u->id}}" {{$u->id == $korisnik->id_uloga ? 'selected' : ''}}> {{$u->naziv}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('uloga'))
                        <div class="errors">
                            {{$errors->first('uloga')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="pass">Nova lozinka: </label>
                    <input type="password" id="pass" name="password_new" placeholder="[Optional]">
                    @if($errors->has('password_new'))
                        <div class="errors">
                            {{$errors->first('password_new')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <input type="submit" id="submit" name="submit" value="Unesi izmene">
                </div>
            </form>
            @if(session()->has('message'))
                {{session()->get('message')}}
            @endif
        </div>
    </div>
@endsection
