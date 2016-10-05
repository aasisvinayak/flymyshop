<div class="col-md-8" style="width: @parent">


    <h2>Add a new {{$type}} to FlyMyShop</h2>

    <div class="alert alert-warning">
        You can add any {{$type}} provided it has met all the requirements to be a
        Flymyshop {{$type}}
    </div>


    @include('admin-partials._form-error')

    {{Form::open(array('action' =>$action))}}

    <div class="form-group">
        {{Form::label('url',"Enter GitHub ".$type." Project URL")}}
        {{Form::text('url',old('url'),array('class'=>'form-control', 'placeholder'=>'https://github.com/aasisvinayak/'.$sample))}}
    </div>

    <div class="form-group">
        {{Form::submit("Add ".$type, array('class'=>'form-control'))}}
    </div>


    {{Form::close()}}

</div>