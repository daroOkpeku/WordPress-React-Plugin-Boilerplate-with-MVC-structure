=== Great React Plugin ===
Contributors: Okpeku Stephen
Tags: react, wordpress, plugin, tailwindcss
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A modern WordPress plugin built with React and Tailwind CSS, providing a seamless admin and frontend experience.

== Description ==

Great React Plugin is a powerful WordPress plugin that integrates React.js with WordPress, offering a modern development workflow and user interface. It includes a custom post type and provides both admin and frontend interfaces.

== Installation ==

1. Upload the `great-react-plugin` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set up the development environment (see Development section below)

== Requirements ==

- WordPress 5.8 or higher
- PHP 7.4 or higher
- Node.js 16.0 or higher
- npm or yarn package manager

== Development Setup ==

1. Navigate to the plugin directory:

   ```
   cd wp-content/plugins/great-react-plugin
   ```

2. Install dependencies:

   ```
   npm install
   ```

3. Build the assets for production:

   ```
   npm run build
   ```

4. For development with hot-reloading:

   ```
   npm start
   ```

5. To watch and build Tailwind CSS:
   ```
   npx tailwindcss -i ./src/index.css -o ./build/index.css --watch
   ```

== Usage ==

### Shortcode

Add the following shortcode to any post or page to display the frontend view:

```
[great-react-plugin]
```

### Admin Area

1. After activation, you'll find 'Great React Plugin' in your WordPress admin menu
2. Click on it to access the admin interface

## Features

- Modern React-based architecture
- Seamless WordPress integration
- Responsive design with Tailwind CSS
- Custom post type support
- Admin and frontend interfaces

## Support

For support, please open an issue in the plugin's GitHub repository or contact support@example.com

## Changelog

= 1.0.0 =

- Initial release
