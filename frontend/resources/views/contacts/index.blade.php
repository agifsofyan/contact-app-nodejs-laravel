@extends('template')

@section('title', 'Home Page')

@section('content')

<style type="text/css">
	.full {
		width: 100%; 
		max-height: 100%; 
		margin: auto !important; 
		top: 0px !important;
		bottom: 0px !important;
		padding: 20px;
	}
</style>

@if ( Session::has('flash_message') )            
	<div class="alert {{ Session::get('flash_type') }}">
		<script>
			M.toast({html: '{{ Session::get('flash_message') }}', classes: 'rounded', displayLegth: 1000, timeRemaining: 2000})
		</script>
  		<h3></h3>
	</div>
@endif


<div class="row valign-wrapper">
	<div class="col s10"><h2>Contacts</h2></div>
	<div class="col s2" style="margin-bottom: -10px !important">
		<a href="#add" class="modal-trigger" style="color: black"><i class="large material-icons">person_add</i></a>
	</div>
</div>

{{-- <div id="add" class="modal full"> --}}
	{{-- @include('contacts.create') --}}
{{-- </div> --}}

<div class="modal-header center-align">
   	<h4>Add Contact</h4>
</div>
<div class="modal-content">
	<form class="col s12" method="post" action="{{ route('contact.store') }}">
		@csrf
		<div class="row">
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">account_circle</i>
		        <input placeholder="Name" name="name" id="name" type="text" class="validate">
		        <label for="name">Name</label>

		        @if($errors->has('name'))
				    <span class="helper-text" data-error="wrong" data-success="right">{{ $errors->first('name') }}</span>
				@endif
		    </div>
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">phone_android</i>
		        <input placeholder="Number" name="number" id="number" type="number" class="validate">
		        <label for="number">Number</label>
		    </div>
		</div>
		
		<div class="row">
		  	<div class="input-field col s12">
				<i class="material-icons prefix">home</i>
		        <textarea placeholder="Address" name="address" id="address" type="text" class="materialize-textarea"></textarea>
		        <label for="address">Address</label>
		    </div>
		</div>
		
		<div class="row">
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">location_city</i>
		        <input placeholder="Birthplace" name="birthplace" id="birthplace" type="text" class="validate">
		        <label for="birthplace">Birthplace</label>
		    </div>
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">cake</i>
			    <input placeholder="Birthday" name="birthday" id="birthday" type="text" class="validate">
		        <label for="birthday">Birthday</label>
		    </div>
		</div>

		<div class="row">
		  	<div class="input-field col s12">
				<i class="material-icons prefix">info</i>
		        <textarea placeholder="Info" name="info" id="info" type="text" class="materialize-textarea"></textarea>
		        <label for="info">Info</label>
		    </div>
		</div>

		<div class="center-align">
			<button type="submit" class="btn btn-primary">Create</button>
			<button class="btn btn-indigo modal-close">Cancel</button>
		</div>
	</form>
</div>

<hr>

<ul class="collection">
	@foreach($data as $res)
	<li class="collection-item">
		<div class="row valign-wrapper">
		    <div class="col s4 left-align" style="margin-top: 10px !important">
		    	<div class="row" style="margin-bottom: 0 !important;">
		    		<div class="col s4" style="margin-top: 10px !important;"><i class="z-depth-1 large material-icons">assignment_ind</i></div>
		    		<h3 class="col">{{ $res->name }}</h3>
		    	</div>
		    </div>
		    <div class="col s4 left-align">
		    	<ul>
		    		<li>{{ $res->number }}</li>
		        	<li>{{ $res->address }}</li>
		        	<li>{{ $res->birthplace }}</li>
		        	<li>{{ $res->birthday }}</li>
		        	<li>{{ $res->info }}</li>
		      	</ul>
		    </div>
		    <div class="col s4 right-align">
		    	<a class='dropdown-trigger btn-floating btn-large waves-effect waves-light' href='#' data-target='dropdown-{{ $res->id }}'><i class="medium material-icons">more_vert</i></a>

		    	<!-- Dropdown Structure -->
				<ul id='dropdown-{{ $res->id }}' class='dropdown-content'>
				    <li><a href="#edit-{{ $res->id }}" class="modal-trigger">Edit</a></li>
				    <li><a href="#remove-{{ $res->id }}" class="modal-trigger">Remove</a></li>
				</ul>
		    </div>
		 </div>
    </li>

    <!-- Modal Structure -->
	<div id="remove-{{ $res->id }}" class="modal">
	    <div class="modal-content">
	      <h4>Modal Header</h4>
	      <p>A bunch of text</p>
	    </div>
	    <div class="modal-footer">
	      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
	    </div>
	</div>

	<div id="edit-{{ $res->id }}" class="modal full">
		@include('contacts.edit')
	</div>
	@endforeach
</ul>

@endsection