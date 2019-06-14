@extends('layouts.master')

@section('title', 'Dashboard')

@section("styles")
  {!! Html::style("css/plugins/slick/slick.css") !!}
  {!! Html::style("css/plugins/slick/slick-theme.css") !!}

  <style>
    #dashboard-slick .slick-slide {
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

    // var conf = {
    //   type: "pie",
    //   data: {
    //     datasets: [{
    //       data: [
    //         10,
    //         45,
    //         64,
    //         34
    //       ],

    //       backgroundColor: [
          

    //       ]


    //     }],
    //     options: {
    //       responsive: true,
    //     }
    //   },

    // };

    // var ctx = document.querySelector('canvas#chart-area').getContext("2d");



    // window.employeeChart = new Chart(ctx, conf);



    newsapi();
  });

  
  
</script>

@include("js/newsapi")
@endsection

  




