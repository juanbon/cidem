@if ($crud->buttons->where('stack', $stack)->count())
	@foreach ($crud->buttons->where('stack', $stack) as $button)
	  @if ($button->type == 'model_function')
		@if ($stack == 'line')
	  		  {!! $entry->{$button->content}($entry); !!}
		@else
			  {!! $crud->model->{$button->content}($crud); !!}
		@endif
	  @else

	  <?php 

	   $user = \Auth::user();

	  if((\Request::route()->getName() == "crud.lines.search") && ($button->name=="preview") ){?>

		@include($button->content, ['button' => $button])
	  
	<?php }elseif(($button->name!="preview")){ 

		 if(($user->hasRole('admin'))||(($user->hasRole('user')))||(($user->hasRole('editor'))))  {
		?>	

		@include($button->content, ['button' => $button])

		<?php

		}
		 }?>
			  @endif
			@endforeach
		@endif
