@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main" style="display: flex;">
        <div style="margin-right: 3vw;">
            <h1>Informacije o sigurnosnoj opremi</h1>
            <div class="prikaz">
                <table class="oglasi">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Sigurnost</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sigurnost as $s)
                        <tr>
                            <td>{{(($sigurnost->currentPage() - 1 ) * $sigurnost->perPage() ) + $loop->iteration}}</td>
                            <td>{{$s->naziv}}</td>
                            <td><a href="{{route('sigurnostIzmeniForma', ['id' => $s->id])}}">Izmeni</a></td>
                            <td><form action="{{route('sigurnostObrisi',['id' => $s->id])}}" method="post">@csrf<input type="submit" value="Obrisi"></form></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$sigurnost->links()}}
            </div>
            @if(session()->has('message'))
                <p class="error-msg {{session()->has('success') ? "success" : ""}}"> {{session()->get('message')}}</p>
            @endif
        </div>
        <div>
            <h1>Dodaj novu sigurnosnu opremu</h1>
            <div class="prikaz">
                @component('components.form-insert-admin',['name' => 'sigurnost'])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
