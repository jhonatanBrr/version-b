<?php

namespace App\Http\Controllers;

use App\Catalog\Product;
use App\Catalog\ProductRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request, ProductRepository $catalog): View
    {
        $products = $catalog->all();
        $categories = $catalog->categories();
        $query = trim($request->string('q')->toString());

        // The header search (?q=) is applied on the server too, so the catalog
        // is already filtered without JavaScript; jQuery takes over afterwards.
        $matching = array_values(array_filter($products, fn (Product $product) => $this->matchesQuery($product, $query)));

        $categoryCounts = ['all' => count($matching)];
        foreach ($categories as $category) {
            $categoryCounts[$category['id']] = count(array_filter($matching, fn (Product $product) => $product->category === $category['id']));
        }

        return view('pages.home', [
            'products' => $products,
            'categories' => $categories,
            'formats' => $catalog->formats(),
            'featured' => collect($products)->first(fn ($product) => $product->isNew) ?? $products[0],
            'query' => $query,
            'visibleIds' => array_map(fn (Product $product) => $product->id, $matching),
            'categoryCounts' => $categoryCounts,
        ]);
    }

    /** Case-insensitive substring match on the product name (same rule as the jQuery filter). */
    private function matchesQuery(Product $product, string $query): bool
    {
        return $query === '' || str_contains(mb_strtolower($product->name), mb_strtolower($query));
    }
}
