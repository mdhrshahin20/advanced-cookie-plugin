(function($) {
    'use strict';

    $(document).ready(function() {
        if (!getCookie('advanced_cookie_consent')) {
            $('#acp-cookie-popup').show();
        }

        $('#acp-accept-cookies').on('click', function() {
            setCookie('advanced_cookie_consent', 'accepted', acpData.cookie_expiry);
            $('#acp-cookie-popup').hide();
        });

        $('#acp-decline-cookies').on('click', function() {
            setCookie('advanced_cookie_consent', 'declined', acpData.cookie_expiry);
            $('#acp-cookie-popup').hide();
        });
    });

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/; SameSite=Lax";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

})(jQuery);
