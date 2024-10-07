<?php
class ACP_Admin {
    private $plugin_name;
    private $version;
    private $option_name;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->option_name = $this->plugin_name . '_settings';
        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_styles_scripts'));
    }

    public function add_plugin_admin_menu() {
        add_options_page(
            'Advanced Cookie Settings',
            'Advanced Cookie',
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_admin_page')
        );
    }

    public function register_settings() {
        register_setting(
            $this->plugin_name,
            $this->option_name,
            array($this, 'validate_options')
        );

        add_settings_section(
            $this->plugin_name . '_general',
            'Cookie Consent Settings',
            array($this, 'settings_section_callback'),
            $this->plugin_name
        );

        $this->add_settings_field('popup_title', 'Popup Title');
        $this->add_settings_field('cookie_message', 'Cookie Message', 'textarea');
        $this->add_settings_field('accept_button_text', 'Accept Button Text');
        $this->add_settings_field('decline_button_text', 'Decline Button Text');
        $this->add_settings_field('policy_link_text', 'Policy Link Text');
        $this->add_settings_field('policy_url', 'Policy URL');
        $this->add_settings_field('cookie_expiry', 'Cookie Expiry (days)', 'number');
        $this->add_settings_field('popup_position', 'Popup Position', 'select');
        
        // New customization fields
        $this->add_settings_field('banner_bg_color', 'Banner Background Color', 'color');
        $this->add_settings_field('banner_text_color', 'Banner Text Color', 'color');
        
                // New fields for font sizes
        $this->add_settings_field('heading_font_size', 'Heading Font Size (px)', 'number');
        $this->add_settings_field('paragraph_font_size', 'Paragraph Font Size (px)', 'number');
        $this->add_settings_field('policy_text_font_size', 'Policy Text Font Size (px)', 'number');

        // New fields for accept and decline buttons
        $this->add_settings_field('accept_button_bg_color', 'Accept Button Background Color', 'color');
        $this->add_settings_field('accept_button_text_color', 'Accept Button Text Color', 'color');
        $this->add_settings_field('accept_button_font_size', 'Accept Button Font Size (px)', 'number');
        
        $this->add_settings_field('decline_button_bg_color', 'Decline Button Background Color', 'color');
        $this->add_settings_field('decline_button_text_color', 'Decline Button Text Color', 'color');
        $this->add_settings_field('decline_button_font_size', 'Decline Button Font Size (px)', 'number');
        

    }

    private function add_settings_field($id, $label, $type = 'text') {
        add_settings_field(
            $id,
            $label,
            array($this, 'render_field'),
            $this->plugin_name,
            $this->plugin_name . '_general',
            array('id' => $id, 'type' => $type)
        );
    }

    public function render_field($args) {
        $id = $args['id'];
        $type = $args['type'];
        $options = get_option($this->option_name);
        $value = isset($options[$id]) ? $options[$id] : '';

        switch ($type) {
            case 'textarea':
                echo '<textarea name="' . $this->option_name . '[' . $id . ']" rows="5" cols="50">' . esc_textarea($value) . '</textarea>';
                break;
            case 'number':
                echo '<input type="number" name="' . $this->option_name . '[' . $id . ']" value="' . esc_attr($value) . '" class="small-text">';
                break;
            case 'select':
                $this->popup_position_field_callback($value);
                break;
            case 'color':
                echo '<input type="color" name="' . $this->option_name . '[' . $id . ']" value="' . esc_attr($value) . '">';
                break;
            default:
                echo '<input type="text" name="' . $this->option_name . '[' . $id . ']" value="' . esc_attr($value) . '" class="regular-text">';
        }
    }

    public function validate_options($input) {
        $valid = array();
        $options = $this->get_settings_fields();

        foreach ($options as $option) {
            $id = $option['id'];
            if (isset($input[$id])) {
                switch ($option['type']) {
                    case 'number':
                        $valid[$id] = intval($input[$id]);
                        break;
                    case 'color':
                        $valid[$id] = sanitize_hex_color($input[$id]);
                        break;
                    default:
                        $valid[$id] = sanitize_text_field($input[$id]);
                }
            }
        }

        return $valid;
    }

    private function get_settings_fields() {
        return array(
            array('id' => 'popup_title', 'type' => 'text'),
            array('id' => 'cookie_message', 'type' => 'textarea'),
            array('id' => 'accept_button_text', 'type' => 'text'),
            array('id' => 'decline_button_text', 'type' => 'text'),
            array('id' => 'policy_link_text', 'type' => 'text'),
            array('id' => 'policy_url', 'type' => 'text'),
            array('id' => 'cookie_expiry', 'type' => 'number'),
            array('id' => 'popup_position', 'type' => 'select'),
            array('id' => 'banner_bg_color', 'type' => 'color'),
            array('id' => 'banner_text_color', 'type' => 'color'),
            array('id' => 'font_size', 'type' => 'number'),
            array('id' => 'accept_button_bg_color', 'type' => 'color'),
            array('id' => 'accept_button_text_color', 'type' => 'color'),
            array('id' => 'accept_button_font_size', 'type' => 'number'),
            array('id' => 'decline_button_bg_color', 'type' => 'color'),
            array('id' => 'decline_button_text_color', 'type' => 'color'),
            array('id' => 'decline_button_font_size', 'type' => 'number'),
            array('id' => 'heading_font_size', 'type' => 'number'),
            array('id' => 'paragraph_font_size', 'type' => 'number'),
            array('id' => 'policy_text_font_size', 'type' => 'number'),
        );
    }

    public function settings_section_callback() {
        echo '<p>Configure the settings for your Advanced Cookie Plugin.</p>';
    }

    public function popup_position_field_callback($value) {
        $positions = array('top', 'bottom', 'top-left', 'top-right', 'bottom-left', 'bottom-right');
        echo '<select name="' . $this->option_name . '[popup_position]">';
        foreach ($positions as $position) {
            echo '<option value="' . esc_attr($position) . '" ' . selected($value, $position, false) . '>' . esc_html(ucfirst(str_replace('-', ' ', $position))) . '</option>';
        }
        echo '</select>';
    }

    public function display_plugin_admin_page() {
        include_once ACP_PLUGIN_DIR . 'admin/admin-display.php';
    }

    public function enqueue_admin_styles_scripts($hook) {
        if ($hook != 'settings_page_' . $this->plugin_name) {
            return;
        }
        wp_enqueue_style($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . '../admin/css/advanced-cookie-plugin-admin.css', array(), $this->version, 'all');
        wp_enqueue_script($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . '../admin/js/advanced-cookie-plugin-admin.js', array('jquery'), $this->version, false);
    }

    public function enqueue_admin_scripts($hook) {
        if ($hook != 'settings_page_' . $this->plugin_name) {
            return;
        }

        wp_enqueue_style($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . '../admin/css/advanced-cookie-plugin-admin.css', array(), $this->version, 'all');
        wp_enqueue_script($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . '../admin/js/advanced-cookie-plugin-admin.js', array('jquery'), $this->version, false);

        $options = get_option($this->option_name);
        wp_localize_script($this->plugin_name . '-admin', 'acpAdminData', $options);
    }
}