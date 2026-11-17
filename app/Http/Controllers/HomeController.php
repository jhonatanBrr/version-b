<?php

namespace App\Http\Controllers;

use App\Catalog\ProductRepository;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(ProductRepository $catalog): View
    {
        $products = $catalog->all();

        return view('pages.home', [
            'products' => $products,
            'categories' => $catalog->categories(),
            'formats' => $catalog->formats(),
            'featured' => collect($products)->first(fn ($product) => $product->isNew) ?? $products[0],
        ]);
    }
}
