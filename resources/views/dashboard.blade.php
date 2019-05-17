@extends('layouts.master')

@section('title', 'Dashboard')

@section("styles")
  {!! Html::style("css/plugins/slick/slick.css") !!}
  {!! Html::style("css/plugins/slick/slick-theme.css") !!}
@endsection

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
  <div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <div class="pull-right">
              <div class="btn-group">
                  <button type="button" class="btn btn-xs btn-white active">Headlines</button>
                  <button type="button" class="btn btn-xs btn-white">Monthly</button>
                  <button type="button" class="btn btn-xs btn-white">Annual</button>
              </div>
          </div>
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
</div>
</div>
@endsection

@section("scripts")
{!! Html::script("js/plugins/slick/slick.min.js") !!}
<script>
  function newsapi(country = 'ph', apikey = '700c63acbba14b8ba8b9744c4a7c8d99') {

    var newsapiDetails = document.querySelector(".newsapi-details");

    fetch (`https://newsapi.org/v2/top-headlines?country=${country}&apiKey=${apikey}`).then(rep => rep.json()).then(json => {

      console.log(json);
      var newsfeed = document.querySelector("#newsapi");

      newsfeed.innerHTML = "";

      json.articles.forEach(news => {
        if (news.urlToImage == null) return;
        console.log(news);

        var div = document.createElement("div");

        div.setAttribute("id", news.source.name);

        news.publishedAt = new Date(news.publishedAt);
        today = new Date();

        var pub = ((today - news.publishedAt)/1e3/3600).toFixed(0) + ` hour${((today - news.publishedAt)/1e3/3600).toFixed(0) >= 1?'s':''} ago`;

        div.innerHTML = `
            <div class="col-lg-4 col-sm-4 col-xs-5">
              <img src="${news.urlToImage}" class="img-responsive" height=470 style="margin: auto; height: 150px; padding-top: 10px; padding-bottom: 10px ">
            </div>
            <div class="col-lg-8 no-padding">
              <h3><a href="${news.url}" class="no-padding">${news.title}</a><br><small class="text-muted no-padding">${pub}</small></h3>
              <label>Description</label>
              <p>${news.content || news.description}</p>
            </div>
          </div>
        `;

        newsfeed.appendChild(div);
      });

      $("#newsapi").on("init", function(event, slick) {
        newsapiDetails.innerHTML = `
          Source: <label><a href="http://${document.querySelector('.slick-current')}">${document.querySelector('.slick-current').id}</a></label>
          <span class="pull-right"><i class="fas fa-rss-square"></i> NewsAPI</span>
        `;
      });

      $("#newsapi").slick({
        autoplay: true,
      });

      $("#newsapi").on("afterChange", function(event, slick) {
        newsapiDetails.innerHTML = `
          Source: <label><a href="http://${document.querySelector('.slick-current').id}">${document.querySelector('.slick-current').id}</a></label>
          <span class="pull-right"><i class="fas fa-rss-square"></i> NewsAPI</span>
        `;
      });
    });

  }


  $(document).ready(function() {
    
  });
  
  newsapi();
</script>
@endsection

  




