(function($) {
    'use strict';

    $(document).ready(function() {
        setTimeout(function() {
            $('#acp-cookie-popup').slideDown(300);
        }, 1000);

        $('#acp-accept-cookies').on('click', function() {
            setCookie('advanced_cookie_consent', 'accepted', acpData.cookie_expiry);
            closeCookiePopup();
        });

        $('#acp-decline-cookies').on('click', function() {
            setCookie('advanced_cookie_consent', 'declined', acpData.cookie_expiry);
            closeCookiePopup();
        });

        $('.acp-cookie-policy-link').on('click', function(e) {
            // The URL is now set in the HTML, so we don't need to handle it here
        });
    });

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Strict; Secure";
    }

    function closeCookiePopup() {
        $('#acp-cookie-popup').slideUp(300, function() {
            $(this).remove();
        });
    }

})(jQuery);
