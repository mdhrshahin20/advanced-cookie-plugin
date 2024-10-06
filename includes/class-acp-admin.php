<?php
class ACP_Admin {
    private $plugin_name;
    private $version;
    private $option_name;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->option_name = $this->plugin_name . '_settings';
        error_log('ACP_Admin initialized');
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
            default:
                echo '<input type="text" name="' . $this->option_name . '[' . $id . ']" value="' . esc_attr($value) . '" class="regular-text">';
        }
    }

    public function validate_options($input) {
        $valid = array();
        $fields = array(
            'popup_title', 'cookie_message', 'accept_button_text', 'decline_button_text',
            'policy_link_text', 'policy_url', 'cookie_expiry', 'popup_position'
        );

        foreach ($fields as $field) {
            if (isset($input[$field])) {
                $valid[$field] = $field === 'cookie_expiry' ? intval($input[$field]) : sanitize_text_field($input[$field]);
            }
        }

        return $valid;
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
}