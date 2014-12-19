'use strict';

var config = require('./');

module.exports = function(socketio){
	socketio.on('connection', function(socket){
		/** @type {String} the reference address for the handshake */
		socket.address = socket.handshake.address
				? socket.handshake.address.address + ':' + socket.handshake.address.port
				: process.env.DOMAIN;
		/** @type {Date} the time of connection for the socket */
		socket.connectedAt = new Date();
		console.log('Socket<%s> CONNECT', socket.address);

		/** Attach the events for the sockets */
		require('../sockets')(socket);

		socket.on('info', function(data){
			console.log('Socket<%s> %s', socket.address, JSON.stringify(data, null, 2));
		});

		socket.on('error',function(err){
			console.error('SocketError<%s> %s', socket.address, err.stack || err);
		});

		socket.on('disconnect', function(){
			console.log('Socket<%s> DISCONNECT', socket.address);
		});
	});
};
