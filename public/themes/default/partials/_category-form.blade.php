<div class="form-group">
    {{Form::label('title','Category Name')}}
    {{Form::text('title',Input::old('title'),array('class' => 'form-control'))}}
</div>

{{Form::submit($button_name, array('class' => 'btn btn-primary'))}}
