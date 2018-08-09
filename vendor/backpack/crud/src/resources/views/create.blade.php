@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
        <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
        <small>{{ trans('backpack::crud.add').' '.$crud->entity_name }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.add') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<!-- Default box -->
		@if ($crud->hasAccess('list'))
			<a href="{{ url($crud->route) }}" class="hidden-print"><i class="fa fa-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a><br><br>
		@endif

		@include('crud::inc.grouped_errors')

		  <form method="post"
		  		action="{{ url($crud->route) }}"
				@if ($crud->hasUploadFields('create'))
				enctype="multipart/form-data"
				@endif
		  		>
		  {!! csrf_field() !!}

		  <div class="box">
		    <div class="box-header with-border">
		      <h3 class="box-title">{{ trans('backpack::crud.add_a_new') }} {{ $crud->entity_name }}</h3>
		    </div>
		    <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
		      @else
		      	@include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ])
		      @endif
		    </div><!-- /.box-body -->
		    <div class="box-footer">

                @include('crud::inc.form_save_buttons')

		    </div><!-- /.box-footer-->

		  </div><!-- /.box -->
		  </form>
	</div>
</div>
<?php  if(\Request::route()->getName() == "crud.user.create"){ ?>
<style>

.checklist_dependency{

	margin-bottom: -12px;

}

</style>
<script>
$(document).ready(function(){

/*
	$('<input>').attr({
	    type: 'hidden',
	    id: 'valuejson',
	    class: 'valuejson',
	    name: 'valuejson'
	}).appendTo('body');


	$('<input>').attr({
	    type: 'hidden',
	    id: 'checkeados',
	    class: 'checkeados',
	    name: 'checkeados'
	}).appendTo('body');
*/

//  Aca se insertan los ajax 


$(".checklist_dependency").append('<div class="row ajax_dinamic" style="margin-top: 12px;"></div>');

/*

$('input[name="roles_show[]"]').on("click",function(){
	
	$(".selectorPermi").prop("disabled",false);
	
	if( ($(this).val()=="4")&&($(this).is(':checked') ) ){
	 
    generarrecipient(true);

	
	}else{
	
	$(".selectorPermi").parent().prev().prev().children().html("Permiso sobre destinatarios");

	$(".selectorPermi").prop("disabled",false);
	}
	
	});

*/



	// Solo se realiza un check 

	$("input:checkbox").on('click', function() {
	  // in the handler, 'this' refers to the box clicked on
	  var $box = $(this);
	  if ($box.is(":checked")) {
	    // the name of the box is retrieved using the .attr() method
	    // as it is assumed and expected to be immutable
	    var group = "input:checkbox[name='" + $box.attr("name") + "']";
	    // the checked state of the group/box on the other hand will change
	    // and the current value is retrieved using .prop() method
	    $(group).prop("checked", false);
	    $box.prop("checked", true);
	  } else {
	    $box.prop("checked", false);
	  }
	});


generarrecipient(false);



});



function generarrecipient(flag){



    var request = $.ajax({
      url: '{{ URL::to('/') }}/admin/ajax/getRecipients',
      method: "GET",
      dataType: "json"
    });
     
    request.done(function( obj ) {


		if(obj.status == "ok"){


		$('input[name="valuejson"]').val(JSON.stringify(obj.data));	


		arrayIn = "";

		$.each(obj.data,function(a,b){

		arrayIn += '<option value="'+a+'" >'+b+'</option>';

		});

		$(".ajax_dinamic").html('<div class="col-xs-12"> <label>Permiso sobre destinatarios</label> </div><div class="hidden_fields_secondary" data-name="permissions"> </div><div class="col-xs-12"><select onclick="AcadePermi(this)" class="selectorPermi" multiple="" name="selectorPermi" style="    width: 100%;margin-top: 10px;min-height: 132px;" class="form-control select2_from_array destinatary">'+arrayIn+'</select></div><div class="col-xs-12" style="margin-top: 10px;"><span style="font-weigth:bold !important;display:none"  class="templatelimpio"><b>Marcar sobre cual se podra editar, eliminar. (CRUD) </b></span><br><ul class="selectedRec" style="margin-left: -16px;margin-top: 5px;"></ul></div>');


		}


});


if(flag){


	setTimeout(function(){ 	$(".selectorPermi").prop("disabled",true); 

$(".selectorPermi").parent().prev().prev().children().append("<span style='font-weigth:400'> - (El rol 'Publico' no permite manejo de destinarios</span>)");

}, 600);



}




}


function setCh(p){


	var todesto = [];

	$.each($(".checkers"),function(g,h){

		if($(this).is(':checked')){

			todesto.push($(this).data("estachk"));

		}			

	});


	$('input[name="checkeados"]').val(JSON.stringify(todesto));

}



function AcadePermi(e){


todesJson = JSON.parse($('input[name="valuejson"]').val());


 if($(e).val()){


 			$(".templatelimpio").show();
 			$(".templatelimpio").css("font-weigth","bold");


			if($(e).val().legth != 0){
				
				opciones = $(e).val();

				$('input[name="itemselected"]').val(JSON.stringify(opciones));

				$.each($(".filtroscon"),function(e,f){

					if(opciones.includes($(this).data('number'))){

					}else{

						$(this).remove();
					}


				});



				$.each(opciones,function(c,d){

					 if(!$('.item_'+c).length ){

						$(".selectedRec").append("<li data-number='"+c+"' class='item_"+c+" filtroscon'>"+todesJson[d]+"<input onclick='setCh(this)' class='checkers miniche_"+d+"' data-estachk='"+d+"' style='margin-left:20px' type='checkbox'></li>");

					}

				});




// Si una opcion se deselecciono se quita del array d marcados 


if($('input[name="checkeados"]').val() !=""){


				pasada = JSON.parse($('input[name="checkeados"]').val());

				if(pasada.length > 0){

				var pasada = JSON.parse($('input[name="checkeados"]').val()); 

				var pasada2 = pasada;

				$.each(pasada,function(j,k){

					if(k){


						if(!opciones.includes(k.toString())){


								var index = pasada2.indexOf(parseInt(k));
								if (index > -1) {
								  pasada2.splice(index, 1);
								}

						}

					}


				});




$('input[name="checkeados"]').val(JSON.stringify(pasada2));


				if($('input[name="checkeados"]').val() != ""){


			var pasada = JSON.parse($('input[name="checkeados"]').val());

					$.each(pasada,function(h,i){

						$(".miniche_"+i).prop('checked', true);

					});

				}

}

}



			}

	}else{

		$(".templatelimpio").hide();
		$(".selectedRec").html("");
		$('input[name="checkeados"]').val("");

	}

}

</script>
<?php }elseif(\Request::route()->getName() == "crud.lines.create"){  ?>

<style>

</style>

<script>

$(document).ready(function(){



    var request = $.ajax({
      url: '{{ URL::to('/') }}/admin/ajax/getRecipientsbyUser',
      method: "GET",
      data: { id:{{ Auth::user()->id }} },
      dataType: "json"
    });
     
    request.done(function( obj ) {


		if(obj.status == "ok"){


		  if(obj.data){

				todes = "";

				$.each(obj.data,function(g,h){


				todes+= '<option class="fa_'+h.id+'" value="'+h.id+'">'+h.name+'</option>';	


				});

				console.log(todes);


			//	$('input[name="valuejson"]').val(JSON.stringify(obj.data));	


				men = $('.select2_multiple')[0]

				$(men).append(todes);

 		 }


		}


});





});


</script>	

<?php } ?>
@endsection
