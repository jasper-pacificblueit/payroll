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


    window.employeeChart = new Chart(ctx, conf);
    @endcan
    @endcan



    newsapi();
  });

  
  
</script>

@include("js/newsapi")
@endsection

  




