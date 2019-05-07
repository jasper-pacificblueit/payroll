@extends('layouts.master')

@section('title', 'Payroll')

@section('styles')

{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/select2/select2.min.css') !!}
{!! Html::style('css/plugins/daterangepicker/daterangepicker-bs3.css') !!}
{!! Html::style('css/plugins/datapicker/datepicker3.css') !!}
{!! Html::style('css/plugins/iCheck/custom.css') !!}



@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Positions</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/positions"><strong>Manage Positions</strong></a>
                </li>
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">

             <div class="row">
                <div class="col-lg-12">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                               @if (isset($status))
                                    <div class="alert alert-success">
                                     Position added successfully 
                                    </div>
                               @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPosition">
                                    Add Position
                                </button>
                                <div class="modal inmodal fade" id="addPosition" tabindex="-1" role="dialog"  aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title">Add a Position</h4>
                                                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="positions" method="POST">
                                                        {{ csrf_field() }}
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h4>Name</h4>
                                                                <input type="text" name="name" id="" class="form-control" required>
                                                            </div>
                                                            
                                                            
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h4>Description</h4>
                                                                <input type="text" name="description" id="" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
        
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                    <button type="submit" name="createPosition" class="btn btn-primary">Create</button>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date Created</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Employee/s</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>                                        
                                            @if ( ($Positions = \App\Positions::all())->count() > 0)
                                                @foreach ($Positions as $position)
                                                <tr ondblclick="$('#position-{{ $position->id }}').modal('show');">
                                                    <td>
                                                        {{$position->id}}

<!-- @@@@@@@@@@@@ modal @@@@@@@@@@@@ -->
<div class="modal inmodal fade" id="position-{{ $position->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px"></h4>
            </div>
            <form>
                <div class="modal-body">
                   <div class="row">
                       <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                       </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id='close'>Close</button>
                        <button type="submit" class="btn btn-sm btn-success" name="submit">Save</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Remove</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
                                                    </td>
                                                    <td>{{$position->created_at}}</td>
                                                    <td>{{$position->title}}</td>
                                                    <td width=500>{{ $position->description }}</td>
                                                    <td>{{ $position->count() }}/{{ $position->lim }}</td>
                                                    <td>
                                                        @php
                                                            switch ($position->state) {
                                                            case 0:
                                                                echo "<span class='alert-success'>Available</span>";
                                                                break;
                                                            case 1:
                                                                echo "<span class='alert-warning'>Unavailable</span>";
                                                                break;
                                                            case 2:
                                                                echo "<span class='alert-info'>Temporarily Unavailable</span>";
                                                                break;
                                                            default:
                                                                echo "<span class='alert-danger'>Unknown</span>";
                                                            }
                                                        @endphp
                                                    </td>
                                                 </tr> 
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4"><span class="text-muted">No positions</span></td>
                                                </tr>
                                            @endif
                                        </tbody>
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

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/select2/select2.full.min.js') !!}
{!! Html::script('js/plugins/daterangepicker/daterangepicker.js') !!}
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}
{!! Html::script('js/plugins/iCheck/icheck.min.js') !!}

<script>
    
    $(document).ready(function(){

       

    });

   
    
</script>
@endsection