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
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addPosition">
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
                                    <table class="table table-striped table-hover positionTable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date Created</th>
                                            <th>Job Title</th>
                                            <th class="hidden-xs hidden-sm">Description</th>
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
                        @if ($position->id != 1)
                        @if ($position->count() <= 0)
                        <button type="button" class="btn btn-sm btn-danger" onclick='

                            fetch("/positions/{{ $position->id }}", {
                                method: "delete",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                }
                            }).then(rep => rep.json()).then(json => {

                                console.log(json);


                            });

                        ' data-dismiss="modal">Remove</button>
                        @endif
                        @endif
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
                                                    <td width=500 class="hidden-xs hidden-sm">{{ $position->description }}</td>
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

       $(".positionTable").DataTable({
            pageLength: 10,
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },


       });

    });

   
    
</script>
@endsection