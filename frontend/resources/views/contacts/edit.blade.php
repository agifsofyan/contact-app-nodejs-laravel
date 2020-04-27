<div class="modal-header center-align">
   	<h4>Edit Contact</h4>
</div>

<div class="modal-content">
	<form id="editForm-{{ $res->id }}" class="col s12" method="POST" action="{{ route('contact.update', $res->id) }}">
		@csrf
        @method('PUT')
		<div class="row">
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">account_circle</i>
		        <input placeholder="Name" name="name" type="text" class="validate" value="{{ $res->name }}">
		        <label for="name">Name</label>
		    </div>
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">phone_android</i>
		        <input placeholder="081212408246 or +6281212408246" name="number" type="text" class="validate" value="{{ $res->number }}">
		        <label for="number">Number</label>
		    </div>
		</div>
		
		<div class="row">
		  	<div class="input-field col s12">
				<i class="material-icons prefix">home</i>
		        <textarea placeholder="Address" name="address" type="text" class="materialize-textarea">{{ $res->address }}</textarea>
		        <label for="address">Address</label>
		    </div>
		</div>
		
		<div class="row">
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">location_city</i>
		        <input placeholder="Birthplace" name="birthplace" type="text" class="validate" value="{{ $res->birthplace }}">
		        <label for="birthplace">Birthplace</label>
		    </div>
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">cake</i>
			    <input data-value="{{ Carbon\Carbon::parse($res->birthday)->format('Y/m/d') }}" value="{{ Carbon\Carbon::parse($res->birthday)->format('Y/m/d') }}" placeholder="yyyy/mm/dd" name="birthday" type="text" class="datepicker validate">
		        <label for="birthday">Birthday</label>
		    </div>
		</div>

		<div class="row">
		  	<div class="input-field col s12">
				<i class="material-icons prefix">info</i>
		        <textarea placeholder="Info" name="info" type="text" class="materialize-textarea">{{ $res->info }}</textarea>
		        <label for="info">Info</label>
		    </div>
		</div>

		<div class="center-align">
			<a href="#" type="button" class="btn waves-effect waves-light modal-close"><i class="material-icons left">keyboard_return</i>Cancel</a>
			<button type="submit" class="btn waves-effect waves-light">Update<i class="material-icons right">send</i></button>
		</div>
	</form>
</div>

<script type="text/javascript">
	$("#editForm-{{ $res->id }}").validate({
	    // wrapper: 'span',
	    errorElement : 'span',
        rules: {
            name: {
                required: true
            },
            number: {
                required: true,
                regex : /^(^\+62\s?|^0)(\d{3,4}?){2}\d{3,4}$/
            },
            birthday: {
                regex : /^\d{4}(\/)([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))$/
            }
        },
        messages: {
            name: {
                required: "name is required"
            },
            number: {
                required: "number is required",
                regex: "number not valid."
            },
            birthday: {
                regex: "birthday input not valid."
            }
        },
            
        highlight: function (element, error){
        	let inField = $(element).closest('.input-field');
            inField.find('input, textarea').removeClass('valid').addClass('invalid');

           	inField.find('i').addClass('red-text');
        },
            
        unhighlight: function (element, errorClass, validClass){
        	let inField = $(element).closest('.input-field');

            inField.find('input, textarea').removeClass('invalid').addClass('valid');

            inField.find('i').removeClass('red-text');
        }
    });
</script>