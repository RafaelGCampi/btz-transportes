@extends('layouts.app')

@section('content')
<section>
    <h2>Veículos</h2>

    <section>
        <button class="btn btn-primary" onclick="veiculo_open_create()" type='button'>Novo Veículo</button><br><br>
        <div id="list">
            @include('componentes.veiculo.list')
        </div>

    </section>
</section>
@endsection
@section('scripts')
    <script src="{{asset('js/veiculo.js')}}" defer></script>
@endsection
