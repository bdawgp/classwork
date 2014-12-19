'use strict';

var HttpError = require('http-error').HttpError;

var Thing = require('./thing.model');

var ThingController = {
  /** CREATE **/

  new: function(req, res, next){
    res.render('thing/new', {thing: new Thing()});
  },

  create: function(req, res, next){
    Thing.safeCreate(req.body, function(err, thing){
      if(err) return res.render('thing/new', {thing: new Thing(req.body), error: err.name === 'ValidationError' ? err.toString() : err.message});
      res.redirect('/things/' + thing.id);
    });
  },

  /** READ **/

  index: function(req, res, next){
    Thing.find(function(err, things){
      if(err) return next(err);
      res.render('thing/index', {things: things});
    });
  },

  show: function(req, res, next){
    res.render('thing/show', {thing: req.thing});
  },

  /** UPDATE **/

  edit: function(req, res, next){
    res.render('thing/edit', {thing: req.thing, method: 'put'});
  },

  update: function(req, res, next){
    req.thing.safeUpdate(req.body, {active: !!req.body.active}, function(err){
      if(err) return res.render('thing/edit', {thing: req.thing, method: 'put', error: err.name === 'ValidationError' ? err.toString() : err.message});
      res.redirect('/things/' + req.thing.id);
    });
  },

  /** DELETE **/

  destroy: function(req, res, next){
    req.thing.remove(function(err){
      if(err) return next(err);
      res.redirect('/things');
    })
  },

  /** HELPERS **/

  findThing: function(req, res, next){
    Thing.findById(req.params.id, function(err, thing){
      if(err) return next(err);
      if(!thing) return next(new HttpError('not found', 404));
      req.thing = thing;
      next();
    });
  }
};

module.exports = ThingController;
