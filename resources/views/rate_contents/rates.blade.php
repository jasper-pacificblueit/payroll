<div class="row">

   <div class="col-lg-12">

        @php($Employee = \App\Employee::all())
                
        @foreach ($Employee as $employee)
      
            <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="forum-icon">
                                <i class="fa fa-user"></i>
                                {{-- <img src="{{((array)json_decode($employee->getProfile->image))['data']}}" alt="" width="55px">  --}}
                            </div>
                            <a href="forum_post.html" class="forum-item-title">{{$employee->getProfile->lname}} {{$employee->getProfile->fname}}</a>
                            <div class="forum-sub-title">{{$employee->getDepartment->name}} | {{$employee->user->position}}</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ₱ {{$employee->rates->hourly}}
                            </span>
                            <div>
                                <small>Hourly Rate</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ₱ {{$employee->rates->hourly}}
                            </span>
                            <div>
                                <small>Hourly Rate</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ₱ {{$employee->rates->hourly}}
                            </span>
                            <div>
                                <small>Hourly Rate</small>
                            </div>
                        </div>
                        
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ₱ 0
                            </span>
                            <div>
                                <small>Overtime</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                ₱ 0
                            </span>
                            <div>
                                <small>Holiday</small>
                            </div>
                        </div>
                    </div>
            </div>
        @endforeach
                
               

            
   </div>
</div>
   
   