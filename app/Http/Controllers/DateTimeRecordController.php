<?php

namespace App\Http\Controllers;

use App\DateTimeRecord;
use App\Company;
use App\Imports\UserImport;
use Excel;
use Illuminate\Http\Request;

class DateTimeRecordController extends Controller
{
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


    public function viewFile(Request $request){

        $data = Excel::toArray(new UserImport , $request->file('upload-file'));
<<<<<<< HEAD
        
    
        return view('dtr_contents.index')->with(compact('data'));
=======

        dd($data[0]);

        return view('dtr_contents.index' , compact('data'));
>>>>>>> e94c534d9fc6282b84475c1a28d748ee2981aee6
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
