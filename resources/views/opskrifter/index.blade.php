@extends('layout')

@section('title', 'Overblik')

@section('content')
    <h2>Alle opskrifter</h2>
    <br>


    {{-- @if(Auth::check()) --}}
      @if ( !$opskrifter->count() )
          Du har ingen opskrifter
      @else
        <table class="table">
          <tr class='bg-info'>
            <th><a href="{{ route('opskrifter.index') }}">Opskrift</a></th>
            <th><a href="{{ route('opskrifter.sorted_by_time') }}">Tid</a></th>
            <th></th>
            <th></th>
          </tr>
              @foreach( $opskrifter as $opskrift )
                <tr>
                  <td>
                    <h4><a href="{{ route('opskrifter.show', $opskrift->id) }}">{{ $opskrift->navn }}</a></h4>
                  </td>
                  <td>
                    <p>{{ $opskrift->tid }}</p>
                  </td>
                  <td>
                    {{-- @if(Auth::user()->id === $project->u_id) --}}
                      {!! link_to_route('opskrifter.edit', 'Ret', array($opskrift->id), array('class' => 'btn btn-info')) !!}
                    {{-- @endif --}}
                  </td>
                  <td>
                    {{-- @if(Auth::user()->id === $project->u_id) --}}
                      {!! Form::open(array('class' => 'form-inline', 'method' => 'DELETE', 'route' => array('opskrifter.destroy', $opskrift->id))) !!}
                      {!! Form::submit('Slet', array('class' => 'btn btn-danger')) !!}
                      {!! Form::close() !!}
                    {{-- @endif --}}
                  </td>
                </tr>
              @endforeach
          </table>
      @endif

      {!! link_to_route('opskrifter.create', 'Tilføj opskrift', null, array('class' => 'btn btn-info')) !!}
    {{-- @endif --}}

    {{-- @if(Auth::guest())
        <a href="/login" class="btn btn-info"> You need to login to see yaddas >></a>
    @endif --}}

@endsection
