<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields($this->plugin_name);
        do_settings_sections($this->plugin_name);
        ?>
        <!-- <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="<?php echo $this->plugin_name; ?>-cookie_text">Cookie Consent Text</label>
                </th>
                <td>
                    <textarea name="<?php echo $this->plugin_name; ?>_cookie_text" id="<?php echo $this->plugin_name; ?>-cookie_text" class="large-text" rows="5"><?php echo esc_textarea(get_option($this->plugin_name . '_cookie_text', 'This website uses cookies to improve your experience. Do you accept?')); ?></textarea>
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="<?php echo $this->plugin_name; ?>-cookie_expiry">Cookie Expiry (days)</label>
                </th>
                <td>
                    <input type="number" name="<?php echo $this->plugin_name; ?>_cookie_expiry" id="<?php echo $this->plugin_name; ?>-cookie_expiry" value="<?php echo esc_attr(get_option($this->plugin_name . '_cookie_expiry', 30)); ?>" class="small-text" min="1">
                </td>
            </tr>
        </table> -->
        <?php submit_button('Save Settings'); ?>
    </form>
</div>
