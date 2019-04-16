@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Profil</div>

                <div class="card-body">
                    <center>{{ Html::image('img/user.png', 'user', array('width'=>'60%', 'style'=>'opacity:0.9')) }}</center>
                    <table class="table table-striped" style="background:#03c655;color:white">
                        <tr>
                            <th>Nama</th>
                            <td>{{ auth::user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                        <td>{{ auth::user()->born }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ auth::user()->gender }}</td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td>{{ auth::user()->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" style="background:#34b86c">
                    <center>
                        {{ Html::image('img/logoBMI.png', 'user', array('width'=>'40%')) }}
                    </center> 
                    <br>
                    <center>
                        <a href="{{ url('bmi') }}">
                        <button class="btn btn-success" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 3px 10px 0 rgba(0,0,0,0.19)">Lihat BMI</button>
                        </a>
                    </center><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
