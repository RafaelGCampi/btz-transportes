@foreach(\App\Models\TipoCombustivel::orderBy('nome','asc')->orderBy('nome')->get() as $tipoCombustivel)
            <option value="{{$tipoCombustivel['id']}}">{{$tipoCombustivel['nome']}}</option>
@endforeach

