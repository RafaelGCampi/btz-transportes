@foreach(\App\Models\Veiculo::orderBy('nome','asc')->orderBy('nome')->get() as $veiculo)
            <option value="{{$veiculo['id']}}">{{$veiculo['nome']}}</option>
@endforeach

