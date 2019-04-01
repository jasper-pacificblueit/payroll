@extends('layouts.master')

@section('title', 'Attendance Report')

@section('styles')

{!! Html::style('css/plugins/dropzone/basic.css') !!}
{!! Html::style('css/plugins/dropzone/dropzone.css') !!}
{!! Html::style('css/plugins/jasny/jasny-bootstrap.min.css') !!}
{!! Html::style('css/plugins/codemirror/codemirror.css') !!}
{!! Html::style('css/plugins/codemirror/codemirror.css') !!}

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Attendance</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/employee"><strong>Import Attendance</strong></a>
                </li>
               
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">

                <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="{{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}"><a href="/dtr"> Import Attendance</a></li>
                                <li class="{{Request::path() == 'dtr/records' ? 'active' : '' }}"><a href="/records">Records</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="import" class="tab-pane {{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}">
                                    <div class="panel-body">
                                        @include('dtr_contents.import')
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Donec quam felis</strong>
    
                                        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                                            and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>
    
                                        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                                            sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                                    </div>
                                </div>
                            </div>
    
    
                        </div>
                    </div>
           
        </div>
    </div>
    

    <?php
        function GetDays($sStartDate, $sEndDate){  
                // Firstly, format the provided dates.  
                // This function works best with YYYY-MM-DD  
                // but other date formats will work thanks  
                // to strtotime().  
                $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
                $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  

                // Start the variable off with the start date  
                $aDays[] = $sStartDate;  

                // Set a 'temp' variable, sCurrentDate, with  
                // the start date - before beginning the loop  
                $sCurrentDate = $sStartDate;  

                // While the current date is less than the end date  
                while($sCurrentDate < $sEndDate){  
                // Add a day to the current date  
                $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  

                // Add this new day to the aDays array  
                $aDays[] = $sCurrentDate;  
                }  

                // Once the loop has finished, return the  
                // array of days.  
                return $aDays;  
       }  
            
      
    ?>
    <div class="modal inmodal fade" id="showWarning" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Set Value for Warnings</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                            <div class="col-lg-12">
                                
                            </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('scripts')

{!! Html::script('js/plugins/codemirror/mode/xml/xml.js') !!} 

<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();


    });
</script>
@endsection