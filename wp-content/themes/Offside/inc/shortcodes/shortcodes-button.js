jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.margot_dphbuttonshc', {

        init : function(ed, url) {

            ed.addButton('margot_dphbuttonshc', {
                title : 'Insert Shortcodes',
                image: dphvars.sh_icon,
                tooltip: "Insert Shortcodes",

                onclick: function () {
                        ed.windowManager.open({
                            url: dphvars.sh_url+"/inc/shortcodes/display-popup.html",
                            width: 650,
                            height: 300
                        }, {
                            plugin_url: url
                        });
                    }
            });

        }

    });

    tinymce.PluginManager.add('margot_dphbuttonshc', tinymce.plugins.margot_dphbuttonshc);

});