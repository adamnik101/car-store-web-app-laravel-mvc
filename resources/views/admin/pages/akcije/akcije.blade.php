@extends('admin.layouts.layout')
@section('title') Admin panel @endsection
@section('description') Dobro dosli na admin panel sajta Polovni automobili! @endsection
@section('keywords') admin, polovni, automobili, prodaja, kupovina @endsection


@section('content')
    <div class="admin-main">
        <h1>Akcije korisnika</h1>
        <div class="sort">
            <form action="{{route('filterDatumAkcije')}}" method="get">
                <label for="sort">Izaberi datum:</label>
                <input type="date" name="datum" id="sort" value="{{isset($requests) ? $requests->datum : ""}}">
                <input type="submit" value="Pretrazi">
            </form>
        </div>
        <div class="prikaz">
            @if(!$akcije->count())
                <p class="message">Nema zapisa za izabrani datum!</p>
            @else
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Korisnik</th>
                    <th>Akcija</th>
                    <th>Zapis kreiran</th>
                </tr>
                </thead>
                <tbody id="table">



                @foreach($akcije as $a)
                    <tr>
                        <td>{{(($akcije->currentPage() - 1 ) * $akcije->perPage() ) + $loop->iteration}}</td>
                        <td>{{$a->korisnik->ime . ' '.$a->korisnik->prezime}}</td>
                        <td>{{$a->naziv}}</td>
                        <td>{{$a->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{$akcije->links()}}
            @endif
        </div>
    </div>
@endsection
