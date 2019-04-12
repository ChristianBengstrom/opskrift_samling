@extends('layout')

@section('title', $o_navn)

@section('content')
    <h1>Super duber wham bam buuuu</h1>
    <h3>{{ $o_navn . $message }}</h3>

    <h4><a href="{{ route('opskrifter.show', $o_id) }}">Se den her:</a></h4>

    @php
      dump($o_navn);
      dump($o_id);
      dump($input);
    @endphp
@endsection
