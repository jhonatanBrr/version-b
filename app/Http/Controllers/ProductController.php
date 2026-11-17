<?php

namespace App\Http\Controllers;

use App\Catalog\ProductPresenter;
use App\Catalog\ProductRepository;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    public function __invoke(string $slug, ProductRepository $catalog): View
    {
        $product = $catalog->findBySlug($slug) ?? abort(404);
        $categories = $catalog->categories();
        $locale = app()->getLocale();
        $categoryLabels = array_column(
            array_map(fn (array $c) => ['id' => $c['id'], 'label' => $c['label'][$locale]], $categories),
            'label',
            'id',
        );

        return view('pages.product', [
            'product' => $product,
            'page' => new ProductPresenter($product),
            'categories' => $categories,
            'categoryLabels' => $categoryLabels,
            'categoryLabel' => $categoryLabels[$product->category] ?? '',
            'related' => $catalog->related($product, 3),
        ]);
    }
}
