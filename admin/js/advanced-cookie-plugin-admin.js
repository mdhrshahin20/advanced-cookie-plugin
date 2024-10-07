(function($) {
    'use strict';

    $(document).ready(function() {
        // Function to update preview
        function updatePreview() {
            var $preview = $('#acp-cookie-popup');
            var prefix = 'advanced-cookie-plugin_settings[';
            var suffix = ']';
            
            // Update text content
            $('#preview-title').text($('input[name="' + prefix + 'popup_title' + suffix + '"]').val());
            $('#preview-message').text($('textarea[name="' + prefix + 'cookie_message' + suffix + '"]').val());
            $('#preview-accept').text($('input[name="' + prefix + 'accept_button_text' + suffix + '"]').val());
            $('#preview-decline').text($('input[name="' + prefix + 'decline_button_text' + suffix + '"]').val());
            $('#preview-policy').text($('input[name="' + prefix + 'policy_link_text' + suffix + '"]').val())
                                .attr('href', $('input[name="' + prefix + 'policy_url' + suffix + '"]').val());

            // Update styles with !important
            $preview.attr('style', 
                'background-color: ' + $('input[name="' + prefix + 'banner_bg_color' + suffix + '"]').val() + ' !important; ' +
                'color: ' + $('input[name="' + prefix + 'banner_text_color' + suffix + '"]').val() + ' !important;'
            );

            $('#preview-title').attr('style', 
                'font-size: ' + $('input[name="' + prefix + 'heading_font_size' + suffix + '"]').val() + 'px !important; ' +
                'color: ' + $('input[name="' + prefix + 'banner_text_color' + suffix + '"]').val() + ' !important;'
            );

            $('#preview-message').attr('style', 
                'font-size: ' + $('input[name="' + prefix + 'paragraph_font_size' + suffix + '"]').val() + 'px !important;'
            );

            $('#preview-policy').attr('style', 
                'font-size: ' + $('input[name="' + prefix + 'policy_text_font_size' + suffix + '"]').val() + 'px !important;'
            );

            $('#preview-accept').attr('style', 
                'background-color: ' + $('input[name="' + prefix + 'accept_button_bg_color' + suffix + '"]').val() + ' !important; ' +
                'color: ' + $('input[name="' + prefix + 'accept_button_text_color' + suffix + '"]').val() + ' !important; ' +
                'font-size: ' + $('input[name="' + prefix + 'accept_button_font_size' + suffix + '"]').val() + 'px !important;'
            );

            $('#preview-decline').attr('style', 
                'background-color: ' + $('input[name="' + prefix + 'decline_button_bg_color' + suffix + '"]').val() + ' !important; ' +
                'color: ' + $('input[name="' + prefix + 'decline_button_text_color' + suffix + '"]').val() + ' !important; ' +
                'font-size: ' + $('input[name="' + prefix + 'decline_button_font_size' + suffix + '"]').val() + 'px !important;'
            );

            // Update position
            $preview.attr('class', 'acp-cookie-popup acp-position-' + $('select[name="' + prefix + 'popup_position' + suffix + '"]').val() );
        }

        // Initial update
        updatePreview();

        // Update on any input change
        $('form input, form textarea, form select').on('input change', function() {
            updatePreview();
        });
    });

})(jQuery);