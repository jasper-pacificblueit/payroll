<div class="wrapper wrapper-content">
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
            <div class="row">
              <div class="col-lg-12" style="padding: 0px; overflow: hidden;">
                <div class="col-lg-3"><strong>Birthdate</strong></div>
                <div class="col-lg-9" style="padding-left: 25px">{{ auth()->user()->profile->birthdate }}</div>
                <div class="col-lg-3"><strong>Email</strong></div>
                <div class="col-lg-9" style="padding-left: 25px">{{ auth()->user()->contacts[0]->email }}</div>
                <div class="col-lg-3"><strong>Mobile</strong></div>
                <div class="col-lg-9" style="padding-left: 25px">{{ auth()->user()->contacts[0]->mobile ? auth()->user()->contacts[0]->mobile : "No contact number" }}</div>
                <div class="col-lg-3"><strong>Gender</strong></div>
                <div class="col-lg-9" style="padding-left: 25px">{{ auth()->user()->profile->gender ? "Male" : "Female"}}</div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">count</span>
          <h5><i class="fas fa-users"></i> Employees</h5>
      </div>
      <div class="ibox-content">
        
        <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
        <small>Total income</small>
      </div>
    </div>
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">Monthly</span>
          <h5>Netpay</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Companies</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Companies</h5>
      </div>
      <div class="ibox-content">
          <h1 class="no-margins">40 886,200</h1>
          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
          <small>Total income</small>
      </div>
    </div>
  </div>

    <div class="col-lg-6 col-sm-6 @if (auth()->user()->position()->title == "Administrator") hidden @endif">
    @php
      $date = "01-2019";

      if (request("date") != "") $date = request("date");

      $dtr = App\DateTimeRecord::where("user_id", auth()->user()->id)->where("date", "like", "%".$date."%")->get();
    @endphp
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <span class="label label-success pull-right">{{ date("F", strtotime(request("date"))) }}</span>
          <h5><i class="fa fa-clock-o" aria-hidden="true"></i> Attendance</h5>
      </div>
      <div class="ibox-content">
         <div class="table-responsive" style="max-height: 380px">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Time In (AM)</th>
                <th>Time Out (AM)</th>
                <th>Time In (PM)</th>
                <th>Time Out (PM)</th>
                <th>Total Hours</th>
              </tr>
            </thead>
            <tbody>
              @php
                $totalhours = 0;
              @endphp
              @foreach ($dtr as $att)
              @php
                $in = strtotime($att["in_am"]) + strtotime($att["in_pm"]) ;
                $out = strtotime($att["out_am"]) + strtotime($att["out_pm"]);

                $condi = ($out - $in) / 3600 <= 0 || ($out - $in) / 3600 >= 24;
              @endphp
                <tr data-toggle="tooltip" data-placement="bottom" title="{{ (new Carbon\Carbon($att["date"]))->toFormattedDateString() }}"
                @if ($condi)
                 class="alert alert-danger"
                @else
                  @php($totalhours += ($out - $in) / 3600)
                @endif >
                  <td>{{ $att["in_am"] }}</td>
                  <td>{{ $att["out_am"] }}</td>
                  <td>{{ $att["in_pm"] }}</td>
                  <td>{{ $att["out_pm"] }}</td>
                  <td>{{ number_format(($out - $in) / 3600, 2) }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
          <div class="col-lg-12" style="padding: 0px">
            <div class="col-lg-4" style="padding: 1px">
              <input type="number" class="form-control" name="year" value="{{ date("Y") }}">
            </div>
            <div class="col-lg-6" style="padding: 1px;">
              <select class="form-control" name="month">
                <option value="01" selected>January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </div>
            <div class="col-lg-2" style="padding: 1px;">
              <button class="btn btn-md btn-success" onclick="


                window.location.href = `/?date=${document.querySelector('input[name=year]').value}-${document.querySelector('select[name=month]').value}`;

              ">GET</button>
            </div>
          </div>
        </div>
        <div class="ibox-footer">
            <div class="stat-percent font-bold text-success">{{ number_format($totalhours, 2) }} <i class="fa fa-clock"></i></div>
            <label>Total hours</label>
            </div>
        </div>
    </div>
  </div>

  @can ("employee_View")
  @can ("position_View")
  <div class="col-lg-6 col-sm-6" style="clear: left;">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5><i class="far fa-chart-bar"></i> Position Statistics</h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-lg-12">
            <canvas id="chart-area"></canvas>
          </div>
        </div>
      </div>
      <div class="ibox-footer">

      </div>
    </div>
  </div>
  @endcan
  @endcan

  <div class="col-lg-6 col-sm-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5><i class="far fa-chart-bar"></i> Position Statistics</h5>
      </div>
      <div class="ibox-content">
        <div class="row">
          <div class="col-lg-12">
            <canvas id="chart-area"></canvas>
          </div>
        </div>
      </div>
      <div class="ibox-footer">

      </div>
    </div>
  </div>

  <div class="col-lg-6" style="clear: left;">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5><i class="far fa-newspaper"></i> News</h5>
      </div>
      <div class="ibox-content" style="padding-bottom: 1px">
        <span id="newsapi" style="margin: 0">
          <div class="no-padding text-center">
            <h1 style="padding: 72px">No news available</h1>
          </div>
        </span>
      </div>
      <div class="ibox-footer newsapi-details">
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