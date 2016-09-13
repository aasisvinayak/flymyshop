
{{Form::label('title','Page Title')}}
{{Form::text('title',old('title'), array('class' => 'form-control'))}}


{{Form::label('content','Page Content')}}
{{Form::textarea('content',old('content'), array('class' => 'form-control'))}}

<br><br>

{{Form::submit($buttonName, array('class' => 'btn btn-primary'))}}
