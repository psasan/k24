<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Event;

use App\PCalendar;
use Calendar;
use Validator;

class PCalendarController extends Controller {
    public function index(){
        return view('pcalendar.inputcalendar');
    }

    public function show() {
        $period = [];
        $ovulation = [];

        $date = "";
        $counter = 0;
        
        $data = PCalendar::all();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $date = $value->start_date;
                do{
                    $period[] = Calendar::event(
                        null,
                        true,
                        new \DateTime($date),
                        new \DateTime($date.' +'.$value->many_days.' day'),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#ff6682',
                        ]
                    );
                    $ovulation[] = Calendar::event(
                        null,
                        true,
                        new \DateTime($date.' +11 day'),
                        new \DateTime($date.' +16 day'),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#79E4E8',
                        ]
                    );
                    $date = $date.'+'.$value->how_long.' day';
                    $counter++;
                }while($counter < 12);
            }
        }

        $calendar = Calendar::addEvents($period);
        $calendar = Calendar::addEvents($ovulation);
        return view('pcalendar.showcalendar', compact('calendar'));
    }

    public function addEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'start_date' => 'required|date',
            'many_days' => 'required|numeric|max:10|min:1',
            'how_long' => 'required|numeric|max:40|min:10',
        ]);

        if($validator->fails()){
            \Session::flash('warning', 'Please enter the valid details!');
            return redirect('calendar')
                    ->withInput()
                    ->withErrors($validator);
        }

        $event = PCalendar::all();
        if(!empty($event)){
            PCalendar::query()->delete();
        }
        
        $event = new PCalendar;
        $event->start_date = $request['start_date'];
        $event->many_days = $request['many_days'];
        $event->how_long = $request['how_long'];
        $event->save();

        \Session::flash('success','Event add successfully!');
        return redirect('show_calendar');
    }
}
