// Admin Scripts for QantumThemes Functions
(function() {

    /**
     *
     *  Gallery shortcode
     *  @param {string} [button name] [description] value = qtgallery 
     *  IMPORTANT: In php:  array_push($buttons, "qtgallery");
     * 
     */
    tinymce.create("tinymce.plugins.t2gicons_button_plugin", {
        init : function(ed, url) {
            ed.addButton('t2gicons', {
                type: 'button',
                text: '',
                icon: ' t2gicons-mce-button ',// ' wp-menu-image dashicons-before dashicons-welcome-view-site',
                tooltip: 'Add Icon',
                fixedWidth: false,
                onclick: function(e) {
                    ed.focus();
                    document.getElementById("t2gicons-closemodal").click();
                },
                onPostRender: function() {
                    ed.my_control = this; // ui control element
                }
            });

        },
        createControl : function(n, cm) {
            return null;
        },
        getInfo : function() {
            return {
                longname : "Icons2Go",
                author : "Themes2Go",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("t2gicons_shortcodes_plugin", tinymce.plugins.t2gicons_button_plugin);
})();
