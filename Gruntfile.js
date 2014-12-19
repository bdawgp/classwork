'use strict';

module.exports = function(grunt){
  var localEnv;
  try {
    localEnv = require('./config/local.env');
  } catch(e) {
    localEnv = {};
  }

  /** Lazy load grunt tasks automatically */
  require('jit-grunt')(grunt, {
    express: 'grunt-express-server',

  });

  /** Record how long tasks take */
  require('time-grunt')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    clean: {
      server: ['.tmp']
    },

    env: {
      test: {
        NODE_ENV: 'test'
      },
      prod: {
        NODE_ENV: 'production'
      },
      all: localEnv
    },

    express: {
      options: {
        port: process.env.PORT || 9000,
      },
      dev: {
        options: {
          script: 'app.js'
        }
      }
    },

    mochaTest: {
      options: {
        reporter: 'spec'
      },
      src: ['api/**/*.spec.js']
    },

    watch: {
      mochaTest: {
        files: ['api/**/*.spec.js'],
        tasks: ['env:test', 'mochaTest']
      },

      express: {
        files: [
          '{api,auth,config,lib}/**/*.{js,json}',
          '*.{js,json}'
        ],
        tasks: ['express:dev', 'wait'],
        options: {
          nospawn: true
        }
      },

      gruntfile: {
        files: ['Gruntfile.js']
      },
    }
  });

  grunt.registerTask('serve', [
    'clean:server',
    'env:all',
    'express:dev',
    'wait',
    'watch'
  ]);
  grunt.registerTask('server', ['serve']);

  grunt.registerTask('test', [
    'env:all',
    'env:test',
    'mochaTest'
  ]);

  grunt.registerTask('wait', function(){
    grunt.log.ok('Allowing express server to finish starting...');
    var done = this.async();
    setTimeout(done, 1500);
  });

  grunt.registerTask('default', ['test']);
};
