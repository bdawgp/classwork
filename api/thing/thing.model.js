'use strict';

var _ = require('lodash'),
    mongoose = require('mongoose'),
    params = require('params'),
    Schema = mongoose.Schema;

var ThingSchema = new Schema({
  name: String,
  info: String,
  active: Boolean
});

ThingSchema
  .path('name')
  .validate(function(){
    return this.name.length;
  }, 'name cannot be blank');

ThingSchema.methods = {
  /**
   * Model.update after whitelisting `data` via Model.params and using `forceData` as an override
   *
   * @param  {Object}   data      Object to run through bulk parameters update
   * @param  {Object}   forceData Object containing values to override in the whitelisted data object
   *                                      (can be used to set parameters not whitelisted)
   * @param  {Function} next      Model.create callback function
   *
   * @return {void}
   */
  safeUpdate: function(data, forceData, next){
    var data = this.constructor.params(data, forceData);
    if(typeof forceData === 'function')
      next = forceData;
    var updated = _.merge(this,data);
    updated.save(next);
  }
};

ThingSchema.statics = {
  /** @type {Array} Properties to whitelist during safe methods */
  permitted: ['name', 'info', 'active'],

  /**
   * Whitelist properties of data by Model.permitted and merge forceData with resulting object
   *
   * @param  {Object} data      Object to run through whitelisting
   * @param  {Object} forceData Object to override whitelisted object
   *
   * @return {Object}           Returns the result of whitelisting and forceData overrides
   */
  params: function(data, forceData){
    var permittedData = params(data).only(this.permitted);
    if(typeof forceData === 'object')
      permittedData = _.merge(permittedData, forceData);
    return permittedData;
  },

  /**
   * Model.create after whitelisting `data` via Model.params and using `forceData` as an override
   *
   * @param  {Object}   data      Object to run through bulk parameters update
   * @param  {Object}   forceData Object containing values to override in the whitelisted data object
   *                                      (can be used to set parameters not whitelisted)
   * @param  {Function} next      Model.create callback function
   *
   * @return {void}
   */
  safeCreate: function(data, forceData, next){
    var data = this.params(data, forceData);
    if(typeof forceData === 'function')
      next = forceData;
    var thing = new this(data);
    thing.save(next);
  }
};

module.exports = mongoose.model('Thing', ThingSchema);
