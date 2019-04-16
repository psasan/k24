@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="background:#00a445">
                    <h2 class="tulis" style="text-align:center">Welcome</h2>
                </div>
            </div>
            <div class="card">
                <div class="card-body" style="text-align:center;background:#03c655">
                    <p style="color:white;padding-bottom:10px">This is a BMI Calculator and Weight Collector <br> also Period Calendar for practice purpose.</p>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-4" style="padding-bottom:7px">
                                <div class="card" style="text-align:center;background:#00ae53">
                                    <a href="{{ url('create') }}">
                                        <div class="card-body"><br>
                                            {{ Html::image('img/logoBMI.png', 'gambar', array('width'=>'50%','align'=>'center')) }}
                                            <br>
                                            <br>
                                            <h5 style="color:white">Body Mass Index Calculator</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="text-align:center;background:#ff6682">
                                    <a href="{{ url('calendar') }}">
                                        <div class="card-body"><br>
                                            {{ Html::image('img/logoPC.png', 'gambar', array('width'=>'48%','align'=>'center')) }}
                                            <br>
                                            <br>
                                            <h5 style="color:white">Period Calendar</h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection