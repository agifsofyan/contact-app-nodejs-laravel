var mysql = require('mysql');

var connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "25fba6a1",
  database: "challenge"
});

connection.connect(function (err){
    if(err) throw err;
});

module.exports = connection;