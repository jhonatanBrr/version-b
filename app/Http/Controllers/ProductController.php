<?php

namespace App\Http\Controllers;

use App\Catalog\ProductRepository;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __invoke(string $slug, ProductRepository $catalog): View
    {
        $product = $catalog->findBySlug($slug) ?? abort(404);

        return view('pages.product', [
            'product' => $product,
            'categories' => $catalog->categories(),
            'related' => $catalog->related($product, 3),
        ]);
    }
}
