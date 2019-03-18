@extends('layouts.master')

@section('title', 'Employee')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Employee</h2>
            <ol class="breadcrumb">
                    <li class="active">
                        <a href="/">Dashboard</a>
                    </li>
                    <li>
                        <a href="/employee/add"><strong>Add Employee</strong></a>
                    </li>
                   
                </ol>
        </div>
    </div>
    <Br>
    <div class="wrapper wrapper-content animated fadeInRight no-padding" >
       <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Please fill up the form</h5>
                </div>
                <div class="ibox-content">

                    <form method="post" action="/employee/keep">
                      {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                               <label>First name</label>
                               <input type="text" name="firstName" class="form-control">
                               <br>
    
                               <label>Last name</label>
                               <input type="text" name="lastName" class="form-control">
                               <br>
    
                               <label>Middle name</label>
                               <input type="text" name="middleName" class="form-control">
                               <br>
    
                               <label>E-mail</label>
                               <input type="text" name="email" class="form-control">
                               <br>
    
                               <label>Phone number</label>
                               <input type="text" name="phone" class="form-control">
                               <br>

                               <label>Position</label>
                               <input type="text" name="position" class="form-control">
                               <br>
                                
                               <label>Mobile number</label>
                               <input type="text" name="mobile" class="form-control">
                               <br>

                            </div>
    
                            <div class="col-lg-6">
                                <label>Company name</label>
                                <select class="form-control" name="company">
                                    @foreach($company as $i)
                                      <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                                <br>
    
                                <label>Department</label>
                                <select class="form-control" name="department">
                                    @foreach($company as $i)
                                      @foreach($i->departments as $j)
                                        <option value="{{ $j->id }}">[{{ $i->name }}] {{ $j->name }}</option>
                                      @endforeach
                                    @endforeach
                                </select>
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div >
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
    
                        
                </div>
                    
                </div>
            </div>
        </div>
     </div>
    <Br>

@endsection


@section('scripts')

    <script>
        $(document).ready(function() {

        });
    </script>

@endsection