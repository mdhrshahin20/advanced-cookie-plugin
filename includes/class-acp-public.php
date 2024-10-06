<?php
class ACP_Public {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'display_cookie_popup'));
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, ACP_PLUGIN_URL . 'public/css/advanced-cookie-plugin-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, ACP_PLUGIN_URL . 'public/js/advanced-cookie-plugin-public.js', array('jquery'), $this->version, true);

        $options = get_option($this->plugin_name . '_options');
        $cookie_expiry = isset($options['cookie_expiry']) ? intval($options['cookie_expiry']) : 30;

        wp_localize_script($this->plugin_name, 'acpData', array(
            'cookie_expiry' => $cookie_expiry
        ));
    }

    public function display_cookie_popup() {
        if (!isset($_COOKIE['advanced_cookie_consent'])) {
            $options = get_option($this->option_name);
            $popup_data = array(
                'title' => isset($options['popup_title']) ? $options['popup_title'] : 'Cookie Consent',
                'message' => isset($options['cookie_message']) ? $options['cookie_message'] : 'This website uses cookies to improve your experience.',
                'accept_text' => isset($options['accept_button_text']) ? $options['accept_button_text'] : 'Accept',
                'decline_text' => isset($options['decline_button_text']) ? $options['decline_button_text'] : 'Decline',
                'policy_text' => isset($options['policy_link_text']) ? $options['policy_link_text'] : 'View Cookie Policy',
                'policy_url' => isset($options['policy_url']) ? $options['policy_url'] : '#',
            );
            include_once ACP_PLUGIN_DIR . 'public/partials/cookie-popup.php';
        }
    }
}
