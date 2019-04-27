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
                               <input type="text" name="firstName" class="form-control p-2">
    
                               <label>Last name</label>
                               <input type="text" name="lastName" class="form-control p-2">
    
                               <label>Middle name</label>
                               <input type="text" name="middleName" class="form-control p-2">

                               <label>E-mail</label>
                               <input type="email" name="email" class="form-control p-2">

                               <label>Mobile number</label>
                               <input type="text" name="mobile" class="form-control p-2">
    
                               <label>Phone number</label>
                               <input type="text" name="phone" class="form-control p-2">

                               <label>Position</label>
                               <select class='form-control' name='position'>
                                  @if (auth()->user()->position == 'hr')
                                    <option value='employee'>Employee</option>
                                  @elseif (auth()->user()->position == 'admin')
                                    <option value='hr'>HR</option>
                                    <option value='employee'>Employee</option>
                                  @endif
                               </select>
                            </div>
    
                            <div class="col-lg-6">
                                <label>Gender</label>
                                <select class='form-control' name='gender'>
                                  <option value='1'>Male</option>
                                  <option value='0'>Female</option>
                                </select>
                                <label>Birthdate</label>
                                <input type="date" name="birthdate" class="form-control">

                                <label>Employee address</label>
                                <input type="text" name="address" class="form-control">

                                <label>Employee username</label>
                                <input type="text" name="user" class="form-control">

                                <label>Employee password</label>
                                <input type="password" name="pass" class="form-control">

                                <label>Company name</label>
                                <select class="form-control" name="company" onchange="chdep()">
                                  @foreach($company as $i)
                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                  @endforeach
                                </select>
    
                                <label>Department</label>
                                <select class="form-control company-dep" name="department">
                                  @foreach($company[0]->departments as $dep)
                                    <option value="{{ $dep->id }}">{{$dep->name}}</option>
                                  @endforeach       
                                </select>
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hr-line-dashed"></div>
                                <div class="form-group text-right">
                                    <div >
                                        <button class="btn btn-success" type="submit">Submit</button>
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
    <br>

  @foreach($company as $i)
    <template id="dep-option-{{ $i->id }}">
    @foreach($i->departments as $dep)
      <option value="{{ $dep->id }}">{{ $dep->name }}</option>
    @endforeach
    </template>
  @endforeach