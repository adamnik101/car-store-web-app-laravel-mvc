@extends('layouts.layout')

@section('title') Pretraga @endsection
@section('description') Pretrazi automobile po svom kriterijumu i pronadji bas onakav kakav ti odgovara @endsection
@section('keywords') Pocetna, polovni, automobili, prodaja, kupovina, pretraga @endsection

@section('content')
    <div class="home-wrapper">
        <div class="row">
            <div class="home-top">
                <h1>Dodaj novi oglas</h1>

                <p style="color: #6b7280; margin-left: 1vw">(Unesi potrebne podatke)</p>
            </div>
            <form action="{{route("unosOglasa")}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="main-search">
                    <img src="{{asset('assets/img/search-form.png')}}" alt="new-car">

                    <div class="form-group">
                        <select name="marka" id="proizvodjac">
                            <option value="0">Izaberi marku:</option>
                            @foreach($marka as $m)
                                <option value="{{$m->id}}" {{old('marka') == $m->id ? 'selected' : ''}}> {{$m->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("marka"))
                            {{$errors->first('marka')}}
                            @endif
                    </div>
                    <div class="form-group">
                        <select name="model" id="model">
                            <option value="0">Izaberi model</option>
                            @if($errors->any())
                            @foreach($model as $m)
                                @if($m->proizvodjac_id == old('marka'))
                                    <option value="{{$m->id}}" {{old('model') == $m->id ? "selected" : ''}}>{{$m->naziv}}</option>
                                @endif
                            @endforeach
                            @endif
                        </select>
                        @if($errors->has("model"))
                            {{$errors->first('model')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="number" name="cena" value="{{old('cena')}}" class="euro-icon" placeholder="Unesi cenu:">
                        <i class="fa-solid fa-euro-sign"></i>
                        @if($errors->has("cena"))
                            {{$errors->first('cena')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="kilometraza" value="{{old('kilometraza')}}" placeholder="Unesi predjenu kilometrazu">
                        @if($errors->has("kilometraza"))
                            {{$errors->first('kilometraza')}}
                        @endif
                    </div>
                    <div class="form-group registrovan">
                        <label for="registrovanDo">Registrovan do:</label>
                        <input type="date" id="registrovanDo" value="{{old('registrovanDo')}}" name="registrovanDo" placeholder="Registrovan do">
                        @if($errors->has("registrovanDo"))
                            {{$errors->first('registrovanDo')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="karoserija">
                            <option value="0">Izaberi karoseriju</option>
                            @foreach($karoserija as $k)
                                <option value="{{$k->id}}" {{old('karoserija') == $k->id ? 'selected' : ''}}> {{$k->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("karoserija"))
                            {{$errors->first('karoserija')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="gorivo" >
                            <option value="0">Vrsta goriva</option>
                            @foreach($gorivo as $g)
                                <option value="{{$g->id}}" {{old('gorivo') == $g->id ? 'selected' : ''}}> {{$g->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("gorivo"))
                            {{$errors->first('gorivo')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="brojVrata">
                            <option value="0">Broj vrata</option>
                            @foreach($vrata as $v)
                                <option value="{{$v->id}}" {{old('brojVrata') == $v->id ? 'selected' : ''}}> {{$v->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("brojVrata"))
                            {{$errors->first('brojVrata')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="grad">
                            <option value="0">Izaberi grad</option>
                            @foreach($grad as $g)
                                <option value="{{$g->id}}" {{old('grad') == $g->id ? 'selected' : ''}}> {{$g->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("grad"))
                            {{$errors->first('grad')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="klima">
                            <option value="0">Izaberi klimu</option>
                            @foreach($klima as $k)
                                <option value="{{$k->id}}" {{old('klima') == $k->id ? 'selected' : ''}}> {{$k->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("klima"))
                            {{$errors->first('klima')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="boja">
                            <option value="0">Izaberi boju</option>
                            @foreach($boja as $b)
                                <option value="{{$b->id}}" {{old('boja') == $b->id ? 'selected' : ''}}> {{$b->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("boja"))
                            {{$errors->first('boja')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="menjac">
                            <option value="0">Izaberi menjac</option>
                            @foreach($menjac as $m)
                                <option value="{{$m->id}}" {{old('menjac') == $m->id ? 'selected' : ''}}> {{$m->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("menjac"))
                            {{$errors->first('menjac')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <select name="pogon">
                            <option value="0">Izaberi pogon</option>
                            @foreach($pogon as $p)
                                <option value="{{$p->id}}" {{old('pogon') == $p->id ? 'selected' : ''}}> {{$p->naziv}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("pogon"))
                            {{$errors->first('pogon')}}
                        @endif
                    </div>
                    <div class="form-group godiste">
                        <select name="godiste">
                            <option value="0">Unesi godiste</option>
                            @foreach($godiste as $g)
                                <option value="{{$g->id}}" {{old('godiste') == $g->id ? 'selected' : ''}}> {{$g->godina}}</option>
                            @endforeach
                        </select>
                        @if($errors->has("godiste"))
                            {{$errors->first('godiste')}}
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="obelezje" value="{{old('obelezje')}}" placeholder="Unesi obelezje [opciono]">
                    </div>
                </div>
                <div class="home-top">
                    <h3>Slike</h3>
                    <span style="color: #6b7280; margin-left: 1vw">(Prvu sliku koju izaberete ce se prikazivati kao prva slika na oglasu!)</span>
                </div>
                <div class="main-search safety" id="group">
                    <div class="input-group increment" id="increment">
                        <input type="file" name="slika[]" class="form-control">
                        <div class="input-group-btn">
                            <button class="btn btn-success" id="add" type="button">Add</button>
                        </div>
                    </div>
                </div>
                <div class="main-search safety">
                    @if($errors->has("slika[]"))
                        {{$errors->first('slika[]')}}
                    @endif
                </div>

                <div class="home-top">
                    <h3>Sigurnost</h3>
                    <span style="color: #6b7280; margin-left: 1vw">(Stikliraj samo ono sto automobil poseduje od sigurnosne opreme)</span>
                </div>
                <div class="main-search safety">
                    @foreach($sigurnost as $s)
                        <div class="pretty p-icon p-smooth">
                            <input type="checkbox" name="sigurnost[]" value="{{$s->id}}"
                                   @if(!is_null(old('sigurnost')))
                                   @foreach(old('sigurnost') as $sig)
                                   @if($sig == $s->id)
                                   checked
                                @endif
                                @endforeach
                                @endif
                            />
                            <div class="state">
                                <i class="icon fa-solid fa-check"></i>
                                <label> {{$s->naziv}}</label>
                            </div>
                        </div>

                    @endforeach

                </div>
                <div class="home-top">
                    <h3>Oprema</h3>
                    <span style="color: #6b7280; margin-left: 1vw">(Stikliraj samo ono sto automobil poseduje od dodatne opreme)</span>
                </div>
                <div class="main-search safety">
                    @foreach($oprema as $o)
                        <div class="pretty p-icon p-smooth">
                            <input type="checkbox" name="oprema[]" value="{{$o->id}}"
                                @if(!is_null(old('oprema')))
                                   @foreach(old('oprema') as $op)
                                    @if($op == $o->id)
                                        checked
                                        @endif
                                    @endforeach
                                @endif
                            />
                            <div class="state">
                                <i class="icon fa-solid fa-check"></i>
                                <label> {{$o->naziv}}</label>
                            </div>
                        </div>

                    @endforeach

                </div>
                <div class="home-top">
                    <h3>Opis</h3>
                </div>
                <div class="main-search safety">
                    <textarea name="opis" placeholder="Unesi opis oglasa">{{old('opis')}}</textarea>
                </div>
                <div class="buttons-search">
                    <div class="form-group resetuj res">
                        <input type="reset" value="Resetuj unos">
                    </div>
                    <div class="form-group resetuj">
                        <input type="submit" name="submitDetail" value="Unesi">
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

