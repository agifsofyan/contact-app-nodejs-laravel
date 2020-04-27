const Contact = require("../models/contact.model.js");

const serverErrorCode 	  = 500;
const insertCode		  = 201;
const successCode		  = 200;
const notFoundCode		  = 404;
const validationFailCode  = 400;

const serverErrorMsg 	= 'Internal Server Error';
const insertMsg		  	= 'Insert Success';
const successMsg		= 'Execute Data Success';
const notFoundMsg		= 'Not Found';
const validationFailMsg	= 'Validation Fail';

const phoneValidation = /^(^\+62\s?|^0)(\d{3,4}?){2}\d{3,4}$/;
const dateValidation  = /^\d{4}(\/)([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))$/;

// Create and Save a new Contact
exports.create = (req, res) => {
	let body = req.body
	// Validate request
	 
	if (!body.name) {
		res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "name can not be empty!"
	    });
	}

	if (!body.number) {
		res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "number can not be empty!"
	    });
	}


	if (! req.body.number.match(phoneValidation)) {
	    res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "Number not valid!, ex: 081212408246 or +6281212408246"
	    });
	}

	if (body.birthday && ! req.body.birthday.match(dateValidation)) {
	    res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "Birthday not valid!, ex: 1995/01/31"
	    });
	}

	// // Check Phone Number
	Contact.findByNumber((req.body.number).replace("+62", 0), null, (err, data) => {
    	if (data.length > 0) {
			res.status(validationFailCode).send({
				code 	: validationFailCode,
		    	message	: "Phone number already exists"
		    });
		}else{
    		// Create a Contact
			const contact = new Contact({
			    name		: req.body.name,
			    number		: (req.body.number).replace("+62", 0),
			    address		: req.body.address,
			    birthplace	: req.body.birthplace,
			    birthday	: req.body.birthday,
			    info		: req.body.info
			});

			// Save Contact in the database
			Contact.create(contact, (err, data) => {
			    if (err){
					res.status(serverErrorCode).send({
						code 	: serverErrorCode,
				    	message: err.message || "Some error occurred while creating the Contact."
				    });
			    }else{
			    	res.status(insertCode).send({
			    		code 	: insertCode,
			    		message	: insertMsg,
			    		data 	: data
			    	});
			    }
			});
		}
  	});
};

// Retrieve all Contacts from the database.
exports.findAll = (req, res) => {
	Contact.getAll((err, data) => {
		if (err){
	    	res.status(serverErrorCode).send({
	    		code 	: validationFailCode,
	        	message: err.message || "Some error occurred while retrieving contacts."
	    	});
	    }else{
	    	res.status(successCode).send({
		    	code 	: successCode,
		    	message : successMsg,
		    	count 	: data.length,
		    	data 	: data
	    	});
	    }
	});
};

// Find a single Contact with a contactId
exports.findOne = (req, res) => {
	Contact.findById(req.params.contactId, (err, data) => {
    	if (err) {
      		if (err.kind === "not_found") {
        		res.status(notFoundCode).send({
			    	code 	: notFoundCode,
			    	message : `Contact with id ${req.params.contactId} ${notFoundMsg}`
		    	});
      		} else {
        		res.status(serverErrorCode).send({
			    	code 	: serverErrorCode,
			    	message : serverErrorMsg
		    	});
      		}
    	} else {
    		res.status(successCode).send({
		    	code 	: successCode,
		    	message : successMsg,
		    	data 	: data
	    	});
    	}
  	});
};

// Update a Contact identified by the contactId in the request
exports.update = (req, res) => {
	// Validate request
	if (! req.body) {
		res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "Content can not be empty!"
	    });
	}

	if (! req.body.number.match(phoneValidation)) {
	    res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "Number not valid!, ex: 081212408246 or +6281212408246"
	    });
	}

	if (! req.body.birthday.match(dateValidation)) {
	    res.status(validationFailCode).send({
			code 	: validationFailCode,
	    	message	: "Birthday not valid!, ex: 1995/01/31"
	    });
	}

	Contact.findByNumber((req.body.number).replace("+62", 0), req.params.contactId, (err, data) => {
		if (data.length > 0) {
			res.status(validationFailCode).send({
				code 	: validationFailCode,
		    	message	: "Phone number already exists"
		    });
		}else{
			Contact.updateById(
		    	req.params.contactId,
		    	new Contact(req.body),
		    	(err, data) => {
		      		if (err) {
		        		if (err.kind === "not_found") {
			        		res.status(notFoundCode).send({
						    	code 	: notFoundCode,
						    	message : `Contact with id ${req.params.contactId} ${notFoundMsg}`
					    	});
			      		} else {
			        		res.status(serverErrorCode).send({
						    	code 	: serverErrorCode,
						    	message : serverErrorMsg
					    	});
			      		}
		      		} else {
		      			res.status(insertCode).send({
				    		code 	: insertCode,
				    		message	: 'Update Success',
				    		data 	: data
				    	});
		      		}
		      	}
			);
		}
	});
};

// Delete a Contact with the specified contactId in the request
exports.delete = (req, res) => {
	// console.log('eq.params.contactId', req.params.contactId);
	Contact.remove(req.params.contactId, (err, data) => {
    	if (err) {
      		if (err.kind === "not_found") {
        		res.status(notFoundCode).send({
			    	code 	: notFoundCode,
			    	message : `Contact with id ${req.params.contactId} ${notFoundMsg}`
		    	});
      		} else {
        		res.status(serverErrorCode).send({
			    	code 	: serverErrorCode,
			    	message : serverErrorMsg
		    	});
      		}
    	} else {
    		res.status(successCode).send({
	    		code 	: successCode,
	    		message	: `Contacts was deleted successfully!!`
	    	});
    	}
    });
};

// Delete all Contacts from the database.
exports.deleteAll = (req, res) => {
	contactId = req.body;

	items = [];

	for (var i = 0; i < contactId.length; i++) {
		items = contactId
	}

	// console.log(items);

	Contact.removeAll(items, (err, data) => {
    	if (err){
    		res.status(serverErrorCode).send({
    			message: err.message || "Some error occurred while removing selected contacts."
    		});
	    }else {
	    	res.status(successCode).send({
	    		code 	: successCode,
	    		message	: `Selected Contacts was deleted successfully!!`
	    	});
    	}
    });
};