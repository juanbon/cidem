@extends('backpack::layout')

@section('header')
	<section class="content-header">
	  <h1>
        <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
        <small>{{ trans('backpack::crud.edit').' '.$crud->entity_name }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'),'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.edit') }}</li>
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
		  		action="{{ url($crud->route.'/'.$entry->getKey()) }}"
				@if ($crud->hasUploadFields('update', $entry->getKey()))
				enctype="multipart/form-data"
				@endif
		  		>
		  {!! csrf_field() !!}
		  {!! method_field('PUT') !!}
		  <div class="box">
		    <div class="box-header with-border">
		    	@if ($crud->model->translationEnabled())
			    	<!-- Single button -->
					<div class="btn-group pull-right">
					  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
						  	<li><a href="{{ url($crud->route.'/'.$entry->getKey().'/edit') }}?locale={{ $key }}">{{ $locale }}</a></li>
					  	@endforeach
					  </ul>
					</div>
					<h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.edit') }}</h3>
				@else
					<h3 class="box-title">{{ trans('backpack::crud.edit') }}</h3>
				@endif
		    </div>
		    <div class="box-body row display-flex-wrap" style="display: flex;flex-wrap: wrap;">
		      <!-- load the view from the application if it exists, otherwise load the one in the package -->
		      @if(view()->exists('vendor.backpack.crud.form_content'))
		      	@include('vendor.backpack.crud.form_content', ['fields' => $fields, 'action' => 'edit'])
		      @else
		      	@include('crud::form_content', ['fields' => $fields, 'action' => 'edit'])
		      @endif
		    </div><!-- /.box-body -->

            <div class="box-footer">

                @include('crud::inc.form_save_buttons')

		    </div><!-- /.box-footer-->
		  </div><!-- /.box -->
		  </form>
	</div>
</div>
<?php  if(\Request::route()->getName() == "crud.user.edit"){ ?>
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





    var request = $.ajax({
      data: { id: $("input[name='id']").val() },
      url: '{{ URL::to('/') }}/admin/ajax/getRecipients',
      method: "GET",
      dataType: "json"
    });
     
    request.done(function( obj ) {


    	// console.log(obj.permisos);


		if(obj.status == "ok"){


		if(obj.permisos){
		

			$('input[name="temporal"]').val(JSON.stringify(obj.permisos));	

			formateado2 = [];

			$.each(obj.permisos,function(g,h){

				formateado2.push(h.recipient_id);

			});

			$('input[name="itemselected"]').val(JSON.stringify(formateado2));	

		}	


		$('input[name="valuejson"]').val(JSON.stringify(obj.data));	


		arrayIn = "";

		$.each(obj.data,function(a,b){


			lista = "";

			$.each(obj.permisos,function(d,e){


				if(a==e.recipient_id)
					lista = " selected ";

			});





		arrayIn += '<option '+lista+' value="'+a+'" >'+b+'</option>';

		});


		$(".checklist_dependency").append('<div class="row" style="margin-top: 12px;"> <div class="col-xs-12"> <label>Permiso sobre destinatarios</label> </div><div class="hidden_fields_secondary" data-name="permissions"> </div><div class="col-xs-12"><select onclick="AcadePermi(this)" class="selectorPermi" multiple="" name="selectorPermi" style="    width: 100%;margin-top: 10px;min-height: 132px;" class="form-control select2_from_array destinatary">'+arrayIn+'</select></div><div class="col-xs-12" style="margin-top: 10px;"><span style="font-weigth:bold !important;display:none"  class="templatelimpio"><b>Marcar sobre cual se podra editar, eliminar. (CRUD) </b></span><br><ul class="selectedRec" style="margin-left: -16px;margin-top: 5px;"></ul></div></div>');

		}


});



setTimeout(function(){ 


	if($('input[name="itemselected"]').val()!=""){


			$(".templatelimpio").show();

			formateado = [];
			opciones3= JSON.parse($('input[name="temporal"]').val());	
			todesJson = JSON.parse($('input[name="valuejson"]').val());

			$.each(opciones3,function(g,h){

				formateado.push(h.recipient_id);

			});


			$.each(formateado,function(c,d){

			//	 if(!$('.item_'+c).length ){


			checked ="";

			//  Otro campo temporal 

			hhh = JSON.parse($('input[name="temporal"]').val());


			$.each(hhh,function(m,n){


				if(d==n.recipient_id){

					// console.log(n);

						if($.trim(n.actions)==1){
			

							checked = " checked ";
			
						}


					}


			});


					$(".selectedRec").append("<li data-number='"+c+"' class='item_"+c+" filtroscon'>"+todesJson[d]+"<input  "+checked+"  onclick='setCh(this)' class='checkers miniche_"+d+"' data-estachk='"+d+"' style='margin-left:20px' type='checkbox'></li>");
		//		}

			});


	}


 }, 1000);



});



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


console.log("tu vieja "+$(e).val());


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
		$('input[name="itemselected"]').val("");

	}

}

</script>
<?php }  ?>
@endsection
