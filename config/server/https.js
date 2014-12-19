'use strict';

var async = require('async'),
		fs = require('fs'),
		https = require('https'),
		socketio = require('socket.io');

var config = require('../');

module.exports = function(app){
	/** Load SSL key and certificate */
	async.parallel({
		key: async.apply(fs.readFile, config.https.key),
		cert: async.apply(fs.readFile, config.https.certificate)
	}, function(err, credentials){
		if(err) return console.error('Error reading https private key or certificate', err);

		/** Initialize HTTPS server with SSL key and certificate */
		var server = https.createServer(credentials, app).listen(config.https.port, function(){
			console.log('Express app running on HTTPS port %d in %s mode', config.https.port, app.get('env'));
		});

		/** Attach socket.io */
		if(config.socketio.enabled){
			var socket = socketio(server, { serveClient: false });
			require('../socketio')(socket);
      console.log('Binding sockets to HTTPS server');
		}
	});
};
