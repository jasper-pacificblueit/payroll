<?php

namespace App\Http\Controllers;
use App;
use App\DateTimeRecord;
use App\Company;
use App\Imports\UserImport;
use Excel;
use Illuminate\Http\Request;
use App\PayrollDate;
use Carbon\Carbon;
use DateTime;

class Employee {

    public $bio_id, $dep, $name, $date;

    public $absence, $leave, $btrip, $io_pp , $totalHrs;

    public $over = [], $tardiness = [], $early_leave = [];

    public $attendance = [];

    public function __construct($assoc) {
        $this->dep = $assoc['dep'];
        $this->name = $assoc['name'];
    }

};

class DateTimeRecordController extends Controller
{
    public function getEmployee(Request $request){
        $data = Employee::with('getProfile')->find($request->input('id'));
        return response()->json($data);
    }
    public function selectDate(Request $request){
        
       $data = \App\PayrollDate::find($request->input('q'));
       
       return view('dtr_contents.tableBody' , compact('data'));
    }

    public function records(Request $request)
    {
       
       return view('dtr_contents.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('dtr_contents.index' , compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

 
    public function store(Request $request)
    {
        
        //dd($request->totalHours);
        $csv_info = json_decode($request->info, true);

        $days = json_decode($request->days, true);
        $records = (object)$csv_info;
       
       //dd($days , $request->warningTimeOut);
        //dd($request->payrollDate1);
    
       $empCount = 0;
       //dd($request->warningTimeOut);
       
       $checkAttendance = App\PayrollDate::where('start', '=' , $request->payrollDate1, 'AND' , 'end' , '=' , $request->payrollDate2)->get();

       if(!count($checkAttendance) > 0){
            foreach($csv_info['employees'] as $employee){
            
            
            $count = 0;
            $dayCount = 0;
            foreach($employee['attendance'] as $attendance){
               
                if(!$attendance['absent']){
                  
                    $dtr = new App\DateTimeRecord;
                   
                    $in_am = date("H:i" , strtotime($attendance['am']['in']));
                    $out_am = date("H:i" , strtotime($attendance['am']['out']));
                    $in_pm = date("H:i" , strtotime($attendance['pm']['in']));
                    $out_pm = date("H:i" , strtotime($attendance['pm']['out']));
                   
                    
                   $dtr->user_id = $request->UserID[$employee['bio_id']][$empCount];
                   $dtr->date = date("Y-m-d" , strtotime($days[$dayCount]));
                   $dtr->in_am = $attendance['am']['in'];
                   $dtr->in_pm = $attendance['pm']['in'];
                   if(empty($attendance['am']['out']) && empty($attendance['pm']['out'])){
                    $dtr->out_pm = $request->warningTimeOut[$employee['bio_id']][$count];

                    $count++;
                    
                   }
                   else{
                    $dtr->out_am = $attendance['am']['out'];
                    $dtr->out_pm = $attendance['pm']['out'];
                    
                   }
                   
                   
                    $dtr->total_hours = $request->totalHours[$employee['bio_id']][$count];
                       
                       
                    $dtr->save(); 
                 
                }
              
                
               $dayCount++;
            }
            
        }
        $empCount++;
        
        $payrolldate = new App\PayrollDate;
        $payrolldate->start = $request->payrollDate1;
        $payrolldate->end = $request->payrollDate2;
        $payrolldate->save();
        

        $date = App\PayrollDate::orderBy('id' , 'desc')->first();

        
        return redirect('dtr-records');
       }
       else{

          $result = 'danger';
           return view('dtr_contents.index' , compact('result'));
       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DateTimeRecord  $dateTimeRecord
     * @return \Illuminate\Http\Response
     */
    public function show(DateTimeRecord $dateTimeRecord)
    {
        //

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DateTimeRecord  $dateTimeRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(DateTimeRecord $dateTimeRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DateTimeRecord  $dateTimeRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DateTimeRecord $dateTimeRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DateTimeRecord  $dateTimeRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(DateTimeRecord $dateTimeRecord)
    {
        //
    }


    public function viewFile(Request $request) {

        $start = $request->start;
        $end = $request->end;
        
        $data = Excel::toArray(new DateTimeRecord, $request->file('upload-file'))[0];
        
        // return view('dtr_contents.index')->with(compact('data'));
        
        $csv_info = [

            'period' => $data[1][3],
            'printed' => $data[1][18],
            'employees' => [],

        ];

        $period = new DateTime($csv_info['printed']);

        $is_leap;
        $days;

        if (!((int)$period->format('Y') % 4)) $is_leap = false;
        else if (!((int)$period->format('Y') % 400)) $is_leap = false;
        else if (!((int)$period->format('Y') % 100)) $is_leap = true;
        else $is_leap = true;

        switch ((int)$period->format('m')) {
        case 2: $days = 27+$is_leap; break;     // february should have 28 days.
        case 4:
        case 6:
        case 9:
        case 11:
            $days = 30;
            break;
        default:
            $days = 31; 
        }

        // traverses every dtr info in the standard spreadsheet file.
        for ($i = 2, $em = 0; $i < count($data); $i += $days+10) {
            // employee detail [row]
            foreach (array_slice($data, $i, 5) as $k => $ems) {
                for ($j = 0, $uindex = $em; $j < count($ems); $j += 15) {
                    switch ($k) {
                    case 0:
                        array_push($csv_info["employees"], new Employee([
                            'dep' => $ems[$j+1],
                            'name' => $ems[$j+9],
                        ]));
                        break;
                    case 1:
                        $csv_info["employees"][$uindex]->date = $ems[$j+1];
                        $csv_info["employees"][$uindex]->bio_id = $ems[$j+9];

                        ++$uindex;
                        break;
                    case 4:
                        $csv_info["employees"][$uindex]->absence = $ems[$j];
                        $csv_info['employees'][$uindex]->leave = $ems[$j+1];
                        $csv_info['employees'][$uindex]->btrip = $ems[$j+2];
                        $csv_info['employees'][$uindex]->io_pp = $ems[$j+4];
                        $csv_info['employees'][$uindex]->over = [
                            'regular' => $ems[$j+5],
                            'special' => $ems[$j+7],
                        ];

                        $csv_info['employees'][$uindex]->tardiness = [
                            'ts' => $ems[$j+8],
                            'mm' => $ems[$j+9],
                        ];

                        $csv_info['employees'][$uindex]->early_leave = [
                            'ts' => $ems[$j+11],
                            'mm' => $ems[$j+13],
                        ];

                        ++$uindex;
                        break;
                    }
                }
            }

            // employee attendance [row]
            foreach (array_slice($data, $i+9, $days) as $att) {

                for ($j = 0, $uindex = $em; $j < count($att); $j += 15, ++$uindex) {
                    $val = implode('', array_slice($att, $j+1, 13));

                    if ($val == "" || $val == "Absence" || $val == "absence") {
                        array_push($csv_info['employees'][$uindex]->attendance, (object)[
                            'ddww' => $att[$j],
                            'absent' => true,
                        ]);
                        continue;
                    }

                    array_push($csv_info["employees"][$uindex]->attendance, (object)[
                        'ddww' => $att[$j],
                        'absent' => false,

                        'am' => [
                            'in' => $att[$j+1],
                            'out' => $att[$j+3],
                        ],

                        'pm' => [
                            'in' => $att[$j+6],
                            'out' => $att[$j+8],
                        ],

                        'over' => [
                            'in' => $att[$j+10],
                            'out' => $att[$j+12],
                        ],
                    ]);

                }
            }

            $em = $uindex;
        }

        $employees = [];

        // [cleanup] remove any null employee records.
        for ($j = 0; $j < count($csv_info["employees"]); ++$j)
            if ($csv_info["employees"][$j]->name != "")
                array_push($employees, $csv_info["employees"][$j]);

        $csv_info["employees"] = $employees;


        return view('dtr_contents.index')
          ->with(['csv_info' => (object)$csv_info , 'start' => $start , 'end' => $end]);
    }

}
