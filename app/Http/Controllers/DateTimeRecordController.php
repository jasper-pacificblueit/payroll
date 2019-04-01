<?php

namespace App\Http\Controllers;

use App\DateTimeRecord;
use App\Company;
use App\Imports\UserImport;
use Excel;
use Illuminate\Http\Request;

class Employee {

    public $bio_id, $dep, $name, $date;

    public $absence, $leave, $btrip, $io_pp;

    public $over = [], $tardiness = [], $early_leave = [];

    public $attendance = [];

    public function __construct($assoc) {
        $this->dep = $assoc['dep'];
        $this->name = $assoc['name'];
    }

};

class DateTimeRecordController extends Controller
{

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

        $upload = $request->file('upload-file');
        
        $filePath = $upload->getRealPath();

        $header = null;
        $data = array();

        if (($handle = fopen($filePath, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        
        DateTimeRecord::insert($data);

        return back();
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

        // employee detail
        for ($i = 2; $i < 7; ++$i) { // row

            $uindex = 0;

            for ($j = 0; $j < count($data[$i]); $j += 15) {
                switch ($i) {
                case 2:
                    array_push($csv_info['employees'], new Employee([
                        'dep' => $data[$i][$j+1],
                        'name' => $data[$i][$j+9]
                    ]));
                    break;
                case 3:
                    $csv_info['employees'][$uindex]->date = $data[$i][$j+1];
                    $csv_info['employees'][$uindex]->bio_id = $data[$i][$j+9];

                    ++$uindex;
                    break;
                case 6:
                    $csv_info['employees'][$uindex]->absence = $data[$i][$j];
                    $csv_info['employees'][$uindex]->leave = $data[$i][$j+1];
                    $csv_info['employees'][$uindex]->btrip = $data[$i][$j+2];
                    $csv_info['employees'][$uindex]->io_pp = $data[$i][$j+4];
                    $csv_info['employees'][$uindex]->over = [
                        'regular' => $data[$i][$j+5],
                        'special' => $data[$i][$j+7],
                    ];

                    $csv_info['employees'][$uindex]->tardiness = [
                        'ts' => $data[$i][$j+8],
                        'mm' => $data[$i][$j+9],
                    ];

                    $csv_info['employees'][$uindex]->early_leave = [
                        'ts' => $data[$i][$j+11],
                        'mm' => $data[$i][$j+13],
                    ];
                    ++$uindex;
                    break;

                }
            }
        }

        // attendance table
        for ($i = 11; $i < count($data); ++$i) {

            if (!$data[$i][0]) break;

            $uindex = 0;

            for ($j = 0; $j < count($data[$i]); $j += 15, ++$uindex) {

                // check if absent
                if (in_array('Absence', array_slice($data[$i], $j+1, $j+13)) ||
                    implode('', array_slice($data[$i], $j+1, $j+13)) == '') {

                    array_push($csv_info['employees'][$uindex]->attendance, (object)[
                        'ddww' => $data[$i][$j],
                        'absent' => true,
                    ]);
                
                    continue;
                }


                array_push($csv_info['employees'][$uindex]->attendance, (object)[

                    'ddww' => $data[$i][$j],

                    'absent' => false,

                    'am' => [
                        'in' => $data[$i][$j+1],
                        'out' => $data[$i][$j+3],
                    ],

                    'pm' => [
                        'in' => $data[$i][$j+6],
                        'out' => $data[$i][$j+8],
                    ],

                    'over' => [
                        'in' => $data[$i][$j+10],
                        'out' => $data[$i][$j+12],
                    ],

                ]);
            }
        }
        
       // dd($csv_info);

        return view('dtr_contents.index')->with(['csv_info' => (object)$csv_info , 'start' => $start , 'end' => $end]);
    }


    // public function records(Request $request) {

    //     // if($request->hasfile('upload-file')){
    //     //     Excel::load($request->file('upload-file')->getRealPath(), function ($reader) {
    //     //         foreach ($reader->toArray() as $key => $row) {
    //     //             $data['user_id'] = $row['user_id'];
    //     //             $data['date'] = $row['date'];

                   
    //     //         }
    //     //     });
    //     // }
    //     // else{
    //     //     dd('q');
    //     // }

        
    //     $upload = $request->file('upload-file');
        
    //     $filePath = $upload->getRealPath();

    //     $header = null;
    //     $data = array();

    //     if (($handle = fopen($filePath, 'r')) !== false)
    //     {
    //         while (($row = fgetcsv($handle, 1000)) !== false)
    //         {

    //             array_push($data, $row);
    //             if (!$header)
    //                  $header = $row;
    //             else
    //                 $data[] = array_combine($header, $row);
    //         }
          
    //         fclose($handle);
    //     }

           
    //     return view('dtr_contents.index' , compact('data'));
    // }
}
