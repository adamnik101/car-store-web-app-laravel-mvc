<form action="{{session()->has('izmeni') ? route($name.'Izmeni', session()->has('id') ? session()->get('id') : '') : route($name.'Dodaj')}}" method="POST">
    @csrf
    <div class="form-group unos">
        @if(isset($proizvodjac))
            <select name="proizvodjac" style="margin-bottom: 1vw;">
                <option>Izaberi proizvodjaca</option>
                @foreach($proizvodjaci as $p)
                    <option value="{{$p->id}}" {{session()->has('model') ? session()->get('model')->proizvodjac_id == $p->id ? 'selected' : '' : ''}}>{{$p->naziv}}</option>
                @endforeach
            </select>
        @endif
        <input type="text" id="zapis" placeholder="Novi zapis" value="{{session()->has('izmeni') ? session()->get('izmeni')->naziv : ''}}" name="zapis">
        @if($errors->has('zapis'))
            <div class="error-msg">
                {{$errors->first('zapis')}}
            </div>
        @endif
        @if(session()->has('msg'))
           <p class="error-msg"> {{session()->get('msg')}}</p>
        @endif
        <input type="submit" id='submitAdmin' value="{{session()->has('izmeni') ? 'Izmeni naziv' : "Unesi novi zapis"}}">
    </div>
</form>
