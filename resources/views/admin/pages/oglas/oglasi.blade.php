@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main">
        <h1>Informacije o aktivnim oglasima</h1>
        <div class="prikaz">
            <table class="oglasi">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Slika</th>
                    <th>Godiste</th>
                    <th>Boja</th>
                    <th>Postavljen</th>
                    <th>Izmenjen</th>
                    <th>Grad</th>
                    <th>Cena</th>
                    <th>Postavio</th>
                    <th>Izmeni</th>
                    <th>Obrisi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($aktivniOglasi as $o)
                    <tr>
                        <td>{{(($aktivniOglasi->currentPage() - 1 ) * $aktivniOglasi->perPage() ) + $loop->iteration}}</td>
                       <td>{{$o->model->proizvodjac->naziv}}</td>
                        <td>{{$o->model->naziv}}</td>
                        <td><img src="@foreach($o->slika as $slika)
                                        @if($slika->main == 1)
                                        {{asset('assets/img/oglasi/'.$slika->url)}}
                                @endif
                            @endforeach
                                " alt="auto"></td>
                        <td>{{$o->godiste->godina}}.</td>
                        <td>{{$o->boja->naziv}}</td>
                        <td>{{$o->created_at}}</td>
                        <td>{{$o->updated_at == $o->created_at ? "Nije izmenjen" : $o->updated_at}}</td>
                        <td>{{$o->grad->naziv}}</td>
                        <td>{{$o->cena}} <i class="fa fa-euro"></i></td>
                        <td>{{$o->korisnik->ime . " " .$o->korisnik->prezime}}</td>
                        <td><a href="{{route('izmeniOglasForma',['id' => $o->id])}}">Izmeni</a></td>
                        <td><form action="{{route('obrisiOglas',['id' => $o->id])}}" method="post">@csrf<input type="submit" value="Obrisi"></form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$aktivniOglasi->links()}}
        </div>
        <h1>Informacije o obrisanim oglasima</h1>
        <div class="prikaz">
            <table class="oglasi">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Marka</th>
                    <th>Model</th>
                    <th>Slika</th>
                    <th>Godiste</th>
                    <th>Boja</th>
                    <th>Postavljen</th>
                    <th>Obrisan</th>
                    <th>Grad</th>
                    <th>Cena</th>
                    <th>Postavio</th>
                </tr>
                </thead>
                <tbody>
                @foreach($obrisaniOglasi as $o)
                    <tr>
                        <td>{{(($obrisaniOglasi->currentPage() - 1 ) * $obrisaniOglasi->perPage() ) + $loop->iteration}}</td>
                        <td>{{$o->model->proizvodjac->naziv}}</td>
                        <td>{{$o->model->naziv}}</td>
                        <td><img src="@foreach($o->slika as $slika)
                            @if($slika->main == 1)
                            {{asset('assets/img/oglasi/'.$slika->url)}}
                            @endif
                            @endforeach
                                " alt="auto"></td>
                        <td>{{$o->godiste->godina}}.</td>
                        <td>{{$o->boja->naziv}}</td>
                        <td>{{$o->created_at}}</td>
                        <td>{{$o->updated_at}}</td>
                        <td>{{$o->grad->naziv}}</td>
                        <td>{{$o->cena}} <i class="fa fa-euro"></i></td>
                        <td>{{$o->korisnik->ime . " " .$o->korisnik->prezime}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$obrisaniOglasi->onEachSide(2)->links()}}
        </div>
    </div>
@endsection
