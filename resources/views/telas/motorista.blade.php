@extends('layouts.app')

@section('content')
<section>
    <h2>Motoristas</h2>

    <section>
        <button class="btn btn-primary" onclick="motorista_open_create()" type='button'>Novo Motorista</button><br><br>
        <div id="list">
            @include('componentes.motorista.list')
        </div>

    </section>
</section>
@endsection
@section('scripts')
    <script src="{{asset('js/motorista.js')}}" defer></script>
@endsection
