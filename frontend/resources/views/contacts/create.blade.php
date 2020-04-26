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