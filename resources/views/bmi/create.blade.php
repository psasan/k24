@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" style="padding-bottom:15px">
            <div class="card">
                <div class="card-body">
                    @csrf
                    <div>
                        <h2 style="text-align:center">Calculate Body Mass Index (BMI)</h2>
                        <hr>
                        <center><img src="img/capture.jpg" alt="gambar" width=260 height=153></center>
                        <h5>
                        Are you in the healthy range? Use this tool to calc​ulate your 
                        Body Mass Index (BMI) now to know your health risk.
                        </h5>
                        <p>
                        A BMI value of 23 and above indicates that your weight is outside 
                        of the healthy weight range for your height. 
                        Find out more on how to achieve and maintain a healthy BMI through 
                        a healthy and active lifestyle.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <center>{{ __('Count BMI') }}</center>
                </div>
                <div class="card-body">
                    @csrf
                    <center>{{ Html::image('img/logoBMI.png', 'K24', ['width'=>'32%','align']) }}</center>
                    <br>
                    
                    <div id="bmi">
                        @include('errors.form_error_list')
                        {!! Form::open(['url'=>'bmi']) !!}
                            @include('bmi.form',['submitButtonText'=>'Generate'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection