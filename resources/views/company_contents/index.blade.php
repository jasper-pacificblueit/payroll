@extends('layouts.master')

@section('title', 'Company')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Company</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/employee"><strong>View Companies</strong></a>
                </li>
               
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                   
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-5 m-b-xs">
                                    @can('company_write')
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCompany">
                                                Add Company
                                        </button>

                                        <div class="modal inmodal fade" id="addCompany" tabindex="-1" role="dialog"  aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header no-padding">
                                                        <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                       <h4 style="padding:10px">Add Company</h4>
                                                       
                                                    </div>
                                                    <form method="POST" action="/company">
                                                        {{ csrf_field() }}
                                                        <div class="modal-body">
                                                           <div class="row">
                                                               <div class="col-lg-12">
                                                                <label>Company Name</label>
                                                                <input type="text" name="name" class="form-control" required>
                                                                <label>Address</label>
                                                                <input type="text" name="address" class="form-control" required>
                                                               </div>
                                                           </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class='btn-group'>
                                                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success" name="submit">Create</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endcan
                            </div>
                            
                            <div class="col-sm-3 pull-right">
                               
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success"> Go!</button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Department/s</th>
                                        <th>Employee/s</th>  
                                        <th></th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($companies) > 0)
                                        @foreach ($companies as $company)
                                        <tr>
                                            <td>{{$company->created_at}}</td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->address}}</td>
                                            <td>{{count($company->departments)}}</td>
                                            <td>{{count(App\Employee::where('company_id', '=', $company->id)->get())}}</td>
                                            <td>
                                                <a href="company/{{$company->id}}" class="btn btn-default btn-xs">Manage</a>
                                                <button type="button" class="btn btn-xs btn-danger">Delete</button>
                                            </td>
                                            
                                        </tr>    
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6">No companies yet</td>
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
   
        
@endsection


@section('scripts')
<!-- Custom and plugin javascript -->
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}


 
    <script>
        $(document).ready(function() {

        });
    </script>

@endsection