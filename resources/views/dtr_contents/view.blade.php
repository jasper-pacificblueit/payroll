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
                    <a href="/employee"><strong>View File</strong></a>
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
                                
                               
                                
                                <div class="col-sm-3 pull-right">
                                    <h4>&nbsp;</h4>
                                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                                   placeholder="Search in table">
                                </div>
                                
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach($data[0] as $j)
                                        <li>{{ $j['user_id'] }}</li>
                                        <li>{{ $j['date'] }}</li>
                                    @endforeach
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