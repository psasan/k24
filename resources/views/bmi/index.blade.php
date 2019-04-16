@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('_partial.flash_message')
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4" style="padding-bottom:10px">
            <div class="card">
                <div class="card-header"><center>Statistik</center></div>
                <div class="card-body">
                    @if(!empty($list_bmi[0]))
                        @if($lastbmi->bmi <= 18.4)
                            <td><center><label class="btn btn-primary" >{{ "Underweight" }}</label></center></td>
                        @elseif($lastbmi->bmi >= 18.5 && $lastbmi->bmi <= 24.9)
                            <td><center><label class="btn btn-success">{{ "Normal" }}</label></center></td>
                        @elseif($lastbmi->bmi >= 25 && $lastbmi->bmi <= 29.9)
                            <td><center><label class="btn btn-warning" >{{ "Overweight" }}</label></center></td>
                        @elseif($lastbmi->bmi >= 30 && $lastbmi->bmi <= 34.9)
                            <td><center><label class="btn btn-warning">{{ "Obese" }}</label></center></td>
                        @else
                            <td><center><label class="btn btn-danger" >{{ "Extremly Obese" }}</label></center></td>
                        @endif
                        <canvas id="myChart" width="400" height="400" style=""></canvas><br>

                        <script>
                        var Weight = @json($berat);
                        var Height = @json($tinggi);
                        var Dates = @json($tanggal);
                        var BMI = @json($bmi);

                        var ctx = document.getElementById('myChart');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: Dates,
                                datasets: [{
                                    label: 'Data Tinggi',
                                    data: Height,
                                    backgroundColor: [
                                        'rgba(255, 91, 50, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 30, 64, 1)'
                                    ],
                                    borderWidth: 2
                                },{
                                    label: 'Data Berat',
                                    data: Weight,
                                    backgroundColor: [
                                        'rgba(82, 255, 155, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(0, 164, 69, 1)'
                                    ],
                                    borderWidth: 2
                                },{
                                    label: 'Data BMI',
                                    data: BMI,
                                    backgroundColor: [
                                        'rgba(155, 220, 251, 0.6)'
                                    ],
                                    borderColor: [
                                        'rgba(0, 173, 255, 1)'
                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                        </script>
                    @else
                        <center><p>-</p></center>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card" style="background:#03c655">
                <div class="card-header" style=""><center>Advice</center></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!empty($list_bmi[0]))
                    <div class="container" style="color:white">
                    You are at
                        @if($lastbmi->bmi <= 18.4)
                            at Low Risk * <br>
                            *But increased risk of other clinical problems 
                            AT RISK of nutritional deficiency and osteoporosis. 
                            You are encouraged to eat a balanced meal and to seek 
                            medical advice if necessary.
                        @elseif($lastbmi->bmi >= 18.5 && $lastbmi->bmi <= 24.9)
                            at Low Risk <br>
                            Achieve a healthy weight by balancing your caloric 
                            input (diet) and output (physical activity).
                        @elseif($lastbmi->bmi >= 25 && $lastbmi->bmi <= 29.9)
                            at Moderate Risk <br>
                            Try aim to lose 5% to 10% of your body weight over 6 to 12
                            months by increasing physical activity and reducing caloric intake.
                        @elseif($lastbmi->bmi >= 30 && $lastbmi->bmi <= 34.9)
                            at High Risk <br>
                            Try aim to lose 5% to 10% of your body weight over 6 to 12 months by 
                            increasing physical activity and reducing caloric intake. 
                            Go for regular health screening to keep co-morbid conditions* in check. <br><br>
                            *Cardiovascular risks of metabolic syndrome, including Type 2 Diabetes, Hypertension and Hyperlipidemia.
                        @else
                            at Very High Risk <br>
                            Aim to lose 10% to 20% of your body weight over 6 to 12 months by 
                            increasing physical activity and reducing caloric intake or see a doctor if needed. 
                            Go for more intense health screening to keep co-morbid conditions* in check. <br><br>
                            *Cardiovascular risks of metabolic syndrome, including Type 2 Diabetes, Hypertension and Hyperlipidemia.
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="card" style="background:#03c655">
                <div class="card-header" style=""><center>List BMI</center></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!empty($list_bmi[0]))
                        <div id="bmi">
                            <table class="table table-responsive-sm " style="background:#03c655;color:white">
                                <thead style="background:#00a445">
                                    <th><center>Tanggal</center></th>
                                    <th>Tinggi</th>
                                    <th>Berat</th>
                                    <th>BMI</th>
                                    <th><center>Status</center></th>
                                    <th><center>Action</center> </th>
                                </thead>
                                <tbody style="background:#00a445">
                                    <?php foreach($list_bmi as $bmi):?>
                                    <tr>
                                        @if(Auth::id() == $bmi->id_user)
                                            <td><center>{{ date('D d/m/y',strtotime($bmi->tanggal)) }}</center></td>
                                            <td><center>{{ $bmi->tinggi }}</center></td>
                                            <td><center>{{ $bmi->berat }}</center></td>
                                            <td><center>{{ $bmi->bmi }}</center></td>

                                            @if($bmi->bmi <= 18.4)
                                                <td><center><label class="btn btn-primary" >{{ "Underweight" }}</label></center></td>
                                            @elseif($bmi->bmi >= 18.5 && $bmi->bmi <= 24.9)
                                                <td><center><label class="btn btn-success">{{ "Normal" }}</label></center></td>
                                            @elseif($bmi->bmi >= 25 && $bmi->bmi <= 29.9)
                                                <td><center><label class="btn btn-warning" >{{ "Overweight" }}</label></center></td>
                                            @elseif($bmi->bmi >= 30 && $bmi->bmi <= 34.9)
                                                <td><center><label class="btn btn-warning">{{ "Obese" }}</label></center></td>
                                            @else
                                                <td><center><label class="btn btn-danger" >{{ "Extremly Obese" }}</label></center></td>
                                            @endif
                                                <td>
                                                    <center>
                                                        <a href="{{ url('bmi/edit/'.$bmi->id) }}">
                                                            <img src="img/edit.png" alt="edit" width="20%">
                                                        </a>
                                                    </center>
                                                </td>
                                        @endif
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                            <div class="navbar">
                                <div class="navbar navbar-nav navbar-left">
                                    <h5>Jumlah: {{ $count_bmi }}</h5>
                                </div>
                                <div class="navbar navbar-nav navbar-right">
                                    {{ $list_bmi->links() }}
                                </div>    
                            </div>
                        </div>
                    @else
                        <center><p>Data BMI belum ada!</p></center>
                    @endif
                    <div>
                        <center><a href="create" class="btn btn-success" 
                        style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 3px 10px 0 rgba(0,0,0,0.19);">Tambah Data</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection