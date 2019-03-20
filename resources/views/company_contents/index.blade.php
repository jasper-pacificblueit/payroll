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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompany">
                                            Add Company
                                    </button>
                                    
                                    <div class="modal inmodal fade" id="addCompany" tabindex="-1" role="dialog"  aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header no-padding">
                                                        <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                       <h4 style="padding:10px">Add Company</h4>
                                                       
                                                    </div>
                                                    <div class="modal-body">
                                                       <div class="row">
                                                           <div class="col-lg-12">
                                                                <form method="POST" action="/company">
                                                                    {{ csrf_field() }}
                                                                    <label>Company Name</label>
                                                                    <input type="text" name="name" class="form-control" required>
                                                                    <br>
                                                                    <label>Address</label>
                                                                    <input type="text" name="address" class="form-control" required>
                                                                
                                                           </div>
                                                       </div>
                                                    </div>
            
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" name="submit">Create</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            
                            <div class="col-sm-3 pull-right">
                               
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Company ID</th>
                                        <th>Company name</th>
                                        <th>Address</th>
                                        <th>Departments</th>
                                        <th>Employee/s</th>  
                                        <th>Action</th>  
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($companies) > 0)
                                        @foreach ($companies as $company)
                                        <tr>
                                            <td>{{$company->id}}</td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->address}}</td>
                                            <td>{{count($company->departments)}}</td>
                                            <td>{{count(App\Employee::all())}}</td>
                                            <td><a href="company/{{$company->id}}" class="btn btn-default btn-xs">Manage</a></td>
                                            
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
    <script>
        $(document).ready(function() {

        });
    </script>

@endsection