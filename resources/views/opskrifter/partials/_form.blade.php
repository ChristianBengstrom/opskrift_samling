{{-- MASTER OPSKRIFT --}}
<div class="master">
  <div class="form-group">
      {!! Form::text('navn', null, array('placeholder'=>'Navn' )) !!}

      {!! Form::time('tid', null, array('placeholder'=>'Tid' )) !!}
      <br>
      <br>
      {!! Form::textarea('beskrivelse', null, ['placeholder'=>'Fremgangsmåde', 'rows' => 10, 'cols' => 63]) !!}
  </div>
</div>

{{-- <div class="form-group">
    {!! Form::label('user_id', 'User ID:') !!}
    {!! Form::hidden('user_id', Auth::id()) !!}
</div> --}}
<br>
{{-- INGREDIENSER --}}
<div class="ingredienser">
  <div class="form-group" id='iGroup'>
  @if (isset($opskriften))
    @for ($i=0; $i < count($opskriften); $i++)
      {!! Form::text('ingr[' .$i .']', $opskriften[$i]->i_navn, ['placeholder'=>'Ingrediens '.($i+1)]) !!}
      {!! Form::number('qt[' .$i .']', round($opskriften[$i]->qt), ['placeholder'=>'Mængde '.($i+1),'step'=>'any']) !!}
      {!! Form::text('enhed[' .$i .']', $opskriften[$i]->enhed, ['placeholder'=>'Enhed '.($i+1)]) !!}
      {!! Form::hidden('i_id[' .$i .']', $opskriften[$i]->i_id) !!}
      <br>
    @endfor
  @else
        {!! Form::text('ingr[]', null, ['placeholder'=>'Ingrediens 1', 'id'=>'search', 'autocomplete'=>'off']) !!}
        {!! Form::number('qt[]', null, ['placeholder'=>'Mængde 1','step'=>'any']) !!}
        {!! Form::text('enhed[]', null, ['placeholder'=>'Enhed 1']) !!}
  @endif
  </div>

  <a href="#" class='btn btn-success' id='add'>+</a>
</div>
<br><br>

<div class="form-group">
    {!! Form::submit($submit_text, array('class' => 'btn btn-primary')) !!}
</div>
