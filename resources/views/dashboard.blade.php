@extends('layouts.master')

@section('title', 'Dashboard')

@php
  use Carbon\Carbon;
@endphp

@section('content')
<div class="wrapper wrapper-content">
<div class="row">
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
            <h4>{{ App\Profile::getFullName(auth()->user()->id) }}</h4>
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
<div class="row">
  <div class="col-lg-12">
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>Orders</h5>
              <div class="pull-right">
                  <div class="btn-group">
                      <button type="button" class="btn btn-xs btn-white active">Today</button>
                      <button type="button" class="btn btn-xs btn-white">Monthly</button>
                      <button type="button" class="btn btn-xs btn-white">Annual</button>
                  </div>
              </div>
          </div>
          <div class="ibox-content">
            <div class="row">
            <div class="col-lg-9">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                </div>
            </div>
            <div class="col-lg-3">
              <ul class="stat-list">
                <li>
                    <h2 class="no-margins">2,346</h2>
                    <small>Total orders in period</small>
                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                    <div class="progress progress-mini">
                        <div style="width: 48%;" class="progress-bar"></div>
                    </div>
                </li>
                <li>
                    <h2 class="no-margins ">4,422</h2>
                    <small>Orders in last month</small>
                    <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                    <div class="progress progress-mini">
                        <div style="width: 60%;" class="progress-bar"></div>
                    </div>
                </li>
                <li>
                    <h2 class="no-margins ">9,180</h2>
                    <small>Monthly income from orders</small>
                    <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                    <div class="progress progress-mini">
                        <div style="width: 22%;" class="progress-bar"></div>
                    </div>
                </li>
                </ul>
             </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <div class="pull-right">
              <div class="btn-group">
                  <button type="button" class="btn btn-xs btn-white active">Today</button>
                  <button type="button" class="btn btn-xs btn-white">Monthly</button>
                  <button type="button" class="btn btn-xs btn-white">Annual</button>
              </div>
          </div>
          <h5>News</h5>
      </div>
      <div class="ibox-content">
          <div class="feed-activity-list" id="newsapi">

          </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection



@section("scripts")
<script>
  function newsapi(country = 'ph', apikey = '700c63acbba14b8ba8b9744c4a7c8d99') {

    fetch (`https://newsapi.org/v2/top-headlines?country=${country}&apiKey=${apikey}`).then(rep => rep.json()).then(json => {

      console.log(json);
      var newsfeed = document.querySelector("#newsapi");

      json.articles.forEach(news => {
        console.log(news);

        var div = document.createElement("div");

        div.setAttribute("id", news.source.name);

        div.innerHTML = `

          <img src="${news.urlToImage}" onerror="
              document.getElementById('${news.source.name}').style.display = 'none';
          " width=300>

        `;

        newsfeed.appendChild(div);
      });


    });

  }
  newsapi();

</script>
@endsection

  




