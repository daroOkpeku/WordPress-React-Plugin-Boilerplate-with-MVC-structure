<?php

namespace Controller;

class viewController
{
    public function render()
    {
        // Load the HTML view file
        $view_path = __DIR__ . '/../view/home.php';

        if (file_exists($view_path)) {
            include $view_path;
        } else {
            // Show error with the path for debugging
            echo '<div class="notice notice-error">';
            echo '<p>View file not found!</p>';
            echo '<p>Looking for: ' . esc_html($view_path) . '</p>';
            echo '<p>Directory: ' . esc_html(__DIR__) . '</p>';
            echo '</div>';
        }
    }


    public function renderStories()
    {
        // Load the HTML view file
        $view_path = __DIR__ . '/../view/stories.php';

        if (file_exists($view_path)) {
            include $view_path;
        } else {
            // Show error with the path for debugging
            echo '<div class="notice notice-error">';
            echo '<p>View file not found!</p>';
            echo '<p>Looking for: ' . esc_html($view_path) . '</p>';
            echo '<p>Directory: ' . esc_html(__DIR__) . '</p>';
            echo '</div>';
        }
    }
}
