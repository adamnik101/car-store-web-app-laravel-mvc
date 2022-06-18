@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main" style="display: flex">
        <div style="margin-right: 3vw;">
            <h1>Informacije o svim modelima</h1>
            <div class="prikaz">
                <table class="oglasi">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Model</th>
                        <th>Proizvodjac</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($modeli as $m)
                        <tr>
                            <td>{{(($modeli->currentPage() - 1 ) * $modeli->perPage() ) + $loop->iteration}}</td>
                            <td>{{$m->model}}</td>
                            <td>{{$m->proizvodjac}}</td>
                            <td><a href="{{route('modeliIzmeniForma', ['id' => $m->id])}}">Izmeni</a></td>
                            <td><form action="{{route('modeliObrisi',['id' => $m->id])}}" method="post">@csrf<input type="submit" value="Obrisi"></form></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$modeli->links()}}
            </div>
            @if(session()->has('message'))
                <p class="error-msg {{session()->has('success') ? "success" : ""}}">{{session()->get('message')}}</p>
            @endif
        </div>
        <div>
            <h1>Dodaj novi model automobila</h1>
            <div class="prikaz">
                @component('components.form-insert-admin',['name' => 'modeli', 'proizvodjac' => true, 'proizvodjaci' => $proizvodjaci])
                @endcomponent
            </div>
        </div>


    </div>
@endsection
