'use strict';

var response = require('./respons');
var connection = require('./connection');

var app = module.exports = express.Router();

exports.contacts = function(req, res) {
    connection.query('SELECT * FROM contact', function (error, rows, fields){
        if(error){
            console.log(error)
        } else{
            response.ok(rows, res)
        }
    });
};

exports.index = function(req, res) {
    response.ok("Hello from the Node JS RESTful side!", res)
};

exports.create = function(req, res) {
	var name 		= req.name;
	var birthplace  = req.birthplace;
	var address 	= req.address;
	var info 		= req.info;

	connection.query("INSERT contact (`name`, `number`, `birthplace`, `address`, `info`) VALUES (?,?,?,?,?)", [name, number, birthplace, address, info], function (error, rows, fields){
        if(error){
            console.log(error)
        } else{
            response.ok(rows, res)
        }
    });
}