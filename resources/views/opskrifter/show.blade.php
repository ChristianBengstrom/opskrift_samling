@extends('layout')

@section('title', 'Opskrift '.$opskriften[0]->o_navn)

@section('js')
      <script src="{{ URL::asset('js/nQuery.js') }}" charset="utf-8"></script>
      <script src="{{ URL::asset('js/portionCalc.js') }}" charset="utf-8"></script>
@stop

@section('content')
    <p>
        {!! link_to_route('opskrifter.index', 'Tilbage', null, array('class' => 'btn btn-info')) !!}
    </p>
    <p>
      {!! link_to_route('opskrifter.edit', 'Ret', array($opskriften[0]->id), array('class' => 'btn btn-info')) !!}
    </p>

    <h1>{{ $opskriften[0]->o_navn }}</h1>
    {!! Form::label('antal', 'Til antal personer') !!}
    {!! Form::number('antal', 3, ['id'=>'qtPerson']) !!}
    <h4><em>tid: {{ $opskriften[0]->tid }}</em></h4>
    <br>
    <table class="table">
      <tr>
        <th>Ingrediens</th>
        <th>Mængde</th>
        <th>Enhed</th>
      </tr>
        @foreach ($opskriften as $ingrediens)
          <tr>
            <td>
              {{ $ingrediens->i_navn }}
            </td>
            <td class='qt'>
              {{ $ingrediens->qt }}
            </td>
            <td>
              {{ $ingrediens->enhed }}
            </td>
          </tr>
        @endforeach

    </table>

    <h3>Fremgangsmåde:</h3>
    <br>
    <ol>
      @foreach ($beskrivelse as $step)
        <li>
          {{ $step }}
        </li>
        <br>
      @endforeach
    </ol>


    @php
      dump($opskriften);
    @endphp

@endsection
