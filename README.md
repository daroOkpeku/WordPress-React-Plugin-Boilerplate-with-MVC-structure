=== Great React Plugin ===
Contributors: Okpeku Stephen
Tags: react, wordpress, plugin, tailwindcss, mvc, modern
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

A modern WordPress plugin built with React and Tailwind CSS, providing a seamless admin and frontend experience with MVC architecture.

## Description

Great React Plugin is a powerful WordPress plugin that integrates React.js with WordPress, offering a modern development workflow and user interface. Built with a clean MVC architecture, it provides a robust foundation for developing scalable WordPress applications with React.

## 🚀 Features

- **Modern React Architecture** - Built with React 18+ and modern JavaScript (ES6+)
- **JWT Authentication** - Secure user authentication with JSON Web Tokens
- **Protected Routes** - Middleware for securing routes and API endpoints
- **MVC Pattern** - Clean separation of concerns with Model-View-Controller architecture
- **Tailwind CSS** - Utility-first CSS framework for rapid UI development
- **Webpack 5** - Modern module bundler with code splitting and hot module replacement
- **Custom Post Types** - Easy management of custom content types
- **REST API Integration** - Seamless communication with WordPress REST API
- **Role-Based Access Control** - Fine-grained permissions system
- **Token Refresh** - Secure token refresh mechanism
- **Responsive Design** - Mobile-first approach with responsive components
- **Developer Tools** - ESLint, Prettier, and Stylelint for code quality
- **Performance Optimized** - Code splitting, lazy loading, and production builds

## 📦 Installation

### Standard Installation

1. Download the latest release from the [GitHub repository](https://github.com/yourusername/great-react-plugin)
2. Upload the `great-react-plugin` folder to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

### Development Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/great-react-plugin.git
   cd great-react-plugin
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm start
   ```

4. In a new terminal, build Tailwind CSS:
   ```bash
   npx tailwindcss -i ./src/index.css -o ./build/index.css --watch
   ```

5. For production build:
   ```bash
   npm run build
   ```

## � Authentication

### JWT Authentication System

The plugin includes a robust JWT (JSON Web Token) authentication system with the following features:

- User registration and login with JWT
- Secure password hashing
- Access and refresh tokens
- Token refresh mechanism
- Protected routes and API endpoints
- Role-based access control

### Setup Authentication

1. **Install Dependencies**
   ```bash
   npm install jsonwebtoken bcryptjs cors dotenv
   ```

2. **Environment Variables**
   Create or update your `.env` file:
   ```env
   # App Settings
   NODE_ENV=development
   WP_DEV_MODE=true
   API_URL=your-api-url
   
   # JWT Configuration
   JWT_SECRET=your_secure_jwt_secret_key
   JWT_EXPIRE=24h
   JWT_COOKIE_EXPIRE=30
   
   # Refresh Token
   JWT_REFRESH_SECRET=your_secure_refresh_secret
   JWT_REFRESH_EXPIRE=7d
   
   # CORS
   CORS_ORIGIN=http://localhost:3000
   ```

3. **Authentication Endpoints**
   - `POST /api/auth/register` - Register a new user
   - `POST /api/auth/login` - User login
   - `POST /api/auth/refresh-token` - Get new access token
   - `POST /api/auth/logout` - Invalidate tokens
   - `GET /api/auth/me` - Get current user profile

### Protecting Routes

Use the authentication middleware to protect your routes:

```javascript
// In your route files
const { protect } = require('../middleware/auth');

// Protected route example
router.get('/protected-route', protect, (req, res) => {
  // req.user contains the authenticated user
  res.json({ success: true, user: req.user });
});

// Role-based access
const { authorize } = require('../middleware/auth');

// Admin-only route
router.get('/admin', 
  protect, 
  authorize('admin'), 
  (req, res) => {
    res.json({ message: 'Admin dashboard' });
  }
);
```

### Frontend Integration

Example login request:

```javascript
// Login function
export const login = async (email, password) => {
  const response = await fetch('/api/auth/login', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ email, password }),
    credentials: 'include' // Important for cookies
  });
  return response.json();
};

// Making authenticated requests
export const getProtectedData = async () => {
  const response = await fetch('/api/protected-route', {
    credentials: 'include' // Send cookies with request
  });
  return response.json();
};
```

## 🛠️ Configuration

### Plugin Settings

You can configure the plugin through the WordPress admin panel under `Settings > Great React Plugin`.

## 🎮 Usage

### Shortcode

Add the following shortcode to any post or page:

```
[great-react-plugin]
```

### Template Tag

Use in your theme files:
```php
<?php do_action('great_react_plugin_display'); ?>
```

### Hooks and Filters

#### Actions
- `great_react_plugin_before_content` - Fires before the main content
- `great_react_plugin_after_content` - Fires after the main content

#### Filters
- `great_react_plugin_settings` - Filter plugin settings
- `great_react_plugin_content` - Filter the main content

## 🧩 Extending the Plugin

### Adding New Components

1. Create a new component in `src/components/`
2. Import and use it in your views

### Custom Styles

Add custom styles in `src/styles/` and import them in your components.

## 🤝 Contributing

Contributions are welcome! Please read our [contributing guidelines](CONTRIBUTING.md) before submitting pull requests.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙌 Support

For support, please:
- Open an issue on [GitHub](https://github.com/yourusername/great-react-plugin/issues)
- Email: okpekuighodaro@gmail.com
- [Join our community](https://your-community-link.com)

## 📚 Documentation

For detailed documentation, please visit our [documentation site](https://docs.yourplugin.com).

## 📱 Screenshots

1. Admin Dashboard
   ![Admin Dashboard](screenshots/admin-dashboard.png)

2. Frontend View
   ![Frontend View](screenshots/frontend-view.png)

## ❓ FAQ

### How do I update the plugin?

You can update the plugin through the WordPress updates page or manually via FTP.

### How do I implement authentication in my React components?

Use the provided authentication hooks and context:

```jsx
import { useAuth } from './hooks/useAuth';

function Profile() {
  const { user, loading } = useAuth();
  
  if (loading) return <div>Loading...</div>;
  if (!user) return <div>Please log in</div>;
  
  return <div>Welcome, {user.name}!</div>;
}
```

### How do I protect routes in React?

Use the `ProtectedRoute` component:

```jsx
import { ProtectedRoute } from './components/auth';

function App() {
  return (
    <Routes>
      <Route path="/login" element={<Login />} />
      <Route element={<ProtectedRoute />}>
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/profile" element={<Profile />} />
      </Route>
    </Routes>
  );
}
```

### How do I refresh expired tokens?

The plugin automatically handles token refresh using an HTTP-only cookie. The frontend will automatically retry requests with a new token if a 401 response is received.

### Can I use this with page builders?

Yes, the plugin works with most page builders through the provided shortcode.

### Is this plugin translation ready?

Yes, the plugin includes .pot file for translations in the `languages/` directory.

## 🚧 Troubleshooting

### Common Issues

1. **Styles not loading**
   - Clear your browser cache
   - Make sure to run `npm run build` after updates

2. **JavaScript errors**
   - Check browser console for errors
   - Ensure all dependencies are installed

## 📈 Roadmap

- [ ] Add more built-in components
- [ ] Implement block editor support
- [ ] Add unit tests
- [ ] Add e2e testing
- [ ] Improve documentation

## 🔗 Useful Links

- [GitHub Repository](https://github.com/yourusername/great-react-plugin)
- [WordPress Plugin Directory](#)
- [Support Forum](#)

## Changelog

= 1.0.0 =
* Initial release
