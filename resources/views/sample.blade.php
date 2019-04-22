@extends('layouts.master')

@section('title', 'Company')

@section('content')

<input type="text" id="empID">

<button id="btn">view</button>

<div id="display"></div>

@endsection


@section('scripts')
<!-- Custom and plugin javascript -->
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}


 
<script>
$(document).ready(function() {

    $(document).on('click','#btn',function(){
        var id = $('#empID').val();
        var display = $('#display');
        $.get('get-employee',{
            id: id
        },function(data){
            console.log(data);
            display.empty().append('<h3>'+ data.get_profile.fname +' '+ data.get_profile.lname +'</h3>')
        })
    });

    


});
</script>

@endsection