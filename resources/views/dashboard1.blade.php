<div class="wrapper wrapper-content" style="height: 1000px">
<div class="row dashboard1">
  <div class="col-lg-3 col-sm-6" style="padding: 0">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5>Profile</h5>
        </div>
        <div class="ibox-content text-center no-padding border-left-right">
          <img alt="image" class="img-responsive" src="{{ json_decode(auth()->user()->profile->image)->data }}" style="margin: auto">
        </div>
        <div class="ibox-content profile-content">
            <h4><i class="fas fa-dot-circle" style="color: #23c6c8"></i>&nbsp; {{ App\Profile::getFullName(auth()->user()->id) }}</h4>
            <p>
              <i class="fas fa-map-marker-alt"></i>  {{ auth()->user()->profile->address ? auth()->user()->profile->address : "Where do you live?" }}
            </p>
            <h5>About me</h5>
            <p style='word-wrap: break-word;'>
              {{ auth()->user()->profile->about ? auth()->user()->profile->about : "Write something about yourself." }}
            </p>
            <h5>Details</h5>
            <div></div>
        </div>
        <div class="ibox-footer">
          
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">Monthly</span>
          <h5>News</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">Monthly</span>
          <h5>Income</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">Monthly</span>
          <h5>Income</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">Monthly</span>
          <h5>Income</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">Monthly</span>
          <h5>Income</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <span class="label label-success pull-right">Monthly</span>
            <h5>Income</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">40 886,200</h1>
            <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
            <small>Total income</small>
        </div>
    </div>
  </div>
  <div class="col-lg-3 col-sm-6">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <span class="label label-info pull-right">Annual</span>
              <h5>Orders</h5>
          </div>
          <div class="ibox-content">
              <h1 class="no-margins">275,800</h1>
              <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
              <small>New orders</small>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <span class="label label-primary pull-right">Today</span>
            <h5>visits</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins">106,120</h1>
            <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
            <small>New visits</small>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6">
  <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-danger pull-right">Low value</span>
          <h5>User activity</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">80,600</h1>
          <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
          <small>In first month</small>
      </div>
  </div>
</div>
</div>
</div>