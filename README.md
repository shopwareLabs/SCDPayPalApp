# SCDPayPalApp

This is a demo app for the purposes of the presentation "Let's build an app" from the Shopware Community Day 2024.

## Installation hints

Add valid PayPal credentials to the `.env` file.

Use the provided `devenv.nix` to setup a local development environment with devenv and start up your app server.
Do a `composer install` on your local machine to install the dependencies.

Copy / symlink the bundle folder to the `custom/apps` folder of your Shopware installation.
After installing the app, make sure to compile the Storefront JS, e.g. with `composer build:js:storefront`, since this repository does not build the JS files for extension store deployment yet.

## Features

- App basic setup
- Redirect payment handling workflow with PayPal
- Full API setup with PayPal
- Storefront Actions for PayPal Smart Payment buttons

## Known Limitations

- No multi-merchant support yet (only one merchant can be configured), some sort of repository needs to be built (structure for usage is already there, but not implemented yet)
- No support for multiple payment methods yet
- No Express Checkout Shortcut

## Disclaimer

This app is a demo app and not intended for production use.
It is not feature complete and may contain bugs.
Use at your own risk.
