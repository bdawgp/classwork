'use strict';

var express = require('express'),
		fs = require('fs'),
		http = require('http'),
		https = require('https'),
		mongoose = require('mongoose'),
		socketio = require('socket.io');

var config = require('./config');

/////////////////////////
// Database Connection //
/////////////////////////
mongoose.connect(config.mongodb.uri, config.mongodb.options);

/////////////////////////////////
// Application Initialization  //
/////////////////////////////////
var app = express();
require('./config/express')(app);
require('./routes')(app);
if(config.seedDB) require('./seeds');

/////////////////////////////////
// HTTP Server Initialization  //
/////////////////////////////////
require('./config/server/http')(app);

/////////////////////////////////
// HTTPS Server Initialization //
/////////////////////////////////
if(config.https.enabled) require('./config/server/https')(app);

/** @type {ExpressApplication} expose the express app */
module.exports = app;
