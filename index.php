<?php

use PhpSPA\App;

require_once __DIR__ . '/vendor/autoload.php';

$viewPath = plugin_dir_path(__FILE__) . '/view';

return new App(require "$viewPath/layout/Layout.php")

    // --- Add view files here ---
    ->attach(require "$viewPath/Home.php")
    ->attach(require "$viewPath/Stories.php")

    // --- API Routes ---
    ->prefix('/api', require __DIR__ . '/routes/api.php')

    ->defaultTargetID('great-react-root')

    // --- Global Script ---
    ->script(fn() => <<<JS
        console.log('Global Script: Element exists?', !!document.getElementById('great-react-root'));
    JS)

    // --- True to get/return the output ---
    ->run(true);
