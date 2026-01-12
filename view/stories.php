<?php

/**
 * Stories Page Template
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

    <div id="great-react-root" data-page="stories">
        <p>Loading React App...stop</p>
    </div>

    <script>
        // console.log('stories.php loaded');
        // console.log('Element exists:', !!document.getElementById('great-react-root'));
        // console.log('Full element:', document.getElementById('great-react-root'));
    </script>
</div>