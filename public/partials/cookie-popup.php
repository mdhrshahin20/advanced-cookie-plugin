<style>
    #acp-cookie-popup {
        background-color: <?php echo esc_attr($popup_data['banner_bg_color']); ?>;
        color: <?php echo esc_attr($popup_data['banner_text_color']); ?>;
    }
    #acp-cookie-popup .acp-cookie-title {
        font-size: <?php echo esc_attr($popup_data['heading_font_size']); ?>px;
    }
    #acp-cookie-popup .acp-cookie-message {
        font-size: <?php echo esc_attr($popup_data['paragraph_font_size']); ?>px;
    }
    #acp-cookie-popup .acp-cookie-policy-link {
        font-size: <?php echo esc_attr($popup_data['policy_text_font_size']); ?>px;
    }
    #acp-accept-cookies {
        background-color: <?php echo esc_attr($popup_data['accept_button_bg_color']); ?>;
        color: <?php echo esc_attr($popup_data['accept_button_text_color']); ?>;
        font-size: <?php echo esc_attr($popup_data['accept_button_font_size']); ?>px;
    }
    #acp-decline-cookies {
        background-color: <?php echo esc_attr($popup_data['decline_button_bg_color']); ?>;
        color: <?php echo esc_attr($popup_data['decline_button_text_color']); ?>;
        font-size: <?php echo esc_attr($popup_data['decline_button_font_size']); ?>px;
    }
</style>


<div id="acp-cookie-popup" class="acp-cookie-popup acp-position-<?php echo esc_attr($popup_data['popup_position']); ?>">
    <div class="acp-cookie-content">
        <div class="acp-cookie-text">
            <h3 class="acp-cookie-title"><?php echo esc_html($popup_data['title']); ?></h3>
            <p class="acp-cookie-message"><?php echo esc_html($popup_data['message']); ?>
        
            <a href="<?php echo esc_url($popup_data['policy_url']); ?>" class="acp-cookie-policy-link" target="_blank"><?php echo esc_html($popup_data['policy_text']); ?></a>
        
        </p>
        </div>
        <div class="acp-cookie-actions">
            <button id="acp-accept-cookies" class="acp-button acp-accept"><?php echo esc_html($popup_data['accept_text']); ?></button>
            <button id="acp-decline-cookies" class="acp-button acp-decline"><?php echo esc_html($popup_data['decline_text']); ?></button>
        </div>
    </div>
</div>
