<?php

namespace App\Http\Controllers;

use App\Catalog\Product;
use App\Catalog\ProductRepository;
use Illuminate\Contracts\View\View;

/**
 * The checkout runs on the client (cart in localStorage, jQuery validation,
 * simulated payment). The server only ships the catalog data the page needs
 * to resolve cart lines, plus the localized texts the script renders.
 */
class CheckoutController extends Controller
{
    /** Payment options offered in the demo checkout (no gateway is called). */
    public const PAYMENT_METHODS = [
        'card' => ['visa' => 'Visa', 'mastercard' => 'Mastercard', 'americanexpress' => 'American Express'],
        'paypal' => ['paypal' => 'PayPal'],
        'wallet' => ['applepay' => 'Apple Pay', 'googlepay' => 'Google Pay'],
        'transfer' => [],
        'installments' => [],
        'docente' => [],
    ];

    public const DEFAULT_PAYMENT_METHOD = 'card';

    public function __invoke(ProductRepository $catalog): View
    {
        $products = $catalog->all();

        return view('pages.checkout', [
            'products' => $products,
            'paymentMethods' => self::PAYMENT_METHODS,
            'defaultMethod' => self::DEFAULT_PAYMENT_METHOD,
            'clientData' => [
                'products' => array_map(fn (Product $product): array => $this->clientProduct($product), $products),
                'texts' => $this->clientTexts(),
            ],
        ]);
    }

    /** Catalog subset the script needs to render a cart line. */
    private function clientProduct(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'format' => __('common.formats.'.$product->format),
            'image' => $product->imageUrl(144),
            'imageAlt' => $product->imageAltText(),
            'editions' => array_map(fn (array $edition): array => [
                'id' => $edition['id'],
                'label' => $edition['label'][app()->getLocale()],
                'price' => $edition['price'],
                'salePrice' => $edition['salePrice'],
            ], $product->editions),
        ];
    }

    /** Localized strings with ":placeholder" tokens that the script fills in. */
    private function clientTexts(): array
    {
        $methods = [];
        foreach (array_keys(self::PAYMENT_METHODS) as $id) {
            $methods[$id] = [
                'label' => __("checkout.methods.$id.label"),
                'description' => __("checkout.methods.$id.description"),
                'cta' => __("checkout.methods.$id.cta"),
            ];
        }

        return [
            'itemsOne' => trans_choice('checkout.summary.items', 1, ['count' => ':count']),
            'itemsOther' => trans_choice('checkout.summary.items', 2, ['count' => ':count']),
            'quantityOf' => __('checkout.summary.quantityOf'),
            'decrease' => __('checkout.summary.decrease'),
            'increase' => __('checkout.summary.increase'),
            'removeItem' => __('checkout.summary.removeItem'),
            'processing' => __('checkout.pay.processing'),
            'confirmationEmail' => __('checkout.confirmation.email'),
            'errors' => __('checkout.errors'),
            'methods' => $methods,
        ];
    }
}
