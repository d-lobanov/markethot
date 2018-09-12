<?php

namespace Market\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Market\Models\Category;

class CategoryController extends Controller
{
    /**
     * @param Category $category
     * @return Factory|View
     */
    public function view(Category $category)
    {
        return view('category', [
            'category' => $category->load('parent', 'products', 'products.offers', 'products.categories')
        ]);
    }
}
