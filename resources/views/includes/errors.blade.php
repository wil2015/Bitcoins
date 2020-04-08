@if(isset($errors))	

@if (count($errors))

  <div class="alert alert-danger">
	<ul>
	  @foreach ($errors as $error)

		<li>{{ $error }}</li>

	  @endforeach
	</ul>
  </div>

@endif
@else
	<div></div>
@endif