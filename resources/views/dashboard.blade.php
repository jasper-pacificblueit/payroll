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
<span id="dashboard-slick">
  @include("dashboard1")
  @include("dashboard2")
</span>
@endsection

@section("scripts")
{!! Html::script("js/plugins/slick/slick.min.js") !!}
<script>

  $(document).ready(function() {
    newsapi();

    $("#dashboard-slick").slick({
      infinite: false,
      arrows: true,
      swipe: false, 
      draggable: true,
    });
  });
  
  
</script>

@include("js/newsapi")
@endsection

  




