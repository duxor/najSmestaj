var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix){
//JS::
    //MASTER:master
    mix.scripts([
            'master-jquery.min.js',
            'master-landio.min.js',
            'master-contact-form.js'
        ],
        'public/templejt/master/js/min/master.js'
    );
    //MASTER:index-only
    mix.scripts([
            'moment.js',
            'datetimepicker.js',
            'index-basic-master-function.js'
        ],
        'public/templejt/master/js/min/index-only.js'
    );
    //MASTER:index
    mix.scripts([
            'master-jquery.min.js',
            'master-landio.min.js',
            'master-contact-form.js',
            'moment.js',
            'datetimepicker.js',
            'index-basic-master-function.js'
        ],
        'public/templejt/master/js/min/index.js'
    );
    //MASTER:pretraga
    mix.scripts([
            'master-jquery.min.js',
            'master-landio.min.js',
            'master-contact-form.js',
            'moment.js',
            'datetimepicker.js',
            'master-pretraga.js'
        ],
        'public/templejt/master/js/min/pretraga.js'
    );
    //PLAVI-IZGLED::
    mix.scripts([
            'plavi-izgled/core.min.js',
            'plavi-izgled/script.js'
        ],
        'public/templejt/plavi-izgled/js/master.min.js'
    );
    mix.scripts('plavi-izgled/html5shiv.min.js','public/templejt/plavi-izgled/js/html5shiv.min.js');
//CSS::
    //PLAVI-IZGLED::
    mix.styles([
            'plavi-izgled/font.css',
            'plavi-izgled/style.css'
        ],
        'public/templejt/plavi-izgled/css/master.min.css'
    );
});
