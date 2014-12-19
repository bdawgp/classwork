'use strict';

var _ = require('lodash'),
		path = require('path');

/** @type {String} default to development environment */
if(['production', 'development', 'test'].indexOf(process.env.NODE_ENV) < 0)
	process.env.NODE_ENV = 'development';

var config = {
	/** @type {String} environment to use in application */
	env: process.env.NODE_ENV,

	/** @type {String} root path of the application */
	root: path.normalize(__dirname + '/..'),

	/** @type {Number} port to execute HTTP server on */
	port: process.env.PORT || 9000,

	/** @type {Object} HTTPS server options */
	https: {
    /** @type {Boolean} toggle for use of https */
		enabled: false,
    /** @type {Number} port to execute HTTPS server on */
		port: process.env.HTTPS_PORT || 9443,
    /** @type {String} path to SSL private key */
		key: process.env.HTTPS_KEY || '',
    /** @type {String} path to SSL certificate */
		certificate: process.env.HTTPS_CERTIFICATE || ''
	},

	/** @type {Object} sockets configuration */
	socketio: {
    /** @type {Boolean} toggle for use of sockets */
		enabled: true
	},

	/** @type {Boolean} populate the database with seed data */
	seedDB: process.env.SEED_DB === 'true',

	/** @type {String} session secret key used with jsonwebtoken */
	secretKey: process.env.SECRET_KEY || 'modular-api-secret',

	/** @type {Object} CORS configuration (see npmjs.com/cors) */
	cors: {
    /** @type {Array} origins to whitelist, use true to automatically whitelist all */
		origin: true,
    /** @type {Array} HTTP request methods to permit by CORS */
		methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    /** @type {Array} HTTP headers to permit by CORS */
		allowedHeaders: ['Origin', 'Content-Type', 'Authorization']
	},

  /** @type {Object} JWT token options */
  jwt: {
    /** @type {Object} JWT token creation options (see npmjs.com/jsonwebtoken) */
    options: {
      expiresInMinutes: 30
    },
    /** @type {Number} minutes until token expiration before new one is issued */
    maxMinutesRefresh: 10
  },

	/** @type {Object} mongodb connection arguments */
	mongodb: {
		options: {
			db: {
				safe: true
			}
		}
	}
};

module.exports = _.merge(config, require('./environment'));
