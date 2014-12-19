'use strict';

///////////////////////////////////////
// Production specific configuration //
///////////////////////////////////////
module.exports = {
	/** @type {String} ip address for server */
	ip: 		process.env.OPENSHIFT_NODEJS_IP ||
					process.env.IP ||
					undefined,

  /** @type {Number} port to execute server on */
	port:   process.env.OPENSHIFT_NODEJS_PORT ||
					process.env.PORT ||
					8080,

	/** @type {Object} mongodb connection arguments */
	mongodb: {
		uri:  process.env.MONGOLAB_URI ||
					process.env.MONGOHQ_URI ||
					process.env.OPENSHIFT_MONGODB_DB_URL+process.env.OPENSHIFT_APP_NAME ||
					'mongodb://localhost/modularapi'
	}
};
