<div class="modal-header center-align">
   	<h4>Add Contact</h4>
</div>
<div class="modal-content">
	<form class="col s12" method="post" action="{{ route('contact.store') }}" id="addForm">
		@csrf
		<div class="row">
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">account_circle</i>
		        <input placeholder="Name" name="name" id="name" type="text" class="validate">
		        <label for="name">Name</label>
		    </div>
		    <div class="input-field col s6">
		    	<i class="material-icons prefix">phone_android</i>
		        <input placeholder="081212408246 or +6281212408246" name="number" id="number" type="text" class="validate">
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
			    <input placeholder="yyyy/mm/dd" name="birthday" id="birthday" type="text" class="datepicker" data-rule-dateWithMoment="true">
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
			<a href="#" type="button" class="btn waves-effect waves-light modal-close"><i class="material-icons left">keyboard_return</i>Cancel</a>
			<button type="submit" class="btn waves-effect waves-light">Create<i class="material-icons right">send</i></button>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(function() {
		$.validator.addMethod(
	        "regex",
	        function(value, element, regexp) {
	            var re = new RegExp(regexp);
	            return this.optional(element) || re.test(value);
	        }
		);

	    $("#addForm").validate({
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

	});
</script>