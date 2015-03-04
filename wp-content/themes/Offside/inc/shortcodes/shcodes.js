// Alert Shortcode
// ===============================================================================
var AlertDialog = {
    local_ed: 'ed',
    init: function(ed) {
        AlertDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertAlert(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var style = jQuery('#button-dialog select#alert-style').val();
        output = '[display_alert ';
        output += 'style=' + style;
        output += ']' + 'Alert content' + '[/display_alert]';
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};


// Button Shortcode
// ===============================================================================
var ButtonDialog = {
    local_ed: 'ed',
    init: function(ed) {
        ButtonDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertButton(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var url = jQuery('#button-dialog input#button-url').val();
        var text = jQuery('#button-dialog input#button-text').val();
        var size = jQuery('#button-dialog select#button-size').val();
        var color = jQuery('#button-dialog select#button-color').val();
        var classi = jQuery('#button-dialog input#button-classi').val();
        var output = '';
        output = '[display_button ';
        output += 'size=' + size + ' ';
        output += 'color=' + color + ' ';
        output += 'classi=' + classi;
        if (url) {
            output += ' url=' + url;
        }
        if (text) {
            output += ']' + text + '[/display_button]';
        } else {
            output += ']' + 'Button Text' + '[/display_button]';
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};


// Accordion Shortcode
// ===============================================================================
var AccordionDialog = {
    local_ed: 'ed',
    init: function(ed) {
        AccordionDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertAccordion(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var en = '[/display_accordion-div]';
        var op = '[display_accordion title="Section Title"]';
        var cl = '[/display_accordion]';
        var co = 'Section Content';
        output = '[display_accordion-div]';
        if ($('#option-text option#op1:selected').val()) {
            output += op + co + ' 1' + cl + en;
        } else if ($('#option-text option#op2:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + en;
        } else if ($('#option-text option#op3:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + op + co + '3' + cl + en;
        } else if ($('#option-text option#op4:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + op + co + '3' + cl + op + co + '4' + cl + en;
        } else if ($('#option-text option#op5:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + op + co + '3' + cl + op + co + '4' + cl + op + co + '5' + cl + en;
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};


// Progress Bar Shortcode
// ===============================================================================
var BarDialog = {
    local_ed: 'ed',
    init: function(ed) {
        BarDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertBar(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var style = jQuery('#button-dialog select#progress-style').val();
        var striped = jQuery('#button-dialog input#option-striped').val();
        var progress = jQuery('#button-dialog input#info-progress').val();
        var output = '';
        output = '[display_bar ';
        output += 'style=' + style + ' ';
        output += 'progress=' + progress;
        if ($('#option-striped:checked').val()) {
            output += ' striped=' + striped + ']';
        } else {
            output += ']';
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};

// Labels Shortcode
// ===============================================================================
var LabelsDialog = {
    local_ed: 'ed',
    init: function(ed) {
        LabelsDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertLabels(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var style = jQuery('#button-dialog select#label-style').val();
        var text = jQuery('#button-dialog input#label-text').val();
        var output = '';
        output = '[display_label ';
        output += 'style=' + style;
        if (text) {
            output += ']' + text + '[/display_label]';
        } else {
            output += ']' + 'Text Here' + '[/display_label]';
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};

// Maps Shortcode
// ===============================================================================
var MapDialog = {
    local_ed: 'ed',
    init: function(ed) {
        MapDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertMap(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var url = jQuery('#button-dialog input#info-url').val();
        var width = jQuery('#button-dialog input#info-width').val();
        var height = jQuery('#button-dialog input#info-height').val();
        var output = '';
        output = '[display_maps ';
        output += 'src=' + url + ' ';
        output += 'width=' + width + ' ';
        output += 'height=' + height;
        output += ']';
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};

// Pull-Quote Shortcode
// ===============================================================================
var QuoteDialog = {
    local_ed: 'ed',
    init: function(ed) {
        QuoteDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertQuote(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var align = jQuery('#button-dialog select#quote-style').val();
        var text = jQuery('#button-dialog input#quote-text').val();
        var output = '';
        output = '[display_quote ';
        output += 'align=' + align;
        if (text) {
            output += ']' + text + '[/display_quote]';
        } else {
            output += ']' + 'Quote Here' + '[/display_quote]';
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        // Return
        tinyMCEPopup.close();
    }
};

// Tabs Shortcode
// ===============================================================================
var TabsDialog = {
    local_ed: 'ed',
    init: function(ed) {
        TabsDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertTabs(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var en = '[/display_tabs-div]';
        var op = '[display_tabs title="Tab Title"]';
        var cl = '[/display_tabs]';
        var co = 'Tab Content ';
        output = '[display_tabs-div]';
        if ($('#option-tabs option#op1:selected').val()) {
            output += op + co + ' 1' + cl + en;
        } else if ($('#option-tabs option#op2:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + en;
        } else if ($('#option-tabs option#op3:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + op + co + '3' + cl + en;
        } else if ($('#option-tabs option#op4:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + op + co + '3' + cl + op + co + '4' + cl + en;
        } else if ($('#option-tabs option#op5:selected').val()) {
            output += op + co + '1' + cl + op + co + '2' + cl + op + co + '3' + cl + op + co + '4' + cl + op + co + '5' + cl + en;
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};

// Video Shortcode
// ===============================================================================
var VideoDialog = {
    local_ed: 'ed',
    init: function(ed) {
        VideoDialog.local_ed = ed;
        tinyMCEPopup.resizeToInnerSize();
    },
    insert: function insertVideo(ed) {
        tinyMCEPopup.execCommand('mceRemoveNode', false, null);
        var text = jQuery('#button-dialog input#youtube-id').val();
        var playeryt = jQuery('#player-select #youtube:selected').val();
        var playervi = jQuery('#player-select #vimeo:selected').val();
        var output = '';
        output = '[display_video ';
        if (playeryt) {
            output += 'youtube=' + text + ']';
        } else if (playervi) {
            output += 'vimeo=' + text + ']';
        }
        tinyMCEPopup.execCommand('mceReplaceContent', false, output);
        tinyMCEPopup.close();
    }
};