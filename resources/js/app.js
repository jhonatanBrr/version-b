/**
 * Entry point bundled by Laravel Mix. jQuery is provided globally by
 * mix.autoload(); every page module only runs when its root element exists.
 */
import $ from 'jquery';
import { initAddToCartButtons, initCartBadge } from './modules/cart';
import { initMobileMenu } from './modules/header';
import { initThemeToggle } from './modules/theme';
import { initCheckout } from './pages/checkout';
import { initHome } from './pages/home';
import { initProduct } from './pages/product';

window.$ = window.jQuery = $;

const pages = {
    '[data-page="home"]': initHome,
    '[data-page="product"]': initProduct,
    '[data-page="checkout"]': initCheckout,
};

$(() => {
    initThemeToggle();
    initMobileMenu();
    initCartBadge();
    initAddToCartButtons();

    Object.entries(pages).forEach(([selector, init]) => {
        if ($(selector).length) init($(selector));
    });
});
