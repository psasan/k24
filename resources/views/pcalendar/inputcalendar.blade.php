@extends('layouts.app2')

@section('content')
<style>
    body{
        background-color: #ff6682;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" style="padding-bottom:15px">
            <div class="card" style="background:#ff6682;color:white">
                <div class="card-body">
                    @csrf
                    <div>
                        <h2 style="text-align:center">Period Calendar</h2>
                        <hr style="background:white">
                        <center><img src="img/logoPC.png" alt="gambar" style="width:35%"></center>
                        <h5>
                        <center>Wondering, "When will I get my period?"</center>
                        </h5>
                        <center>
                            <p>
                            This tool has your answer! <br> 
                            Plan for trips and huge events in your life. <br>
                            Plus, track ovulation!
                            </p>
                        </center>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="background:#ff6682;color:white">{{ __('Input') }}</div>
                <div class="card-body" style="">
                    {!! Form::open(array('route'=>'calendar','method'=>'POST','files'=>'true')) !!}
                    <div class="form-group">
                        {!! Form::label('Start Date') !!}
                        <div class="">
                            {!! Form::date('start_date',null,['class'=>'form-control']) !!}
                            {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('How Many Days?') !!}
                        <div class="">
                            {!! Form::text('many_days',null,['class'=>'form-control']) !!}
                            {!! $errors->first('many_days','<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('How Long the Period Last?') !!}
                        <div class="">
                            {!! Form::text('how_long',null,['class'=>'form-control']) !!}
                            {!! $errors->first('how_long','<p class="alert alert-danger">:message</p>') !!}
                        </div>
                    </div>
                    <div> &nbsp;
                        <center>{!! Form::submit('Generate', ['class'=> 'btn', 'style'=>'box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 3px 10px 0 rgba(0,0,0,0.19);background:#ff6682;color:white']) !!}</center>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
