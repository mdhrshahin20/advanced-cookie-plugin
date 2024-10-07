<?php
class ACP_Public {
    private $plugin_name;
    private $version;
    private $option_name;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->option_name = $this->plugin_name . '_settings';

        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_footer', array($this, 'display_cookie_popup'));
    }

    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, ACP_PLUGIN_URL . 'public/css/advanced-cookie-plugin-public.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, ACP_PLUGIN_URL . 'public/js/advanced-cookie-plugin-public.js', array('jquery'), $this->version, true);

        $options = get_option($this->option_name);
        $customization = array(
            'cookie_expiry' => isset($options['cookie_expiry']) ? intval($options['cookie_expiry']) : 30,
        );

        wp_localize_script($this->plugin_name, 'acpData', $customization);
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
                'popup_position' => isset($options['popup_position']) ? $options['popup_position'] : 'bottom',
                'banner_bg_color' => isset($options['banner_bg_color']) ? $options['banner_bg_color'] : '#00a99d',
                'banner_text_color' => isset($options['banner_text_color']) ? $options['banner_text_color'] : '#ffffff',
                'font_size' => isset($options['font_size']) ? intval($options['font_size']) : 14,
                'accept_button_bg_color' => isset($options['accept_button_bg_color']) ? $options['accept_button_bg_color'] : '#ffffff',
                'accept_button_text_color' => isset($options['accept_button_text_color']) ? $options['accept_button_text_color'] : '#00a99d',
                'accept_button_font_size' => isset($options['accept_button_font_size']) ? intval($options['accept_button_font_size']) : 14,
                'decline_button_bg_color' => isset($options['decline_button_bg_color']) ? $options['decline_button_bg_color'] : '#f44336',
                'decline_button_text_color' => isset($options['decline_button_text_color']) ? $options['decline_button_text_color'] : '#ffffff',
                'decline_button_font_size' => isset($options['decline_button_font_size']) ? intval($options['decline_button_font_size']) : 14,
                'heading_font_size' => isset($options['heading_font_size']) ? intval($options['heading_font_size']) : 18,
                'paragraph_font_size' => isset($options['paragraph_font_size']) ? intval($options['paragraph_font_size']) : 14,
                'policy_text_font_size' => isset($options['policy_text_font_size']) ? intval($options['policy_text_font_size']) : 12,
            );
            include_once ACP_PLUGIN_DIR . 'public/partials/cookie-popup.php';
        }
    }
}
