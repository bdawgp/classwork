'use strict';

/** @type {Object} environment-specific configuration */
module.exports = require('./' + process.env.NODE_ENV) || {};
