'use strict';

var express = require('express');

var controller = require('./thing.controller');

var router = express.Router();

// Parameters
router.param('id', controller.findThing);

// Create
router.get('/new', controller.new);
router.post('/', controller.create);

// Read
router.get('/', controller.index);
router.get('/:id', controller.show);

// Update
router.get('/:id/edit', controller.edit);
router.put('/:id', controller.update);
router.patch('/:id', controller.update);

// Delete
router.delete('/:id', controller.destroy);

module.exports = router;
