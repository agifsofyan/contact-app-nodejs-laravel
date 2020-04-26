const express 	 = require("express");
const bodyParser = require("body-parser");
const app 		 = express();

// parse requests of content-type: application/json
app.use(bodyParser.json());

// parse requests of content-type: application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));

// simple route
app.get("/", (req, res) => {
  res.json({ message: "Welcome Contact Challenge API" });
});

require("./routes/contact.routes.js")(app);
// set port, listen for requests
app.listen(3000, () => {
  console.log("Server is running on port 3000.");
});

// var express = require('express'),
//     app = express(),
//     port = process.env.PORT || 3000,
//     bodyParser = require('body-parser'),
//     controller = require('./controller');

// app.use(bodyParser.urlencoded({ extended: true }));
// app.use(bodyParser.json());

// var routes = require('./routes');
// routes(app);

// app.listen(port);
// console.log('Learn Node JS With Kiddy, RESTful API server started on: ' + port);