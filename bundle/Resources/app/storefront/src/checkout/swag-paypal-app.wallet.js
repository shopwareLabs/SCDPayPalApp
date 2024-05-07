import DomAccess from 'src/helper/dom-access.helper';
import FormSerializeUtil from 'src/utility/form/form-serialize.util';
import AppClient from 'src/service/app-client.service';
import PageLoadingIndicatorUtil from 'src/utility/loading-indicator/page-loading-indicator.util';
import Plugin from 'src/plugin-system/plugin.class';
import {loadScript} from '@paypal/paypal-js';

const BASE_URL = 'http://localhost:8080/storefront/';

export default class SwagPaypalAppWallet extends Plugin {
    static options = {
        /**
         * Options for the PayPal script
         */
        languageIso: 'en_GB',
        currency: 'EUR',
        intent: 'capture',
        commit: true,
        clientId: '',
        merchantPayerId: '',

        /**
         * Is set, if the plugin is used on the order edit page
         */
        orderId: null,

        /**
         * Usage inside the plugin
         */
        confirmOrderFormSelector: '#confirmOrderForm',
        confirmOrderButtonSelector: 'button[type="submit"]',

        /**
         * In a productive app, we should filter this to only values that we need for PayPal order creation
         */
        cart: {},
        salesChannelContext: {},
    };

    init() {
        this._client = new AppClient('SCDPayPalApp');

        this.createButton();
    }

    async createButton() {
        await this.fetchClientConfig();
        const paypal = await this.createScript();
        this.renderButton(paypal);
    }

    createScript() {
        return loadScript(this.getScriptOptions());
    }

    renderButton(paypal) {
        this.confirmOrderForm = DomAccess.querySelector(document, this.options.confirmOrderFormSelector);

        DomAccess.querySelector(this.confirmOrderForm, this.options.confirmOrderButtonSelector).classList.add('d-none');

        return paypal.Buttons(this.getButtonConfig()).render(this.el);
    }


    /**
     * @return {Object}
     */
    getScriptOptions() {
        return {
            components: 'buttons,messages',
            'client-id': this.options.clientId,
            commit: !!this.options.commit,
            locale: this.options.languageIso,
            currency: this.options.currency,
            intent: this.options.intent,
            'enable-funding': 'paylater,venmo',
            'merchant-id': this.options.merchantPayerId,
        };
    }

    getButtonConfig() {
        return {
            style: {
                size: 'small',
                shape: 'rect',
                color: 'gold',
                label: 'pay',
            },

            /**
             * Will be called if when the payment process starts
             */
            createOrder: this.createOrder.bind(this),

            /**
             * Will be called if the payment process is approved by paypal
             */
            onApprove: this.onApprove.bind(this),

            /**
             * Check form validity & show loading spinner on confirm click
             */
            onClick: this.onClick.bind(this),

            /**
             * Will be called if an error occurs during the payment process.
             */
            onError: this.onError.bind(this),
        };
    }

    /**
     * @return {Promise}
     */
    async createOrder() {
        if (!this.confirmOrderForm.checkValidity()) {
            throw new Error('Checkout form not valid');
        }

        const data = {
            formData: FormSerializeUtil.serializeJson(this.confirmOrderForm),
            cart: this.options.cart,
            salesChannelContext: this.options.salesChannelContext,
            orderId: this.options.orderId,
        }

        const response = await this._client.post(
            `${BASE_URL}order/`,
            {
                body: JSON.stringify(data),
            }
        ).then((response) => response.json());

        return response.orderId;
    }

    onApprove(data) {
        PageLoadingIndicatorUtil.create();

        const input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('name', 'paypalOrderId');
        input.setAttribute('value', data.orderID);

        this.confirmOrderForm.appendChild(input);
        this.confirmOrderForm.submit();
    }

    onClick(data, actions) {
        if (!this.confirmOrderForm.checkValidity()) {
            return actions.reject();
        }

        return actions.resolve();
    }

    onError(error) {
        console.error(error);
        window.location.reload();
    }

    async fetchClientConfig() {
        const response = await this._client.get(`${BASE_URL}config/`);

        this.options = {
            ...this.options,
            ...await response.json(),
        };
    }
}
