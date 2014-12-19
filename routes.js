'use strict';

var HttpError = require('http-error').HttpError;

module.exports = function(app){
	/////////////////////////
	// Define routes here //
	/////////////////////////
	app.use('/things', require('./api/thing'));

	/////////////////////////
	// Application Routes //
	/////////////////////////
	app.get('/', function(req, res){
    res.redirect('/things');
	});

	//////////////////////////////
	// Application Error Catch //
	//////////////////////////////
	app.use(function(err, req, res, done){
		/** @type {HttpError} fallback to a 404 Not Found */
		if(!err) err = new HttpError('Path not found', 404);

    /** @type {String} Use ValidationError string helper or Error message */
    var message = (err.name === 'ValidationError') ? err.toString().replace(/^ValidationError: /,'') : err.message || err;

    if(err.code === 404) return res.redirect('/');

		/** Only log the stack trace if error status code is greater than 404 */
		if(err.code > 404 || err.message && !err.code) console.error(err.stack || err);
		res.status(err.code || 500).json({ error: message || 'An error occurred' });
	});
};
