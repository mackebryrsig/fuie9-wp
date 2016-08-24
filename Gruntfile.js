module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
            jshint: {
                all: [
                    'Gruntfile.js',
                    'assets/js/app.js',
                    '!assets/js/app.min.js'
                ]
            },
            uglify: {
                dist: {
                    files: {
                        'assets/js/app.min.js': [
                        'assets/js/plugins/*.js',
                        'assets/js/app.js'
                        ]
                    }
                }
            },
            less: {
                dist: {
                    files: {
                        'assets/css/main.css': ['assets/less/app.less']
                    }
                }
            },
            watch: {
                less: {
                    files: [
                        'assets/less/app.less',
                        'assets/less/app/*.less'
                    ],
                    tasks: ['less']
                },
                js: {
                    files: [
                        '<%= jshint.all %>'
                    ],
                    tasks: ['jshint', 'uglify']
                }
            },
            cssmin: {
                combine: {
                    files: {
                       'assets/css/main.min.css': ['assets/css/main.css']
                    }
                }
            },
            imagemin: {
                dynamic: {
                    files: [{
                        expand: true,
                        cwd: 'assets/img/',
                        src: ['**/*.{png,jpg,gif}'],
                        dest: 'assets/img/'
                    }]
                }
            },
            browserSync: {
                dev: {
                    bsFiles: {
                        src : [
                            'assets/css/main.css',
                            '*.php',
                            'templates/components/*.php'
                        ]
                    },
                    options: {
                        watchTask: true,
                        proxy: "www.who-cares.dev",
                        notify: false
                    }
                }
            }
});

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-contrib-imagemin');

    grunt.registerTask('default', ['jshint', 'uglify', 'less', 'cssmin', 'imagemin']);
    grunt.registerTask('dev', ['browserSync', 'watch']);
    
};
