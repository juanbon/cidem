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


	$('<input>').attr({
	    type: 'hidden',
	    id: 'valuejson',
	    class: 'valuejson',
	    name: 'valuejson'
	}).appendTo('body');


    var request = $.ajax({
      url: '{{ URL::to('/') }}/admin/ajax/getRecipients',
      method: "GET",
      dataType: "json"
    });
     
    request.done(function( obj ) {


		if(obj.status == "ok"){

		$(".valuejson").val(JSON.stringify(obj.data));	


		arrayIn = "";

		$.each(obj.data,function(a,b){

		arrayIn += '<option value="'+a+'" >'+b+'</option>';

		});

		$(".checklist_dependency").append('<div class="row" style="margin-top: 12px;"> <div class="col-xs-12"> <label>Permiso sobre destinatarios</label> </div><div class="hidden_fields_secondary" data-name="permissions"> </div><div class="col-xs-12"><select onclick="AcadePermi(this)" class="selectorPermi" multiple="" name="status" style="    width: 100%;margin-top: 10px;min-height: 132px;" class="form-control select2_from_array destinatary">'+arrayIn+'</select></div><div class="col-xs-12" style="margin-top: 10px;"><ul class="selectedRec" style="margin-left: -16px;margin-top: 5px;"></ul></div></div>');


		}


});

/*

<div class="col-sm-4"> <div class="checkbox"> <label> <input type="checkbox" class="secondary_list" data-id="1" label="Permiso" name="permissions_show[]" entity="permissions" entity_primary="roles" attribute="name" model="Backpack\PermissionManager\app\Models\Permission" pivot="1" number_columns="3" value="1">activar acciones (CRUD)</label> </div></div>

*/

console.log("una prueba ddasda dasdasdas dfasjfasdkfjsafsdf ");


});


function AcadePermi(e){



todesJson = JSON.parse($(".valuejson").val());


	// $(".selectedRec").html("");


	console.log($(e).val());


 if($(e).val()){


			if($(e).val().legth != 0){
				
				opciones = $(e).val();


				$.each($(".filtroscon"),function(e,f){

					if(opciones.includes($(this).data('number'))){

					}else{

						$(this).remove();
					}


				});



				$.each(opciones,function(c,d){

					 if(!$('.item_'+c).length ){

						$(".selectedRec").append("<li data-number='"+c+"' class='item_"+c+" filtroscon'>"+todesJson[d]+"<input style='margin-left:20px' type='checkbox'> Crud "+Date.now()+"</li>");

					}

				});

			}


	}else{

		$(".selectedRec").html("");

	}

}

</script>
<?php }  ?>
@endsection
