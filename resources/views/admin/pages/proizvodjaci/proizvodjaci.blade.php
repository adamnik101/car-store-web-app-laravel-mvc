@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main" style="display: flex;">
        <div style="margin-right: 3vw;">
            <h1>Informacije o svim proizvodjacima</h1>
            <div class="prikaz">
                <table class="oglasi">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Proizvodjac</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($proizvodjaci as $p)
                        <tr>
                            <td>{{(($proizvodjaci->currentPage() - 1 ) * $proizvodjaci->perPage() ) + $loop->iteration}}</td>
                            <td>{{$p->naziv}}</td>
                            <td><a href="{{route('proizvodjacIzmeniForma', ['id' => $p->id])}}">Izmeni</a></td>
                            <td><form action="{{route('proizvodjacObrisi',['id' => $p->id])}}" method="post">@csrf<input type="submit" value="Obrisi"></form></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$proizvodjaci->links()}}
            </div>
            @if(session()->has('message'))
               <p class="error-msg {{session()->has('success') ? "success" : ""}}"> {{session()->get('message')}}</p>
            @endif
        </div>
        <div>
            <h1>Dodaj novog proizvodjaca</h1>
            <div class="prikaz">
                @component('components.form-insert-admin',['name' => 'proizvodjac'])
                @endcomponent
            </div>
        </div>


    </div>
@endsection
