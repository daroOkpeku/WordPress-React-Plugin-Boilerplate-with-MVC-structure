<?php

/**
 * Stories Page Template
 * 
 * This template displays the plugin's admin interface.
 */

use PhpSPA\Component;

// Ensure this is being called in WordPress admin context
if (!defined('ABSPATH')) {
    exit;
}

return new Component(function() {
    $title = esc_html(get_admin_page_title());

    return <<<HTML
        <div class="wrap">
            <h1>{$title}</h1>

            <div id="great-react-root" data-page="stories">
                <p>Loading React App...stop</p>
            </div>
        </div>
    HTML;
})
    ->title(esc_html(get_admin_page_title()))
    ->route('/stories')

    ->script(fn() => <<<JS
        console.log('stories.php loaded');
        console.log('Element exists:', !!document.getElementById('great-react-root'));
        console.log('Full element:', document.getElementById('great-react-root'));
    JS);
