@extends('layouts.layout')

@section('title') Pretraga @endsection
@section('description') Pretrazi automobile po svom kriterijumu i pronadji bas onakav kakav ti odgovara @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina, pretraga @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row">
            <div class="home-top">
                <h1>Pretraga</h1>
                <p>Unesi kriterijume koje imas i pronadji automobil koji ti odgovara</p>
            </div>
            <form action="{{route("izvrsiPretragu")}}" method="GET">
                @csrf
            <div class="main-search">
                <img src="{{asset('assets/img/search-form.png')}}" alt="new-car">

                    <div class="form-group">
                        <select name="marka" id="proizvodjac">
                            <option value="0">Izaberi marku:</option>
                            @foreach($model as $m)
                                <option value="{{$m->id}}"> {{$m->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="model" disabled id="model">
                            <option value="0">Izaberi model</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="cenaOd" class="euro-icon" placeholder="Cena od:">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <div class="form-group">
                        <input type="number" name="cenaDo" class="euro-icon" placeholder="Cena do:">
                        <i class="fa-solid fa-euro-sign"></i>
                    </div>
                    <div class="form-group godiste">
                        <select name="godisteOd">
                            <option value="0">Godiste od</option>
                            @foreach($godiste as $g)
                                <option value="{{$g->id}}"> {{$g->godina}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group godiste">
                        <select name="godisteDo">
                            <option value="0">do</option>
                            @foreach($godiste as $g)
                                <option value="{{$g->id}}"> {{$g->godina}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="karoserija">
                            <option value="0">Izaberi karoseriju</option>
                            @foreach($karoserija as $k)
                                <option value="{{$k->id}}"> {{$k->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="gorivo" >
                            <option value="0">Vrsta goriva</option>
                            @foreach($gorivo as $g)
                                <option value="{{$g->id}}"> {{$g->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="brojVrata">
                            <option value="0">Broj vrata</option>
                            @foreach($vrata as $v)
                                <option value="{{$v->id}}"> {{$v->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="grad">
                            <option value="0">Izaberi grad</option>
                            @foreach($grad as $g)
                                <option value="{{$g->id}}"> {{$g->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="klima">
                            <option value="0">Izaberi klimu</option>
                            @foreach($klima as $k)
                                <option value="{{$k->id}}"> {{$k->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="boja">
                            <option value="0">Izaberi boju</option>
                            @foreach($boja as $b)
                                <option value="{{$b->id}}"> {{$b->naziv}}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="form-group">
                    <select name="menjac">
                        <option value="0">Izaberi menjac</option>
                        @foreach($menjac as $m)
                            <option value="{{$m->id}}"> {{$m->naziv}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select name="pogon">
                        <option value="0">Izaberi pogon</option>
                        @foreach($pogon as $p)
                            <option value="{{$p->id}}"> {{$p->naziv}}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group">
                        <input type="text" name="obelezje" placeholder="Obelezje">
                    </div>
            </div>
            <div class="home-top">
                <h3>Sigurnost</h3>
            </div>
            <div class="main-search safety">
                @foreach($sigurnost as $s)
                    <div class="pretty p-icon p-smooth">
                        <input type="checkbox" name="sigurnost[]" value="{{$s->id}}"/>
                        <div class="state">
                            <i class="icon fa-solid fa-check"></i>
                            <label> {{$s->naziv}}</label>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="home-top">
                <h3>Oprema</h3>
            </div>
            <div class="main-search safety">
                @foreach($oprema as $o)
                    <div class="pretty p-icon p-smooth">
                        <input type="checkbox" name="oprema[]" value="{{$o->id}}"/>
                        <div class="state">
                            <i class="icon fa-solid fa-check"></i>
                            <label> {{$o->naziv}}</label>
                        </div>
                    </div>

                @endforeach

            </div>
                <div class="buttons-search">
                    <div class="form-group resetuj res">
                        <input type="reset" value="Resetuj pretragu">
                    </div>
                    <div class="form-group resetuj">
                        <input type="submit" name="submitDetail" value="Pretrazi">
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection

