'use strict';

////////////////////////////////////////
// Development specific configuration //
////////////////////////////////////////
module.exports = {
	/** @type {Object} mongodb connection arguments */
	mongodb: {
		uri: 'mongodb://localhost/modularapi-dev'
	},

	/** @type {Boolean} seed the database on start */
	seedDB: true
};
