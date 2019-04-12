@extends('layout')

@section('title', 'ret '.$opskrifter->navn)

@section('js')
      <script src="{{ URL::asset('js/nQuery.js') }}" charset="utf-8"></script>
      <script src="{{ URL::asset('js/createForm.js') }}" charset="utf-8"></script>
@stop

@section('content')
    <p>
        {!! link_to_route('opskrifter.index', 'Tilbage', null, array('class' => 'btn btn-info')) !!}
    </p>
    <h2>Ret {{ $opskrifter->navn }}</h2>
    <br>
    {!! Form::model($opskrifter, ['method' => 'PATCH', 'route' => ['opskrifter.update', $opskrifter->id]]) !!}
        @include('opskrifter/partials/_form', ['submit_text' => 'Ret Opskrift'])
    {!! Form::close() !!}

    {{-- @php
      dump($opskrifter);
      dump($opskriften);
    @endphp --}}
@endsection
