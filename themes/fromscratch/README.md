# fromscratch

A minimalistic wordpress theme to start building from scratch.

## Author

Stephan Wagner, [stephanwagner.me@gmail.com](stephanwagner.me@gmail.com)

## Assets

All CSS and JavaScript source files live in: `wordpress/wp-content/themes/fromscratch/src`.

To work on assets, navigate to the theme directory and run one of the following commands:

### Watch (development)
Continuously rebuild assets while you work:

```bash
cd wordpress/wp-content/themes/fromscratch

npm run watch
```

### Build (production)

Create an optimized production build:

```bash
cd wordpress/wp-content/themes/fromscratch

npm run build
```

## Install

This theme provides optional developer tools via **WP-CLI**.

If you don’t have WP-CLI installed yet, install it first:

```bash
brew install wp-cli
```

Verify the installation:

```bash
wp --info
```

Once WP-CLI is available, you can run the theme’s setup command:

```bash
wp fromscratch:install
```