
<?php
//var_dump($settings);
?>

@extends('admin-layouts.admin')
@section('title')
    Settings
@stop

@section('content')


    <div class="container">

        <div class="col-md-8">


        {{ Form::open( array('action' => array('AdminController@updateSettings'))) }}

            <h2>Shop Details</h2>
        {{Form::label($settings[0]['title'],'Shop Name')}}
        {{Form::text($settings[0]['title'],$settings[0]['value'],array('class'=>'form-control'))}}

        {{Form::label($settings[1]['title'],'Shop Tag Line')}}
        {{Form::text($settings[1]['title'],$settings[1]['value'],array('class'=>'form-control'))}}

            <h2>Mail Details</h2>


             {{Form::label($settings[2]['title'],'Email Driver')}}
             {{Form::text($settings[2]['title'],$settings[2]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[3]['title'],'Email Host')}}
            {{Form::text($settings[3]['title'],$settings[3]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[4]['title'],'Email Port')}}
            {{Form::text($settings[4]['title'],$settings[4]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[5]['title'],'Email Username')}}
            {{Form::text($settings[5]['title'],$settings[5]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[6]['title'],'Email Password')}}
            {{Form::text($settings[6]['title'],$settings[6]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[7]['title'],'Email Encryption')}}
            {{Form::text($settings[7]['title'],$settings[7]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[8]['title'],'Email Address')}}
            {{Form::text($settings[8]['title'],$settings[8]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[9]['title'],'Email Name')}}
            {{Form::text($settings[9]['title'],$settings[9]['value'],array('class'=>'form-control'))}}


            <h2>Payment Settings</h2>


            {{Form::label($settings[10]['title'],'Stripe API Key')}}
            {{Form::text($settings[10]['title'],$settings[10]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[11]['title'],'Stripe publishable key')}}
            {{Form::text($settings[11]['title'],$settings[11]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[12]['title'],'Stripe API Secret')}}
            {{Form::text($settings[12]['title'],$settings[12]['value'],array('class'=>'form-control'))}}



            <h2>Shop Settings</h2>

            {{Form::label($settings[13]['title'],'Hosting Environment')}}
            {{Form::text($settings[13]['title'],$settings[13]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[14]['title'],'Enable Debugging')}}
            {{Form::text($settings[14]['title'],$settings[14]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[15]['title'],'Website URL')}}
            {{Form::text($settings[15]['title'],$settings[15]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[16]['title'],'Shop Theme')}}
{{--            {{Form::text($settings[16]['title'],$settings[16]['value'],array('class'=>'form-control'))}}--}}

            <?php

                $options=array();
                foreach (fms_themes() as $theme){
                    $options[$theme]=$theme;
                }


            ?>

            {{ Form::select($settings[16]['title'], $options, null,array('class'=>'form-control'))}}



            {{Form::label($settings[17]['title'],'Tax Rate')}}
            {{Form::text($settings[17]['title'],$settings[17]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[18]['title'],'Currency Symbol')}}
            {{Form::text($settings[18]['title'],$settings[18]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[19]['title'],'Shipping/Delivery Charge')}}
            {{Form::text($settings[19]['title'],$settings[19]['value'],array('class'=>'form-control'))}}





            <h2>Marketing Settings</h2>


            {{Form::label($settings[20]['title'],'SPARKPOST SECRET')}}
            {{Form::text($settings[20]['title'],$settings[20]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[21]['title'],'MAILCHIMP APIKEY')}}
            {{Form::text($settings[21]['title'],$settings[21]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[22]['title'],'MAILCHIMP LIST ID')}}
            {{Form::text($settings[22]['title'],$settings[22]['value'],array('class'=>'form-control'))}}




            <h2>Social Media Settings</h2>


            {{Form::label($settings[23]['title'],'Facebook Page URL')}}
            {{Form::text($settings[23]['title'],$settings[23]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[24]['title'],'Twitter Page URL')}}
            {{Form::text($settings[24]['title'],$settings[24]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[25]['title'],'YouTube Channel URL')}}
            {{Form::text($settings[25]['title'],$settings[25]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[26]['title'],'Instagram Page URL')}}
            {{Form::text($settings[26]['title'],$settings[26]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[27]['title'],'Telegram Bot Token')}}
            {{Form::text($settings[27]['title'],$settings[27]['value'],array('class'=>'form-control'))}}


            <h2>Miscellaneous Settings</h2>

            {{Form::label($settings[28]['title'],'RECAPTCHA Public Key')}}
            {{Form::text($settings[28]['title'],$settings[28]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[29]['title'],'RECAPTCHA Private Key')}}
            {{Form::text($settings[29]['title'],$settings[29]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[30]['title'],'FACEBOOK Client ID')}}
            {{Form::text($settings[30]['title'],$settings[30]['value'],array('class'=>'form-control'))}}

            {{Form::label($settings[31]['title'],'FACEBOOK Client Secret')}}
            {{Form::text($settings[31]['title'],$settings[31]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[32]['title'],'Cache Storage')}}
            {{Form::text($settings[32]['title'],$settings[32]['value'],array('class'=>'form-control'))}}


            {{Form::label($settings[33]['title'],'Session Driver')}}
            {{Form::text($settings[33]['title'],$settings[33]['value'],array('class'=>'form-control'))}}

            <br>
            {{Form::submit('Save', array('class'=>"btn btn-primary"))}}
        {{ Form::close() }}

            <br>
            <br>

        </div>
    </div>

@stop