@extends('layouts.master')

@section('title', 'Dashboard')

@section("styles")
  {!! Html::style("css/plugins/slick/slick.css") !!}
  {!! Html::style("css/plugins/slick/slick-theme.css") !!}

  <style>
    .slick-slide {
      outline: none;
    }

    .slick-slide {
      -webkit-font-smoothing: antialiased;
      -webkit-user-select: text;
      -khtml-user-select: text;
      -moz-user-select: text;
      -ms-user-select: text;
      user-select: text;
    }

    .slick-list.draggable {
      -webkit-font-smoothing: antialiased;
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

  </style>

@endsection

@php
  use Carbon\Carbon;
@endphp

@section('content')
  @include("dashboard1")
@endsection

@section("scripts")
{!! Html::script("js/plugins/chartJs/Chart.min.js") !!}
{!! Html::script("js/plugins/slick/slick.min.js") !!}
<script>

  $(document).ready(function() {

    @can ("employee_View")
    @can ("position_View")
    var ctx = document.querySelector('canvas#chart-area').getContext("2d");
    var positions = [], employeeCount = [], backgroundColors = [];

    function rand() {
      return Math.floor(Math.random()*1000%255);
    }

    @foreach (App\Positions::all() as $position)

      positions[positions.length] = "{{ $position->title }}";
      employeeCount[employeeCount.length] = {!! $position->count() !!};

      backgroundColors[backgroundColors.length] = `rgba(${rand()}, ${rand()}, ${rand()}, .4)`;

    @endforeach


    var conf = {
      type: "line",
      data: {
        datasets: [{
          backgroundColor: `rgba(${rand()}, ${rand()}, ${rand()}, .4)`,
          data: employeeCount,
          label: 'Total Employees',
        }],
        labels: positions,
        options: {
          responsive: true,
        },
      },

    };

    window.employeeChart_1 = new Chart(ctx, conf);

    @php

      $active = 0;
      $inactive = 0;

      foreach (App\Employee::all() as $employee) {

        if (App\User::online($employee->user->user)) ++$active;
        else ++$inactive;

      }

      $totalEmployees = $active + $inactive;

    @endphp

    var ctx2 = document.querySelector("canvas#chart-area-total-employees").getContext("2d");

    var conf_2 = {
      type: "doughnut",
      data: {
        labels: ["Active Employees", "Inactive Employees"],
        datasets: [{
          data: [{!! $active !!}, {!! $inactive !!}],
          backgroundColor: ["rgba(0, 255, 0, .5)", "rgba(255, 0, 0, .5)"],
        }],
        options: {
          responsive: true,
        },
      }


    };

    window.employeeChart_2 = new Chart(ctx2, conf_2);

    @endcan
    @endcan

    @can("company_View")

    @php

      $companies = [];

      foreach (App\Company::all() as $company) {

        $companies[$company->name] = [];

        foreach ($company->departments as $dep) {
          $companies[$company->name][$dep->name] = $dep->count();
        }

      }


    @endphp

    var companyStats_slider = `
      @foreach ($companies as $company => $details)
        <div name="{{ str_replace('.', '', str_replace(' ', '', $company)) }}">
          <label>{{ $company }}</label>
          <canvas></canvas>
          <img src="..." style="display: none;" onerror='

            var ctx{!! str_replace('.', '', str_replace(' ', '', $company)) !!} = document.querySelector("div[name={{ str_replace('.', '', str_replace(' ', '', $company)) }}] canvas").getContext("2d");

            var conf{!! str_replace('.', '', str_replace(' ', '', $company)) !!} = {
              type: "bar",
              data: {
                labels: [@foreach ($details as $dep => $total_em) "{{ $dep }}", @endforeach],
                datasets: [{
                  data: [@foreach ($details as $dep => $total_em) {{ $total_em }}, @endforeach],
                  label: "Total Employees",
                  backgroundColor: "rgba(${rand()}, ${rand()}, ${rand()}, .5)",
                }],
              },
              options: {
                responsive: true,
              },
            };

            window.company{!! str_replace('.', '', str_replace(' ', '', $company)) !!} = new Chart(ctx{!! str_replace('.', '', str_replace(' ', '', $company)) !!}, conf{!! str_replace('.', '', str_replace(' ', '', $company)) !!});
          '>
        </div>
      @endforeach
    `;

    document.querySelector("div#companyStats").innerHTML = companyStats_slider;


    @endcan

    @if (auth()->user()->employee)
    @if (auth()->user()->employee->rates)

      var ctx_rates = document.querySelector("canvas#chart-area-rates").getContext("2d");

      var conf_rates = {
        type: "bar",
        data: {
          labels: ["Hourly", "Holiday", "Overtime", "Nightdiff."],
          datasets: [{
            data: [{!! auth()->user()->employee->rates->hourly !!},
                   {!! auth()->user()->employee->rates->holiday !!},
                   {!! auth()->user()->employee->rates->overtime !!},
                   {!! auth()->user()->employee->rates->nightdiff !!}],
            backgroundColor: (function () {

              var rand = function() {
                return Math.floor(Math.random()*1000%255);
              }

              var colors = [];

              for (var i = 0; i < 4; ++i) colors[colors.length] = 
                `rgba(${rand()}, ${rand()}, ${rand()}, .5)`;

              return colors;
            })(),
            label: ["Rates"],
          }],
          options: {
            responsive: true,
          },
        }
      };

      window.employeeRates = new Chart(ctx_rates, conf_rates);


    @endif

    @if (auth()->user()->employee->deductions)

      var ctx_deductions = document.querySelector("canvas#chart-area-deductions").getContext("2d");

      var deductions = {!! auth()->user()->employee->deductions->deductions !!};
      deductions = deductions.statutory;

      var conf_deductions = {
        type: "bar",
        data: {
        labels: (function () {

          var labels = Object.keys(deductions);

          labels[labels.length] = "Late";
          labels[labels.length] = "Undertime";

          return labels;
        })(),
        datasets: [{
          data: (function () {

            var datas = Object.values(deductions);

            datas[datas.length] = {!! auth()->user()->employee->deductions->late !!};
            datas[datas.length] = {!! auth()->user()->employee->deductions->undertime !!};

            return datas;
          })(),
          label: "Deductions",
        }],
        },

        options: {
          responsive: true,
        }

      };

      window.employeeDeductions = new Chart(ctx_deductions, conf_deductions);
    @endif

    @if (auth()->user()->employee->earnings)

      var ctx_earnings = document.querySelector("canvas#chart-area-earnings").getContext("2d");

      var earnings = {!! auth()->user()->employee->earnings->earnings !!};

      var conf_earnings = {
        type: "bar",
        data: {
          labels: Object.keys(earnings),
          datasets: [{
            data: Object.values(earnings),
            backgroundColor: (function () {

              var rand = function() {
                return Math.floor(Math.random()*1000%255);
              }

              var colors = [];

              for (var i = 0; i < Object.keys(earnings).length; ++i) colors[colors.length] = 
                `rgba(${rand()}, ${rand()}, ${rand()}, .5)`;

              return colors;
            })(),
            label: "Earning",
          }],
        },
        options: {
          responsive: true,
        }

      };

      window.employeeEarnings = new Chart(ctx_earnings, conf_earnings);
    @endif
    @endif


    newsapi();
  });

  
  
</script>

@include("js/newsapi")
@endsection

  




