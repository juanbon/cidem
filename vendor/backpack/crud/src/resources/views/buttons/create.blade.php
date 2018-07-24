@if ($crud->hasAccess('create'))
	<a href="{{ url($crud->route.'/create') }}" style="visibility:hidden" class="btn btn-primary ladda-button" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> {{ trans('backpack::crud.add') }} {{ $crud->entity_name }}</span></a>
@endif
<script>
	
	$(document).ready(function(){

		$(".ladda-button").css("visibility","visible");

	})
</script>	