var path = require('path');

module.exports = function(grunt) {

    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        makepot: {
            target: {
                options: {
                    type: 'wp-plugin',
                    mainFile: '<%= pkg.name %>.php',
                    domainPath: '/languages'
                }
            }
        }

    });

    // development tasks
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-wp-i18n');

    // register build task
    grunt.registerTask('build', ['makepot']);

};
