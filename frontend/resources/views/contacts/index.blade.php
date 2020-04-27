@extends('template')

@section('title', 'Home Page')

@section('content')

<div class="row valign-wrapper">
	<div class="col s10"><h2>Contacts</h2></div>
	<div class="col s2" style="margin-bottom: -40px">
		<div class="row">
			<div class="col s7 right-align">
				<a href="#add" class="modal-trigger btn-floating btn-large waves-effect waves-light pulse tooltipped" data-position="left" data-tooltip="Add new contact">
					<i class="large material-icons">person_add</i>
				</a>
			</div>
			<div class="col s5 left-align">
				<button id="removeButton" type="submit" class="modal-trigger btn-floating btn-large waves-effect waves-light tooltipped" data-position="left" data-tooltip="Delete the selected">
					<i class="large material-icons">delete_forever</i>
				</button>
			</div>
		</div>
	</div>
</div>

 <nav>
    <div class="teal  lighten-1" style="padding-left: 10px;">
        <span class="breadcrumb">total contact</span>
        <span class="breadcrumb">{{ count($data) }}</span>
    </div>
  </nav>

<div id="add" class="modal full">
	@include('contacts.create')
</div>

<hr>

<ul class="collection">
	@foreach($data as $res)
	<li class="collection-item modal-trigger" onclick="$('#detail-{{ $res->id }}').modal('open')">
		<div class="row valign-wrapper">
		    <div class="col s5 left-align" style="margin-top: 10px !important">
		    	<div class="row" style="margin-bottom: 0 !important;">
		    		<div class="col s4" style="margin-top: 10px !important;"><i class="z-depth-1 large material-icons">assignment_ind</i></div>
		    		<h3 class="col">{{ $res->name }}</h3>
		    	</div>
		    </div>
		    <div class="col s5 left-align">
		    	<h5>{{ $res->number }}</h5>
		    </div>
		    <div class="col s2 right-align">

		    	<div class="row">
		    		<div class="col s9">
		    			<a class='dropdown-trigger btn-floating btn-large waves-effect waves-light' href='#' data-target='dropdown-{{ $res->id }}'><i class="medium material-icons">more_vert</i></a>

						<ul id='dropdown-{{ $res->id }}' class='dropdown-content'>
						    <li><a class="modal-trigger" href="#edit-{{ $res->id }}"><i class="material-icons">edit</i>Edit</a></li>
						    <li><a href="#remove-{{ $res->id }}" class="modal-trigger"><i class="material-icons">remove_circle</i>Remove</a></li>
						</ul>

		    		</div>
		    		<div class="col s3" style="margin-top: 20px">
		    			<label>
					        <input name="id[]" value="{{ $res->id }}" type="checkbox" class="filled-in checkId" />
					        <span style="padding: 5px; margin:0"></span>
					    </label>
		    		</div>
		    	</div>

		    </div>
		 </div>
    </li>

    {{-- Start Modal Edit --}}
	<div id="edit-{{ $res->id }}" class="modal full">
		@include('contacts.edit')
	</div>
    {{-- End MOdal Edit --}}

    <div id="remove-{{ $res->id }}" class="modal confirm transparent">
	    <div class="modal-content">
	      	
	      	<h4 class="center-align red-text">Remove This ?</h4>

			<form class="center-align" method="post" action="{{ route('contact.delete', $res->id) }}">
				@csrf
                @method('DELETE')
				<a href="#" type="button" class="btn waves-effect waves-light modal-close">
					<i class="material-icons left">keyboard_return</i>Cancel
				</a>
				
				<button type="submit" class="btn waves-effect waves-light">Remove
					<i class="material-icons right">delete</i>
				</button>
			</form>

	    </div>
	</div>

	<div id="detail-{{ $res->id }}" class="modal">
	    @include('contacts.detail')
	</div>

	@endforeach
</ul>

<script type="text/javascript">
	$(document).ready(function(){
		$("#removeButton").click(function(e) {
		    e.preventDefault();
		    var url = "/";

		    var myCheckboxes = new Array();
	        $(".checkId:checked").each(function() {
	           myCheckboxes.push($(this).val());
	        });

		    $.ajax({
		        url: url,
		        type: "DELETE",
		        data: {
		        	"_token": "{{ csrf_token() }}",
		        	id:myCheckboxes
		        }
		    }).always(function() {
		    	location.reload();
			});
		});
	});
</script>

@endsection