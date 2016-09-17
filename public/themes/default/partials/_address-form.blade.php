<div class="form-group">
    {{ Form::label('address_l1', 'Address Line 1') }}
    {{ Form::text('address_l1', Input::old('address_l1'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('address_l2', 'Address Line 2') }}
    {{ Form::text('address_l2', Input::old('address_l2'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('city', 'City') }}
    {{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('state', 'State') }}
    {{ Form::text('state', Input::old('state'), array('class' => 'form-control')) }}
</div>


<div class="form-group">
    {{ Form::label('postcode', 'Post Code or Zip') }}
    {{ Form::text('postcode', Input::old('postcode'), array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('country', 'Country') }}
    {{ Form::text('country', Input::old('country'), array('class' => 'form-control')) }}
</div>

{{ Form::submit($buttonName, array('class' => 'btn btn-primary')) }}