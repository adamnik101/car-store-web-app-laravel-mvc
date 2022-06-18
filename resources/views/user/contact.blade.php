@extends('layouts.layout')

@section('title') Kontakt @endsection
@section('description') Kontakt stranica sajta @endsection
@section('keywords') kontakt, polovni, automobili, prodaja, kupovina @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row">
            <div class="home-top autor">
                <h1>Posalji poruku administratoru</h1>
                <div class="contact-admin">
                    <form action="{{route('posaljiMail')}}" method="post">
                        @csrf
                        @if($errors->has('email'))
                            <div class="errors">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                        <input type="email" name="email" placeholder="Tvoj email:">
                        @if($errors->has('subject'))
                            <div class="errors">
                                {{$errors->first('subject')}}
                            </div>
                        @endif
                        <input type="text" name="subject" placeholder="Tema:">
                        @if($errors->has('text'))
                            <div class="errors">
                                {{$errors->first('text')}}
                            </div>
                        @endif
                        <textarea name="text" placeholder="Sadrzaj:"></textarea>

                        <input type="submit" value="Posalji poruku">
                    </form>
                </div>
                @if(session()->has('msg'))
                    <div class="message">
                        <p>{{session()->get('msg')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
