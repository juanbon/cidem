@extends('backpack::layout')
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
@section('header')
	<section class="content-header">
	  <h1>
	    <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
	    <small>{{ trans('backpack::crud.all') }} <span>{{ $crud->entity_name_plural }}</span> {{ trans('backpack::crud.in_the_database') }}.</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="{{ url(config('backpack.base.route_prefix'), 'dashboard') }}">{{ trans('backpack::crud.admin') }}</a></li>
	    <li><a href="{{ url($crud->route) }}" class="text-capitalize">{{ $crud->entity_name_plural }}</a></li>
	    <li class="active">{{ trans('backpack::crud.list') }}</li>
	  </ol>
	</section>
@endsection

@section('content')
<!-- Default box -->
  <div class="row">

    <!-- THE ACTUAL CONTENT -->
    <div class="col-md-12">
      <div class="box">
        <div class="box-header hidden-print {{ $crud->hasAccess('create')?'with-border':'' }}">

          @include('crud::inc.button_stack', ['stack' => 'top'])

          <div id="datatable_button_stack" class="pull-right text-right hidden-xs"></div>
        </div>

        <div class="box-body overflow-hidden">

        {{-- Backpack List Filters --}}
        @if ($crud->filtersEnabled())
          @include('crud::inc.filters_navbar')
        @endif



<div class="callout callout-success" style="font-size: 13.7px;height: 50px;background-color:#00B49A !important;display:none">
        <h4>La habilitaci&oacute;n del usuario se actualizo correctamente</h4>

    </div>

        <table id="crudTable" class="table table-striped table-hover display responsive nowrap" cellspacing="0">
            <thead>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th
                    data-orderable="{{ var_export($column['orderable'], true) }}"
                    data-priority="{{ $column['priority'] }}"
                    >
                    {{ $column['label'] }}
                  </th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th data-orderable="false" data-priority="{{ $crud->getActionsColumnPriority() }}">{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <tr>
                {{-- Table columns --}}
                @foreach ($crud->columns as $column)
                  <th>{{ $column['label'] }}</th>
                @endforeach

                @if ( $crud->buttons->where('stack', 'line')->count() )
                  <th>{{ trans('backpack::crud.actions') }}</th>
                @endif
              </tr>
            </tfoot>
          </table>

        </div><!-- /.box-body -->

        @include('crud::inc.button_stack', ['stack' => 'bottom'])

      </div><!-- /.box -->
    </div>

  </div>



  <?php /* echo  if(\Request::route()->getName() == "crud.user.index") */ ?>

@endsection

@section('after_styles')
  <!-- DATA TABLES -->
  <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap.min.css">

  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/form.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/list.css') }}">

  <!-- CRUD LIST CONTENT - crud_list_styles stack -->
  @stack('crud_list_styles')
@endsection

@section('after_scripts')
	@include('crud::inc.datatables_logic')

  <script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/form.js') }}"></script>
  <script src="{{ asset('vendor/backpack/crud/js/list.js') }}"></script>

  <!-- CRUD LIST CONTENT - crud_list_scripts stack -->
  @stack('crud_list_scripts')
@endsection

<?php 

if(\Request::route()->getName() == "crud.user.index"){ 

 $user = \Auth::user();

if(($user)AND(!$user->hasRole('admin') )){     ?>


<style>

.callout.callout-success {
    border-color: #009C86 !important;
}

td:nth-child(5){

  color:#FFFFFF;

}

td{

 background-color:#FFFFFF;
}


</style>
<script>

function verify(){

  setTimeout(function(){ 

  $(".btn-default").each(function( index, element ) {

  store = $(element).attr("href");

  upd =store.split("user/");

  if(upd){

      if(upd[1]){

          ra = upd[1];

          tt = ra.split("/edit");

           $(element).parent().prev().prev().prev().prev().addClass("allSelector selector_"+tt[0]);
           $(element).parent().prev().prev().prev().prev().attr("data-visor",tt[0]);


        }

      }

      });


        //  data: { profile_id :'profile_id');?>},

        var request = $.ajax({
          url: '{{ URL::to('/') }}/admin/ajax/getUser',
          method: "GET",
          dataType: "json"
        });
         
        request.done(function( obj ) {

            if(obj.status == "ok"){

              // console.log(obj);

              ee = obj.data;
              ff = obj.hability;

            //  console.log(ee);


              $.each(ee,function( index, element ) {

                $("tr td:nth-child(5)").css("color","#363636");

                // console.log(element.status);

                $.each($(".allSelector"),function(a,b){


                  visor = $(this).data("visor");

                  cc = "<select onchange='setStatus(this)' >";

                  $.each(ff,function(c,d){

                  //  console.log(ee.status+"assssssss");

                    gr = (ee[visor].status==c)?"selected":"";

                    cc +="<option "+gr+" value='"+c+"' >"+d+"</option>";

                  });


                  cc +="</select>"; 

                  $(this).html(cc);


                });


              });



            }


        });



    }, 1000);


}



function setStatus(data){



        $.ajax({

            data: { id_user :$(data).parent().data("visor"),status:$(data).val()},
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            dataType: 'json',
            url: '{{ URL::to('/') }}/admin/ajax/UpdateUser',
            type:'POST',
            success:  function (data) {


              if(data.success=="success"){

                $(".callout").slideDown();


                setTimeout(function(){  $(".callout").slideUp(); }, 5000);

              }

            }
        });

}


$(document).ready(function(){  


    verify();

    $('tr:first').on("click",function(){

    verify();


});





});

</script>


<?php }


} ?>

<style>
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
display: none !important;
}
table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child {
    position: relative;
    padding-left: 15px !important;
    cursor: pointer;
}
</style>
<script>
$(document).ready(function(){


/*

var table = $('table').DataTable();
 
table.on( 'search.dt', function () {
    
console.log("limpiado");

  $('td:first-child').on("click",function(event){
      event.stopPropagation();
      
  });

});

*/



/*

$('td:first-child').bind("click",function(event){
    event.stopPropagation();
    
});

*/


});
</script>  


