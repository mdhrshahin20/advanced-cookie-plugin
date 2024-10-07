<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <div class="acp-admin-container">
        <div class="acp-settings-form">
            <form action="options.php" method="post">
                <?php
                settings_fields($this->plugin_name);
                do_settings_sections($this->plugin_name);
                submit_button('Save Settings');
                ?>
            </form>
        </div>
        
        <div class="acp-preview-container">
            <h2>Preview</h2>
            <div id="acp-admin-preview">
                <div id="acp-cookie-popup" class="acp-cookie-popup">
                    <div class="acp-cookie-content">
                        <div class="acp-cookie-text">
                            <h3 id="preview-title" class="acp-cookie-title">Cookie Consent</h3>
                            <p id="preview-message" class="acp-cookie-message">This website uses cookies to improve your experience.</p>
                        </div>
                        <div class="acp-cookie-actions">
                            <button id="preview-accept" class="acp-button acp-accept">Accept</button>
                            <button id="preview-decline" class="acp-button acp-decline">Decline</button>
                            <a id="preview-policy" href="#" class="acp-cookie-policy-link" target="_blank">View Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
