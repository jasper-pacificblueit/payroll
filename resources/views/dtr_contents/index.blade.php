@extends('layouts.master')

@section('title', 'Attendance Report')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Attendance</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/employee"><strong>View Attendance</strong></a>
                </li>
               
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content animated fadeInRight no-padding">
        <div class="wrapper wrapper-content animated fadeInRight no-padding">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-3 m-b-xs">
                                    <h4>Select Company:</h4>
                                    <select class="form-control">
                                        @foreach ($companies as $company)
                                            <option>{{$company->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>

                               
                                <div class="col-sm-3 m-b-xs">
                                    <h4>Import Attendance</h4>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>

                                <div class="col-sm-3 pull-right">
                                    <h4>&nbsp;</h4>
                                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            @for ($i = 0; $i < 15; $i++)
                                            <th>{{$i}}</th>
                                            @endfor
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Jose Rizal</td>
                                                <td>I.T. Department</td>
                                                @for ($i = 0; $i < 15; $i++)
                                                <td>--</td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                <td>Jose Rizal</td>
                                                <td>I.T. Department</td>
                                                @for ($i = 0; $i < 15; $i++)
                                                <td>--</td>
                                                @endfor
                                            </tr>
                                        
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="17">
                                                <ul class="pagination pull-right"></ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
        
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
   
            
@endsection


@section('scripts')
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}
 

<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>

@endsection