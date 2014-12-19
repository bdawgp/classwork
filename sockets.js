'use script';

module.exports = function(socket){
	/////////////////////////////
	// Register socket events //
	/////////////////////////////
	require('./api/thing/thing.socket')(socket);
};
