@extends('layouts.app2')

@section('content')
<style>
    body{
        background-color: #ff6682;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header" style="text-align:center;background:#ff6682;color:white">{{ __('Calendar') }}</div>
                <div class="card-body" style="background:white">
                    <div class="">
                        <h5>Result are an estimate. All women's cycles are unique and may far from the result</h5>
                    </div>
                    <br>
                        {!! $calendar->calendar() !!}
                        {!! $calendar->script() !!}
                    <br>
                    <button class="btn btn-success" style="background:#ff6682;border:#ff6682"></button> Period Days : Menstruation cycle <br>
                    <button class="btn btn-success" style="background:#79E4E8;border:#79E4E8"></button> Ovulation : Timeframe when fertility is higest
                    <hr>
                    <center>
                    <a href="{{ url('calendar') }}">
                        <button class="btn" style="background:#ff6682;color:white;border:#ff6682">Hitung Lagi</button>
                    </a>
                    </center>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
