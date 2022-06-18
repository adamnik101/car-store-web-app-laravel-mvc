@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main">
        <h1>Informacije o korisnicima</h1>
        <div class="prikaz">
            <table>
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Ime i prezime
                        </th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Uloga</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($korisnici as $k)
                    @if($k->id == session()->get('korisnik')->id)
                        @continue
                    @endif
                    <tr>
                        <td>{{(($korisnici->currentPage() - 1 ) * $korisnici->perPage() ) + $loop->iteration}}</td>
                        <td>{{$k->ime .' '. $k->prezime}}</td>
                        <td>{{$k->email}}</td>
                        <td>{{$k->telefon}}</td>
                        <td>{{$k->id_uloga == 1 ? 'Korisnik' : 'Admin'}}</td>
                        <td><a href="{{route('izmeniKorisnika',['id' => $k->id])}}"><i class="fa fa-edit"></i></a></td>
                        <td>
                            <form action="{{route('obrisiKorisnika',['id'=>$k->id])}}" method="post">
                                @csrf
                                <input type="submit" class='obrisi' value="Obrisi">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$korisnici->links()}}
            @if(session()->has('message'))
               <p class="error-msg {{session()->has('success') ? "success" : ""}}"> {{session()->get('message')}}</p>
            @endif
        </div>
    </div>
@endsection
