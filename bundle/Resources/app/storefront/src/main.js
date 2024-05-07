// Register them via the existing PluginManager
const PluginManager = window.PluginManager;
PluginManager.register(
    'SwagPaypalAppWallet',
    () => import('./checkout/swag-paypal-app.wallet'),
    '[data-swag-paypal-app-wallet]',
);
