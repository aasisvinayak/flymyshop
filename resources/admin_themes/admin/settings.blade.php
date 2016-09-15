


@extends('admin-layouts.admin')
@section('title')
    Settings
@stop

@section('content')


    <div class="container">

        <div class="col-md-8">


        {{ Form::model($settings, array('action' => array('AdminController@updateSettings'))) }}

            <h2>Shop Details</h2>
        {{Form::label('title','Name of the shop')}}
        {{Form::text('title',old('title'),array('class'=>'form-control'))}}

        {{Form::label('sub_title','Tag line')}}
        {{Form::text('sub_title',old('sub_title'),array('class'=>'form-control'))}}

            <h2>Contact Details</h2>
        {{Form::label('email','Support Email')}}
        {{Form::text('email',old('email'),array('class'=>'form-control'))}}

        {{Form::label('phone','Support Phone Number')}}
        {{Form::text('phone',old('phone'),array('class'=>'form-control'))}}

        {{Form::label('address_l1','Address Line 1')}}
        {{Form::text('address_l1',old('address_l1'),array('class'=>'form-control'))}}

        {{Form::label('address_l2','Address Line 2')}}
        {{Form::text('address_l2',old('address_l2'),array('class'=>'form-control'))}}

        {{Form::label('city','City')}}
        {{Form::text('city',old('city'),array('class'=>'form-control'))}}

        {{Form::label('state','State/Province/County')}}
        {{Form::text('state',old('state'),array('class'=>'form-control'))}}

        {{Form::label('country','Country')}}
        {{Form::text('country',old('country'),array('class'=>'form-control'))}}

         <h2>Shopping Settings</h2>

        {{Form::label('currency','Shop default currency')}}
        {{Form::text('currency',old('currency'),array('class'=>'form-control'))}}


        {{Form::label('tax','Tax Rate')}}
        {{Form::text('tax',old('tax'),array('class'=>'form-control'))}}


        {{Form::label('shipping','Shipping Fee')}}
        {{Form::text('shipping',old('shipping'),array('class'=>'form-control'))}}

            <h2>Mail Settings</h2>

            {{Form::label('mail_driver','Shipping Fee')}}
            {{Form::text('mail_driver',old('mail_driver'),array('class'=>'form-control'))}}

            {{Form::label('mail_host','Shipping Fee')}}
            {{Form::text('mail_host',old('mail_host'),array('class'=>'form-control'))}}

            {{Form::label('mail_port','Shipping Fee')}}
            {{Form::text('mail_port',old('mail_port'),array('class'=>'form-control'))}}

            {{Form::label('mail_username','Shipping Fee')}}
            {{Form::text('mail_username',old('mail_username'),array('class'=>'form-control'))}}

            {{Form::label('mail_password','Shipping Fee')}}
            {{Form::text('mail_password',old('mail_password'),array('class'=>'form-control'))}}

            {{Form::label('mail_encryption','Shipping Fee')}}
            {{Form::text('mail_encryption',old('mail_encryption'),array('class'=>'form-control'))}}

            {{Form::label('mail_from','Shipping Fee')}}
            {{Form::text('mail_from',old('mail_from'),array('class'=>'form-control'))}}


            <h2>Social Media Settings</h2>

        {{Form::label('fb','Facebook Page URL')}}
        {{Form::text('fb',old('fb'),array('class'=>'form-control'))}}


        {{Form::label('twitter','Twitter  Page URL')}}
        {{Form::text('twitter',old('twitter'),array('class'=>'form-control'))}}

        {{Form::label('gplus','Google Plus  Page URL')}}
        {{Form::text('gplus',old('gplus'),array('class'=>'form-control'))}}

        {{Form::label('youtube','YouTube Channel  URL')}}
        {{Form::text('youtube',old('youtube'),array('class'=>'form-control'))}}

        {{Form::label('instagram','Instagram  Page URL')}}
        {{Form::text('instagram',old('instagram'),array('class'=>'form-control'))}}

        {{Form::submit('Save', array('class'=>"btn btn-primary"))}}
        {{ Form::close() }}

            <br>
            <br>

        </div>
    </div>

@stop