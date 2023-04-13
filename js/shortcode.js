jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.plugin', {
        init : function(nlform) {
                // Register command for when button is clicked
                nlform.addCommand('insert_shortcode', function() {
                    content =  '[newsletter_form]';
                    tinymce.execCommand('mceInsertContent', false, content);
                });

            // Register buttons - trigger above command when clicked
            nlform.addButton('newsletter_form', {title : 'Add Form', cmd : 'insert_shortcode', text: 'Newsletter Form' });
        },   
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('newsletter_form', tinymce.plugins.plugin);
});