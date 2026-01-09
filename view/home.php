<?php

/**
 * Home Page Template
 * 
 * This template displays the plugin's admin interface.
 */

// Ensure this is being called in WordPress admin context
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div id="great-react-root" data-page="home">
        <p>Loading React App...</p>
    </div>

    <script>
        // border: 2px solid #0073aa; padding: 20px; margin-top: 20px; min-height: 200px; background: #f0f0f1;
        // console.log('home.php loaded');
        // console.log('Element exists:', !!document.getElementById('great-react-root'));
        // console.log('Full element:', document.getElementById('great-react-root'));
    </script>
</div>