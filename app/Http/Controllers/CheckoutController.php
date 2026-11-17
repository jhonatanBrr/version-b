<?php

namespace App\Http\Controllers;

use App\Catalog\ProductRepository;
use Illuminate\Contracts\View\View;

/**
 * The checkout runs on the client (cart in localStorage, jQuery validation,
 * simulated payment). The server only ships the catalog data the page needs
 * to resolve cart lines.
 */
class CheckoutController extends Controller
{
    public function __invoke(ProductRepository $catalog): View
    {
        return view('pages.checkout', ['products' => $catalog->all()]);
    }
}
