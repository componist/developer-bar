# Componist Developer Bar

A modern Laravel Developer Bar package with Tailwind CSS v4, Alpine.js, and Livewire components.

> **Note**: This is an example package demonstrating how to create a Laravel package with modern frontend tooling including Tailwind CSS v4, Alpine.js, and Livewire components.

## Features

- 🎨 **Tailwind CSS v4** - Modern utility-first CSS framework with simplified configuration
- ⚡ **Alpine.js** - Lightweight JavaScript framework for interactivity
- 🔧 **Livewire Component** - Server-side rendered developer tools
- 📱 **Responsive Design** - Works on all devices
- 🚀 **Vite Integration** - Fast build tool with hot module replacement

## About This Example Package

This package serves as a comprehensive example of how to create a modern Laravel package with:

- **Laravel Service Provider** - Proper package registration and bootstrapping
- **Livewire Components** - Server-side rendered interactive components
- **Tailwind CSS v4** - Modern utility-first CSS with simplified configuration
- **Alpine.js Integration** - Client-side interactivity
- **Vite Build System** - Fast asset compilation and hot module replacement
- **Middleware Integration** - Automatic injection into Laravel applications
- **Blade Templates** - Customizable view templates

You can use this package as a template for creating your own Laravel packages with similar frontend tooling.

## Installation

### Via Composer

```bash
composer require componist/developer-bar
```

### Publish Configuration (Optional)

```bash
php artisan vendor:publish --provider="Componist\DeveloperBar\DeveloperBarServiceProvider"
```

## Development Setup

### Prerequisites

- Node.js >= 16.0.0
- npm >= 8.0.0
- Laravel >= 8.0
- Livewire >= 2.0

### Install Dependencies

```bash
npm install
```

### Build Assets

```bash
# Build CSS and JS with Vite
npm run build
```

### Development Mode

```bash
# Development mode with hot reload
npm run dev

# Watch mode for development
npm run watch

# Preview built assets
npm run preview
```

## Usage

The developer bar will automatically appear in your Laravel application when:

- Environment is set to `local` or `development`
- Response is HTML content
- Middleware is properly registered (automatically done by service provider)

### Manual Integration

If you need to manually include the developer bar in your views:

```blade
@livewire('componist-developer-bar')
```

## Configuration

The package automatically registers itself with Laravel. The service provider:

- Registers the Livewire component
- Adds middleware to the `web` middleware group
- Loads views from the package

### Environment Requirements

The developer bar only appears when:
- `APP_ENV=local` or `APP_ENV=development`
- Response content type is HTML

## Customization

### CSS Customization

Edit `resources/css/developer-bar.css` and run `npm run build` to rebuild.

### JavaScript Customization

Edit `resources/js/developer-bar.js` and run `npm run build` to rebuild.

### Livewire Component Customization

The main component is located at `src/Livewire/ComponistDeveloperBar.php`. You can extend or modify this component to add custom functionality.

### Blade Templates

Customize the appearance by modifying the Blade templates in `resources/views/`:
- `componist-developer-bar.blade.php` - Main component template
- `livewire/componist-developer-bar.blade.php` - Livewire component template

## Available Scripts

- `npm run build` - Build all assets with Vite
- `npm run dev` - Development mode with Vite
- `npm run watch` - Watch mode for development
- `npm run preview` - Preview built assets
- `npm run clean` - Remove built assets

## File Structure

```
├── src/
│   ├── DeveloperBarServiceProvider.php    # Laravel service provider
│   ├── Livewire/
│   │   └── ComponistDeveloperBar.php      # Main Livewire component
│   └── Middleware/
│       └── ComponistDeveloperBarMiddleware.php  # Middleware for auto-injection
├── resources/
│   ├── css/
│   │   └── developer-bar.css              # Source CSS with Tailwind v4
│   ├── js/
│   │   └── developer-bar.js               # Source JavaScript with Alpine.js
│   └── views/
│       ├── componist-developer-bar.blade.php
│       └── livewire/
│           └── componist-developer-bar.blade.php
├── config/
│   └── developer-bar.php                  # Package configuration
├── public/
│   └── build/                             # Built assets (generated)
├── vite.config.js                         # Vite configuration
├── postcss.config.js                      # PostCSS configuration
├── package.json                           # NPM package configuration
└── composer.json                          # Composer package configuration
```

## License

MIT