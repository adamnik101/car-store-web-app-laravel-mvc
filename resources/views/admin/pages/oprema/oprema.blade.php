@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main" style="display:flex;">
        <div style="margin-right: 3vw;">
            <h1>Informacije o opremi</h1>
            <div class="prikaz">
                <table class="oglasi" style="width: 40vw">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Oprema</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($oprema as $o)
                        <tr>
                            <td>{{(($oprema->currentPage() - 1 ) * $oprema->perPage() ) + $loop->iteration}}</td>
                            <td>{{$o->naziv}}</td>
                            <td><a href="{{route('opremaIzmeniForma', ['id' => $o->id])}}">Izmeni</a></td>
                            <td><form action="{{route('opremaObrisi',['id' => $o->id])}}" method="post">@csrf<input type="submit" value="Obrisi"></form></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$oprema->links()}}
            </div>
            @if(session()->has('message'))
                <p class="error-msg {{session()->has('success') ? "success" : ""}}">{{session()->get('message')}}</p>
            @endif
        </div>
        <div>
            <h1>Dodaj novu dodatnu opremu</h1>
            <div class="prikaz">
                @component('components.form-insert-admin',['name' => 'oprema'])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
