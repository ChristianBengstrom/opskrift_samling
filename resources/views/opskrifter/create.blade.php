@extends('layout')

@section('title', 'Ny Opskrift')

@section('js')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins and Typeahead) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Typeahead.js Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    <script src="{{ URL::asset('js/autocomplete.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/nQuery.js') }}" charset="utf-8"></script>
    <script src="{{ URL::asset('js/createForm.js') }}" charset="utf-8"></script>
@stop

@section('content')
    <h2>Ny opskrift</h2>
    <br>

    {!! Form::model(new App\Models\Opskrift, ['route' => ['opskrifter.store']]) !!}
        @include('opskrifter/partials/_form', ['submit_text' => 'Opret Opskrift'])
    {!! Form::close() !!}
@endsection
