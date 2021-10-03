@foreach(\App\Models\Motorista::orderBy('nome','asc')->orderBy('nome')->get() as $motorista)
            <option value="{{$motorista['id']}}">{{$motorista['nome']}}</option>
@endforeach

