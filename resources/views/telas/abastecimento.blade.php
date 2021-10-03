@extends('layouts.app')

@section('content')
<section>
    <h2>Abastecimento</h2>

    <section>
        <button class="btn btn-primary" onclick="abastecimento_open_create()" type='button'>Registrar Abastecimento</button><br><br>
        <div id="list">
            @include('componentes.abastecimento.list')
        </div>

    </section>
</section>
@endsection
@section('scripts')
    <script src="{{asset('js/abastecimento.js')}}" defer></script>
@endsection
