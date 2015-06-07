module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    meta: {
            basePath: '../',
            srcPath: '../public/scss/',
            deployPath: '../public/css/'
    },

    banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
          '<%= grunt.template.today("yyyy-mm-dd") %>\n' +
          '* Copyright (c) <%= grunt.template.today("yyyy") %> ',

    sass: {
        dev: {
            files: [{
              expand: true,
              cwd: '../public/scss/',
              src: ['*.scss','**/*.scss'],
              dest: '../public/css/',
              ext: '.css'
            }]
        }
    },
    watch: {
        sass: {
          files: ['<%= meta.srcPath %>/**/*.{scss,sass}'],
          tasks: ['sass:dev']          
        }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

  // 默认被执行的任务列表。
  grunt.registerTask('default', ['sass:dev:','watch']);

};