<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Session;
use App\BMI;
use App\User;


class BMIController extends Controller
{
    protected $request;

    public function index() {
        $id = Auth::id();
        $list_bmi = BMI::where('id_user',$id)->orderBy('tanggal','desc')->simplePaginate(3);
        $count_bmi = BMI::where('id_user',$id)->count();

        $data = BMI::all();
        $iakhir = count($data);
        
        $i = 0;
        $counter = 0;
        if($count_bmi!=0){
            do{
                if($data[$i]['id_user']==$id){
                    $bmi[$counter] = $data[$i]['bmi'];
                    $berat[$counter] = $data[$i]['berat'];
                    $tinggi[$counter] = $data[$i]['tinggi'];
                    $tanggal[$counter] = date('d/m',strtotime($data[$i]['tanggal']));
                    $counter++;
                }
                $i++;
            }while($i<$iakhir);

            $firstbmi = $data->where('id_user',$id)->first();
            $lastbmi = $data->where('id_user',$id)->last();
            $numtinggi = $firstbmi->tinggi - $lastbmi->tinggi;
            $numberat = $firstbmi->berat - $lastbmi->berat;
            $numbmi = $firstbmi->bmi - $lastbmi->bmi;

            if($numtinggi < 0){
                $numtinggi = $numtinggi * -1;
            }
            if($numberat < 0){
                $numberat = $numberat * -1;
            }
            if($numbmi < 0){
                $numbmi = $numbmi * -1;
            }

            return view('bmi.index', compact('list_bmi', 'count_bmi', 'berat', 'tinggi', 'tanggal', 'bmi', 'firstbmi', 'lastbmi', 'numtinggi', 'numberat', 'numbmi'));
        }
        else{
            $bmi[] = null;
            $berat[] = null;
            $tinggi[] = null;
            $tanggal[] = null;
        }

        return view('bmi.index', compact('list_bmi', 'count_bmi', 'berat', 'tinggi', 'tanggal', 'bmi'));
        
    }

    public function create() {
        return view('bmi.create');
    }

    public function generate(Request $request) {
        $validator = Validator::make($request->all(), [
            'tinggi'        => 'required|numeric|max:253|min:60',
            'berat'         => 'required|numeric|max:500|min:25',
        ]);

        if($validator->fails()){
            return redirect('create')
                    ->withInput()
                    ->withErrors($validator);
        }
        else{

            $input = new BMI;
            $input->tinggi = $request->tinggi;
            $input->berat  = $request->berat;
            $input->bmi    = $request->bmi;
            $input->id_user= $request->id_user;

            $t = $request->tinggi/100;
            $b = $request->berat;
            $hitung = number_format((float)$b/$t/$t,2,'.','');
            $input['tanggal'] = date("Y-m-d");
            $input['bmi'] = $hitung;
            
            if(Auth::user()){
                $num = Auth::id();
                $input['id_user'] = $num;

                $cek = BMI::get()->where('id_user',$num);
                $cek = $cek->last();
                if(!empty($cek) && $cek->tanggal == $input->tanggal){
                    $cek['tinggi'] = $input['tinggi'];
                    $cek['berat'] = $input['berat'];
                    $cek['bmi'] = $input['bmi'];
                    $cek->update();
                    Session::flash('flash_message', 'Data hari ini telah diupdate!');
                    return redirect('bmishow');
                }
            }
            else{
                $input['id_user'] = 0;
                $cek = BMI::get()->where('id_user',0);
                $cek = $cek->first();
                
                if(!empty($cek)){
                    $cek['tanggal'] = $input['tanggal'];
                    $cek['tinggi'] = $input['tinggi'];
                    $cek['berat'] = $input['berat'];
                    $cek['bmi'] = $input['bmi'];
                    $cek->update();
                    return redirect('bmishow');
                }
            }
        }

        $input->save();
        Session::flash('flash_message', 'Data berhasil diinputkan!');
        return redirect('bmishow');
    }

    public function show() {
        if(Auth::user()){
            $id = BMI::get()->where('id_user',Auth::id());
            $bmi = $id->last();
        }
        else{
            $id = BMI::get()->where('id_user',0);
            $bmi = $id->last();
        }
        
        return view('bmi.show',compact('bmi'));
    }

    public function edit($id) {
        $bmi = BMI::findOrFail($id);
        return view('bmi.edit',compact('bmi')); 
    }

    public function update($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'tinggi'        => 'required|numeric|max:253|min:60',
            'berat'         => 'required|numeric|max:500|min:25',
        ]);
 
        if($validator->fails()){
            return redirect('bmi/edit')
                    ->withInput()
                    ->withErrors($validator);
        }
        else{
            $bmi = BMI::findOrFail($id);
            $input = $request->all();

            $t = $request->tinggi/100;
            $b = $request->berat;
            $hitung = number_format((float)$b/$t/$t,2,'.','');
            $input['bmi'] = $hitung;
            $bmi['bmi'] = $input['bmi'];
        }
        
        $bmi->update($request->all());
        Session::flash('flash_message', 'Data telah diupdate!');
        return redirect('bmi');
    }
}