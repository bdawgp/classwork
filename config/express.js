'use strict';

var compression = require('compression'),
		cookieParser = require('cookie-parser'),
    cors = require('cors'),
		express = require('express'),
		methodOverride = require('method-override'),
		morgan = require('morgan'),
		path = require('path'),
		passport = require('passport'),
		skipper = require('skipper');

var config = require('./');

module.exports = function(app){
  app.set('view engine', 'ejs');

	////////////////////
	// CORS Handling //
	////////////////////
	app.use(cors(config.cors));

	////////////////////////
	// Post body parsers //
	////////////////////////
	app.use(cookieParser());
  app.use(skipper());
	app.use(methodOverride('_method', {
    methods: ['GET', 'POST']
  }));

	////////////////////
	// User sessions //
	////////////////////
	app.use(passport.initialize());

	//////////////////////
	// Output handling //
	//////////////////////
	app.use(compression());
	if(app.get('env') === 'development'){
		app.use(morgan('dev'));
		app.use('/assets', express.static(path.join(config.root,'.tmp')));
	}else if(app.get('env') === 'production'){
		app.use(morgan('combined'));
	}
};
