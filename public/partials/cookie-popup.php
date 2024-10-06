<div id="acp-cookie-popup" class="acp-cookie-popup">
    <div class="acp-cookie-content">
        <div class="acp-cookie-text">
            <h3 class="acp-cookie-title"><?php echo esc_html($popup_data['title']); ?></h3>
            <p class="acp-cookie-message"><?php echo esc_html($popup_data['message']); ?></p>
        </div>
        <div class="acp-cookie-actions">
            <button id="acp-accept-cookies" class="acp-button acp-accept"><?php echo esc_html($popup_data['accept_text']); ?></button>
            <button id="acp-decline-cookies" class="acp-button acp-decline"><?php echo esc_html($popup_data['decline_text']); ?></button>
            <a href="<?php echo esc_url($popup_data['policy_url']); ?>" class="acp-cookie-policy-link" target="_blank"><?php echo esc_html($popup_data['policy_text']); ?></a>
        </div>
    </div>
</div>
