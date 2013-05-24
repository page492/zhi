;(function() {
    seajs.config({

        alias: {
            'jquery': 'lib/jquery-1.9.1.min.js',
            'bootstrap': 'lib/bootstrap.min.js',
            'dialog': 'lib/jquery.artDialog.js',
            'ajaxForm': 'lib/jquery.form.js',
            'lazyload': 'lib/jquery.lazyload.min.js',
            'uploader': 'lib/fileuploader.js',
            'datetimepicker': 'lib/datetimepicker.min.js',
            'validform': 'lib/Validform_v5.3.2_min.js',
            'imgareaselect': 'lib/imgareaselect.min.js',
            'ckeditor': 'ckeditor/ckeditor.js'
        },

        debug: true

    });
})();

define(function(require, exports) {
    require('jquery');
    require('pages/global');
    exports.load = function(filename) {
        $.each(filename.split(','), function(key, file) {
            if (file) {
                require.async(file, function(mod) {
                    if (mod && mod.init) {
                        mod.init();
                    }
                });
            }
        });
    }
});